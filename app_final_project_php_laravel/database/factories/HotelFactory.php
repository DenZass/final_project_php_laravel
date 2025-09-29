<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->company(),
            'description' => fake()->realText(),
            'poster_url' => 'https://static.tildacdn.com/tild3663-3237-4339-a232-336461373832/253786471.jpg',
            'address' => fake()->address(),
        ];
    }
}
