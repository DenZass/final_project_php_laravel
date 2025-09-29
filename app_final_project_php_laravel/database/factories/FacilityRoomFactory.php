<?php

namespace Database\Factories;

use App\Models\Facilitie;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FacilityRoom>
 */
class FacilityRoomFactory extends Factory
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
            'room_id' => Room::inRandomOrder()->first()->getKey(),
        ];
    }
}
