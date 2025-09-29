<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_id' => Room::inRandomOrder()->first()->getKey(),
            'user_id' => User::inRandomOrder()->first()->getKey(),
            'started_at' => now(),
            'finished_at' => now(),
            'days' => fake()->randomNumber(2, false),
            'price' => fake()->randomNumber(5, false),
        ];
    }
}
