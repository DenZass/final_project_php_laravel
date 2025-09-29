<?php

namespace App\Services\Hotels;

use Illuminate\Http\Request;

interface HotelServices
{
    public function index(Request $request): array;
    public function create(array $validateParam): int;
    public function update(int $id, array $validateParam): int;
}
