<?php

namespace Database\Seeders;

use App\Models\FacilityHotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilityHotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        FacilityHotel::factory(160)->create();
    }
}
