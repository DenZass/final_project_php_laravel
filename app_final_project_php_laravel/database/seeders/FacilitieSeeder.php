<?php

namespace Database\Seeders;

use App\Models\Facilitie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        for($i = 0; $i<20; $i++){
            Facilitie::factory(1)->create();
        }
    }
}
