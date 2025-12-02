<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Service;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('now', '+5 days');
        $end   = (clone $start)->modify('+1 hour');

        return [
            'customer_id' => User::factory()->state(['role' => 'customer']),
            'staff_id'    => User::factory()->state(['role' => 'staff']),
            'service_id'  => Service::factory(),
            'date'        => $start->format('Y-m-d'),
            'start_time'  => $start->format('H:i'),
            'end_time'    => $end->format('H:i'),
            'status'      => fake()->randomElement(['pending','confirmed','completed','cancelled']),
            'notes'       => fake()->sentence(),
        ];
    }
}
