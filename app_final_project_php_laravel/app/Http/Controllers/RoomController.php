<?php

namespace App\Http\Controllers;

use App\Models\Facilitie;
use App\Models\FacilityRoom;
use App\Models\Room;
use App\Services\Rooms\RoomServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RoomController extends Controller
{
    public function create(int $hotelId, Request $request, RoomServices $roomServices): RedirectResponse
    {
        Gate::authorize('admin');

        $typesList = $roomServices->getTypes();

        $validatedParam = $request->validate([
            'title' => ['required', 'max:100'],
            'description' => ['required'],
            'poster_url' => ['required', 'url:http,https'],
            'floor_area' => ['required', 'numeric'],
            'type' => ['required', Rule::in($typesList)],
            'price' => ['required', 'numeric'],
            'facilities' => ['required', 'array'],
        ]);

        $resultId = $roomServices->create($hotelId, $validatedParam);

        if($resultId) {
            return redirect()->route('hotels.show', ['id' => $hotelId])->with('resultMessage', "Добавлена комната с id - {$resultId}");
        } else {
            return redirect()->route('hotels.show', ['id' => $hotelId])->with('errorMessage', "Что-то пошло не так.");
        }
    }

    public function showFormCreate(int $hotelId): View
    {
        Gate::authorize('admin');

        return view('rooms.create', [
            'hotelId' => $hotelId,
            'facilityFullList' => Facilitie::all(),
        ]);
    }

    public function showFormUpdate(int $hotelId, int $roomId): View
    {
        Gate::authorize('admin');

        $room = Room::find($roomId);

        $haveFacilitiesIdArray = [];
        foreach ($room->facilities as $facility) {
            $haveFacilitiesIdArray[] += $facility->id;
        }

        return view('rooms.update', [
            'hotelId'=>$hotelId,
            'room'=>$room,
            'haveFacilitiesIdArray' => $haveFacilitiesIdArray,
            'facilityFullList' => Facilitie::all(),
        ]);
    }

    public function update(int $hotelId, int $roomId, Request $request, RoomServices $roomServices): RedirectResponse
    {
        Gate::authorize('admin');

        $typesList = $roomServices->getTypes();

        $validatedParam = $request->validate([
            'title' => ['required', 'max:100'],
            'description' => ['required'],
            'poster_url' => ['required', 'url:http,https'],
            'floor_area' => ['required', 'numeric'],
            'type' => ['required', Rule::in($typesList)],
            'price' => ['required', 'numeric'],
            'facilities' => ['required', 'array'],
        ]);

        $resultId = $roomServices->update($hotelId, $roomId, $validatedParam);

        if($resultId) {
            return redirect()->route('hotels.show', ['id' => $hotelId])->with('resultMessage', "Комната с id-{$resultId} отредактирована");
        } else {
            return redirect()->route('hotels.show', ['id' => $hotelId])->with('errorMessage', "Что-то пошло не так.");
        }
    }

    public function delete(int $hotelId, int $roomId): RedirectResponse
    {
        Gate::authorize('admin');

        $room = Room::find($roomId);
        if ($room) {
            $room->delete();
            return redirect()->route('hotels.show', ['id' => $hotelId])->with('resultMessage', 'Комната удалена');
        } else {
            return redirect()->route('hotels.show', ['id' => $hotelId])->with('errorMessage', 'Запись отсутствует');
        }
    }
}
