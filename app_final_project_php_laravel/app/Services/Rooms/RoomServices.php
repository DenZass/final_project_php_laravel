<?php

namespace App\Services\Rooms;

interface RoomServices
{
    public function create(int $hotelId, array $validatedParam): int;
    public function update(int $hotelId, int $roomId, array $validatedParam): int;
    public function getTypes(): array;
}
