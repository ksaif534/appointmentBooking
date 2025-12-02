<?php

namespace App\Http\Controllers;

use App\Models\StaffService;
use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;

class StaffServiceController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(StaffService::class, 'staff_service');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffServices = StaffService::with(['staff', 'service'])->paginate(10);
        return view('staff_services.index', compact('staffServices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $staff = User::where('role', 'staff')->get();
        $services = Service::all();
        return view('staff_services.create', compact('staff', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'staff_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
        ]);

        // Prevent duplicate assignments
        $exists = StaffService::where('staff_id', $validated['staff_id'])
            ->where('service_id', $validated['service_id'])
            ->exists();

        if ($exists) {
            return back()->withErrors(['error' => 'This service is already assigned to this staff member.']);
        }

        StaffService::create($validated);

        return redirect()->route('staff-services.index')
            ->with('success', 'Service assigned to staff successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StaffService $staffService)
    {
        $staff = User::where('role', 'staff')->get();
        $services = Service::all();
        return view('staff_services.edit', compact('staffService', 'staff', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StaffService $staffService)
    {
        $validated = $request->validate([
            'staff_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
        ]);

        // Prevent duplicate assignments (excluding current one)
        $exists = StaffService::where('staff_id', $validated['staff_id'])
            ->where('service_id', $validated['service_id'])
            ->where('id', '!=', $staffService->id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['error' => 'This service is already assigned to this staff member.']);
        }

        $staffService->update($validated);

        return redirect()->route('staff-services.index')
            ->with('success', 'Assignment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StaffService $staffService)
    {
        $staffService->delete();

        return redirect()->route('staff-services.index')
            ->with('success', 'Assignment deleted successfully.');
    }
}
