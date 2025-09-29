<?php

namespace Database\Factories;

use App\Models\Facilitie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Facilitie>
 */
class FacilitieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'Удобство ' . Facilitie::max('id') + 1,
        ];
    }
}
