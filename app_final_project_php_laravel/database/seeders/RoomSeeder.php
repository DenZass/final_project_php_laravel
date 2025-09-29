<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Room::factory(350)->sequence(
            ['type' => 'Эконом'],
            ['type' => 'Стандарт'],
            ['type' => 'Премиум'],
        )->create();
    }
}
