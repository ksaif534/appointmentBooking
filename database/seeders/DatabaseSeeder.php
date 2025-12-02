<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StaffDetail;
use App\Models\StaffAvailability;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\Notification;
use App\Models\CalendarSync;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create staff users
        $staff = User::factory()
            ->count(10)
            ->state(['role' => 'staff'])
            ->create();

        // Add staff details + availability
        $staff->each(function ($s) {
            StaffDetail::factory()->create(['user_id' => $s->id]);

            StaffAvailability::factory()->count(3)->create([
                'staff_id' => $s->id
            ]);
        });

        // Create customers
        $customers = User::factory()
            ->count(30)
            ->state(['role' => 'customer'])
            ->create();

        // Create services
        $services = Service::factory()->count(6)->create();

        // Assign services to staff (random pivot)
        foreach ($staff as $s) {
            $s->services()->attach(
                $services->random(rand(1, 4))->pluck('id')->toArray()
            );
        }

        // Create appointments
        $appointments = Appointment::factory()
            ->count(50)
            ->create();

        // Notifications
        Notification::factory()->count(80)->create();

        // Calendar sync entries
        CalendarSync::factory()->count(20)->create();
    }
}
