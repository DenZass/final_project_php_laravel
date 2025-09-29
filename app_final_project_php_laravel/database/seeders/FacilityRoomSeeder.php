<?php

namespace Database\Seeders;

use App\Models\FacilityRoom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilityRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        FacilityRoom::factory(260)->create();
    }
}
