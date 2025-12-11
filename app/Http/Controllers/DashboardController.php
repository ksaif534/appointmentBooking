<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_appointments' => Appointment::count(),
            'total_services' => Service::where('is_active', true)->count(),
            'total_staff' => User::where('role', 'staff')->count(),
        ];

        // Chart Data: Appointments per Service
        $appointmentsPerService = DB::table('appointments')
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->select('services.name', DB::raw('count(*) as count'))
            ->groupBy('services.name')
            ->get();

        $chartData = [
            'labels' => $appointmentsPerService->pluck('name'),
            'data' => $appointmentsPerService->pluck('count'),
        ];

        return view('dashboard', compact('stats', 'chartData'));
    }
}
