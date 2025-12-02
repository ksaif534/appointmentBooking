<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StaffDetail>
 */
class StaffDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'       => User::factory(),
            'bio'           => fake()->sentence(),
            'specialization'=> fake()->randomElement(['Hair', 'Skin', 'Dental', 'Wellness', 'Consultation']),
        ];
    }
}
