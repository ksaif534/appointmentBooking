<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\User;

class AssignStaffToAllServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = Service::all();
        $staffMembers = User::where('role', 'staff')->get();

        if ($staffMembers->isEmpty()) {
            $this->command->info('No staff members found. Creating some...');
            $staffMembers = User::factory()->count(5)->state(['role' => 'staff'])->create();
        }

        foreach ($services as $service) {
            // Check if service already has staff
            $hasStaff = User::where('role', 'staff')
                ->whereHas('staffServices', function ($query) use ($service) {
                    $query->where('service_id', $service->id);
                })
                ->exists();

            if (!$hasStaff) {
                // Assign 1-3 random staff members
                $randomStaff = $staffMembers->random(rand(1, min(3, $staffMembers->count())));
                foreach ($randomStaff as $staff) {
                    // Use staffServices pivot manually or services relation
                    // Checking which one is easier. User model has services().
                    // But wait, the seeder used $s->services()->attach().
                    $staff->services()->attach($service->id);
                }
            }
        }
    }
}
