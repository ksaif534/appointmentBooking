<?php

namespace App\Http\Controllers;

use App\Models\StaffAvailability;
use App\Models\User;
use Illuminate\Http\Request;

class StaffAvailabilityController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(StaffAvailability::class, 'staff_availability');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $availabilities = StaffAvailability::with('staff')->orderBy('weekday')->orderBy('start_time')->paginate(10);
        return view('staff_availabilities.index', compact('availabilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $staff = User::where('role', 'staff')->get();
        return view('staff_availabilities.create', compact('staff'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'staff_id' => 'required|exists:users,id',
            'weekday' => 'required|integer|min:0|max:6', // 0 = Sunday, 6 = Saturday
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        StaffAvailability::create($validated);

        return redirect()->route('staff-availabilities.index')
            ->with('success', 'Availability created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StaffAvailability $staffAvailability)
    {
        $staff = User::where('role', 'staff')->get();
        return view('staff_availabilities.edit', compact('staffAvailability', 'staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StaffAvailability $staffAvailability)
    {
        $validated = $request->validate([
            'staff_id' => 'required|exists:users,id',
            'weekday' => 'required|integer|min:0|max:6',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $staffAvailability->update($validated);

        return redirect()->route('staff-availabilities.index')
            ->with('success', 'Availability updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StaffAvailability $staffAvailability)
    {
        $staffAvailability->delete();

        return redirect()->route('staff-availabilities.index')
            ->with('success', 'Availability deleted successfully.');
    }
}
