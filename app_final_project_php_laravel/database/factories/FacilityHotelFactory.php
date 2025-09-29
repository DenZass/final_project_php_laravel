<?php

namespace Database\Factories;

use App\Models\Facilitie;
use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FacilityHotel>
 */
class FacilityHotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'facility_id' => Facilitie::inRandomOrder()->first()->getKey(),
            'hotel_id' => Hotel::inRandomOrder()->first()->getKey(),
        ];
    }
}
