<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Appointment;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'        => User::factory(),
            'appointment_id' => Appointment::factory(),
            'type'           => fake()->randomElement(['email', 'sms']),
            'message'        => fake()->sentence(),
            'status'         => fake()->randomElement(['pending','sent','failed']),
            'scheduled_at'   => now()->addMinutes(10),
            'sent_at'        => null,
        ];
    }
}
