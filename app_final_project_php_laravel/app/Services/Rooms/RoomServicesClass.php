<?php

namespace App\Services\Rooms;

use App\Models\FacilityRoom;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomServicesClass implements RoomServices
{
    public function create(int $hotelId, array $validatedParam): int
    {
        $room = new Room();
        $room->title = $validatedParam['title'];
        $room->description = $validatedParam['description'];
        $room->poster_url = $validatedParam['poster_url'];
        $room->floor_area = $validatedParam['floor_area'];
        $room->type = $validatedParam['type'];
        $room->price = $validatedParam['price'];
        $room->hotel_id = $hotelId;
        $room->save();

        if($validatedParam['facilities'] !== null){
            foreach ($validatedParam['facilities'] as $facilityId){
                $facilityRoom = new FacilityRoom();
                $facilityRoom->facility_id = $facilityId;
                $facilityRoom->room_id = $room->id;
                $facilityRoom->save();
            }
        }

        return $room->id;
    }

    public function update(int $hotelId, int $roomId, array $validatedParam): int
    {
        $room = Room::find($roomId);
        $room->title = $validatedParam['title'];
        $room->description = $validatedParam['description'];
        $room->poster_url = $validatedParam['poster_url'];
        $room->floor_area = $validatedParam['floor_area'];
        $room->type = $validatedParam['type'];
        $room->price = $validatedParam['price'];
        $room->save();

        FacilityRoom::where('room_id', $roomId)->delete();
        if($validatedParam['facilities'] !== null){
            foreach ($validatedParam['facilities'] as $facilityId) {
                $facilityRoom = new FacilityRoom();
                $facilityRoom->facility_id = $facilityId;
                $facilityRoom->room_id = $roomId;
                $facilityRoom->save();
            }
        }

        return $room->id;
    }

    public function getTypes(): array
    {
        $typeList = DB::select('select distinct type from rooms;');
        $resultTypeList = [];
        foreach ($typeList as $item){
            $resultTypeList[] = $item->type;
        }
        return $resultTypeList;
    }
}
