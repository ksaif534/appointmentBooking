<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StaffAvailability>
 */
class StaffAvailabilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'staff_id'  => User::factory(),
            'weekday'   => fake()->numberBetween(0, 6),
            'start_time'=> fake()->time('H:i'),
            'end_time'  => fake()->time('H:i'),
        ];
    }
}
