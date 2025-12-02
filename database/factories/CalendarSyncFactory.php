<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Appointment;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CalendarSync>
 */
class CalendarSyncFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'           => User::factory(),
            'appointment_id'    => Appointment::factory(),
            'provider'          => fake()->randomElement(['google', 'outlook']),
            'external_event_id' => fake()->uuid(),
        ];
    }
}
