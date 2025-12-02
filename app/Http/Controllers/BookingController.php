<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use App\Models\Appointment;
use App\Models\StaffAvailability;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->get();
        return view('booking.index', compact('services'));
    }

    public function create(Service $service, Request $request)
    {
        // Get staff who perform this service
        $staff = User::where('role', 'staff')
            ->whereHas('staffServices', function ($query) use ($service) {
                $query->where('service_id', $service->id);
            })
            ->get();

        $selectedStaffId = $request->query('staff_id');
        $selectedDate = $request->query('date');
        $availableSlots = [];

        if ($selectedStaffId && $selectedDate) {
            $availableSlots = $this->getAvailableSlots($selectedStaffId, $selectedDate, $service->duration_minutes);
        }

        return view('booking.create', compact('service', 'staff', 'availableSlots', 'selectedStaffId', 'selectedDate'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'staff_id' => 'required|exists:users,id',
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
        ]);

        $service = Service::findOrFail($validated['service_id']);
        $endTime = Carbon::parse($validated['start_time'])->addMinutes($service->duration_minutes)->format('H:i');

        // Double check availability
        if (!$this->isSlotAvailable($validated['staff_id'], $validated['date'], $validated['start_time'], $endTime)) {
            return back()->withErrors(['start_time' => 'This time slot is no longer available.']);
        }

        $appointment = Appointment::create([
            'customer_id' => $request->user()->id,
            'staff_id' => $validated['staff_id'],
            'service_id' => $validated['service_id'],
            'date' => $validated['date'],
            'start_time' => $validated['start_time'],
            'end_time' => $endTime,
            'status' => 'pending',
        ]);

        $request->user()->notify(new \App\Notifications\BookingConfirmed($appointment));

        return redirect()->route('appointments.index')->with('success', 'Appointment booked successfully!');
    }

    private function getAvailableSlots($staffId, $date, $durationMinutes)
    {
        $dateCarbon = Carbon::parse($date);
        $dayOfWeekMap = [
            0 => 'sun',
            1 => 'mon',
            2 => 'tue',
            3 => 'wed',
            4 => 'thu',
            5 => 'fri',
            6 => 'sat',
        ];
        $dayOfWeek = $dayOfWeekMap[$dateCarbon->dayOfWeek];

        // Get staff availability for this day
        $availability = StaffAvailability::where('staff_id', $staffId)
            ->where('weekday', $dayOfWeek)
            ->first();

        if (!$availability) {
            return [];
        }

        $startTime = Carbon::parse($availability->start_time);
        $endTime = Carbon::parse($availability->end_time);
        $slots = [];

        // Generate slots
        while ($startTime->copy()->addMinutes($durationMinutes)->lte($endTime)) {
            $slotStart = $startTime->format('H:i');
            $slotEnd = $startTime->copy()->addMinutes($durationMinutes)->format('H:i');

            if ($this->isSlotAvailable($staffId, $date, $slotStart, $slotEnd)) {
                $slots[] = $slotStart;
            }

            $startTime->addMinutes(30); // 30-minute intervals
        }

        return $slots;
    }

    private function isSlotAvailable($staffId, $date, $startTime, $endTime)
    {
        return !Appointment::where('staff_id', $staffId)
            ->where('date', $date)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where(function ($q) use ($startTime, $endTime) {
                    $q->where('start_time', '>=', $startTime)
                      ->where('start_time', '<', $endTime);
                })
                ->orWhere(function ($q) use ($startTime, $endTime) {
                    $q->where('end_time', '>', $startTime)
                      ->where('end_time', '<=', $endTime);
                })
                ->orWhere(function ($q) use ($startTime, $endTime) {
                    $q->where('start_time', '<=', $startTime)
                      ->where('end_time', '>=', $endTime);
                });
            })
            ->exists();
    }
}
