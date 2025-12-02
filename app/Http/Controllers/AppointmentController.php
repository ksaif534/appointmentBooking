<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['customer', 'staff', 'service'])->paginate(10);
        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = \App\Models\User::where('role', 'customer')->get();
        $staff = \App\Models\User::where('role', 'staff')->get();
        $services = \App\Models\Service::all();
        
        return view('appointments.create', compact('customers', 'staff', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'staff_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'notes' => 'nullable|string',
        ]);

        Appointment::create($validated);

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        $customers = \App\Models\User::where('role', 'customer')->get();
        $staff = \App\Models\User::where('role', 'staff')->get();
        $services = \App\Models\Service::all();
        
        return view('appointments.edit', compact('appointment', 'customers', 'staff', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'staff_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'notes' => 'nullable|string',
        ]);

        $appointment->update($validated);

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment deleted successfully.');
    }
}
