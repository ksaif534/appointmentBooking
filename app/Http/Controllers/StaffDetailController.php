<?php

namespace App\Http\Controllers;

use App\Models\StaffDetail;
use App\Models\User;
use Illuminate\Http\Request;

class StaffDetailController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(StaffDetail::class, 'staff_detail');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffDetails = StaffDetail::with('user')->paginate(10);
        return view('staff_details.index', compact('staffDetails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $staff = User::where('role', 'staff')->get();
        return view('staff_details.create', compact('staff'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:staff_details,user_id',
            'bio' => 'nullable|string',
            'specialization' => 'nullable|string|max:255',
        ]);

        StaffDetail::create($validated);

        return redirect()->route('staff-details.index')
            ->with('success', 'Staff details created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StaffDetail $staffDetail)
    {
        $staff = User::where('role', 'staff')->get();
        return view('staff_details.edit', compact('staffDetail', 'staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StaffDetail $staffDetail)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:staff_details,user_id,' . $staffDetail->id,
            'bio' => 'nullable|string',
            'specialization' => 'nullable|string|max:255',
        ]);

        $staffDetail->update($validated);

        return redirect()->route('staff-details.index')
            ->with('success', 'Staff details updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StaffDetail $staffDetail)
    {
        $staffDetail->delete();

        return redirect()->route('staff-details.index')
            ->with('success', 'Staff details deleted successfully.');
    }
}
