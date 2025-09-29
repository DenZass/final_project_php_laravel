<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->realText(20),
            'description' => fake()->realText(),
            'poster_url' => 'https://pix10.agoda.net/hotelImages/302779/-1/78b9a01b4624ded6c377803eedc0af2e.jpg?ca=13&ce=1&s=1024x',
            'floor_area' => fake()->randomNumber(2),
            'type' => 'type',
            'price' => fake()->randomNumber(5),
            'hotel_id' => Hotel::inRandomOrder()->first()->getKey(),
        ];
    }
}
