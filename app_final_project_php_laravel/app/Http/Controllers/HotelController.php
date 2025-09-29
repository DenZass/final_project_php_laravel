<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Facilitie;
use App\Models\FacilityHotel;
use App\Models\Hotel;
use App\Models\User;
use App\Services\Hotels\HotelServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class HotelController extends Controller
{
    public function index(Request $request, HotelServices $hotelServices): View
    {
        $result = $hotelServices->index($request);

        return view('hotels.index', [
            'hotels' => $result['hotels'],
            'valueFromRequest'=> $result['valueFromRequest'],
        ]);
    }

    public function show(int $id): View
    {
        return view('hotels.show', ['hotel' => Hotel::find($id), 'rooms' => Hotel::find($id)->rooms]);
    }

    public function showFormCreate(): View
    {
        Gate::authorize('admin');
        return view('hotels.create', ['facilityFullList' => Facilitie::all()]);
    }

    public function create(Request $request, HotelServices $hotelServices): RedirectResponse
    {
        Gate::authorize('admin');

        $validatedParam = $request->validate([
            'title' => ['required', 'max:100'],
            'description' => ['required'],
            'poster_url' => ['required', 'url:http,https'],
            'address' => ['required'],
            'facilities' => ['required', 'array']
        ]);

        $resultId = $hotelServices->create($validatedParam);

        if ($resultId) {
            return redirect()->route('hotels.index')->with('resultMessage', "Добавлен отель с id - {$resultId}");
        } else {
            return redirect()->route('hotels.index')->with('errorMessage', "Что-то пошло не так");
        }
    }

     public function showFormUpdate(int $id): View
     {
         Gate::authorize('admin');

         $hotel = Hotel::find($id);

         $haveFacilitiesIdArray = [];
         foreach ($hotel->facilities as $facility) {
             $haveFacilitiesIdArray[] += $facility->id;
         }

         return view('hotels.update', [
             'hotel' => $hotel,
             'haveFacilitiesIdArray' => $haveFacilitiesIdArray,
             'facilityFullList' => Facilitie::all(),
         ]);
     }

     public function update(int $id, Request $request, HotelServices $hotelServices): RedirectResponse
     {
         Gate::authorize('admin');

         $validatedParam = $request->validate([
             'title' => ['required', 'max:100'],
             'description' => ['required'],
             'poster_url' => ['required', 'url:http,https'],
             'address' => ['required'],
             'facilities' => ['required', 'array']
         ]);

         $resultId = $hotelServices->update($id, $validatedParam);

         if ($resultId) {
             return redirect()->route('hotels.show', ['id' => $resultId])->with('resultMessage', 'Отель отредактирован!');
         } else {
             return redirect()->route('hotels.index')->with('errorMessage', "Что-то пошло не так");
         }
     }

     public function delete(int $id): RedirectResponse
     {
         Gate::authorize('admin');

         Hotel::find($id)->delete();
         return redirect()->route('hotels.index')->with('resultMessage', 'Отель удалён!');
     }

     public function showBookings(int $id): View
     {
         Gate::authorize('admin');

         $hotel = Hotel::find($id);
         $roomsIdList = [];

         foreach ($hotel->rooms as $room){
             $roomsIdList[] = $room->id;
         }

         $bookings = Booking::whereIn('room_id', $roomsIdList)->get();

         return view('hotels.show-bookings', ['bookings' => $bookings, 'hotel' => $hotel]);
     }

     public function deleteBooking(int $hotelId, int $bookId): RedirectResponse
     {
         Gate::authorize('admin');

         $booking = Booking::find($bookId);

         if($booking){
             $booking->delete();
             return redirect()->route('hotels.showBookings', ['id' => $hotelId])->with('resultMessage', 'Бронирование удалено');
         } else {
             return redirect()->route('hotels.showBookings', ['id' => $hotelId])->with('errorMessage', 'Запись отсутствует');
         }
     }
}


