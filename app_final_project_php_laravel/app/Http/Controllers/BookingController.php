<?php

namespace App\Http\Controllers;

use App\Mail\BookingComplitedMailing;
use App\Models\Booking;
use App\Models\User;
use App\Services\Bookings\BookingServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function index(): View
    {
        $bookings = User::find(request()->user()?->id)->bookings;

        return view('bookings.index', ['bookings' => $bookings]);
    }

    public function show(int $id): View
    {
        $booking = User::find(request()->user()?->id)->bookings->firstWhere('id', $id);

        return view('bookings.show', ['booking' => $booking]);
    }

    public function store(BookingServices $bookingServices): RedirectResponse
    {
        $resultId = $bookingServices->store();

        if($resultId){
            return redirect()->route('bookings.index')->with('resultMessage', "Отель забронирован, id бронирования - {$resultId}");
        } else {
            return redirect()->away(url()->previous())->with('errorMessage', 'Что-то пошло не так.');
        }
    }

    public function delete(int $id): RedirectResponse
    {
        $booking = Booking::find($id);
        if($booking->user_id === Auth::id()){
            $booking->delete();
            return redirect()->route('bookings.index')->with('resultMessage', 'Бронирование удалено');
        } else {
            return redirect()->route('bookings.index')->with('errorMessage', 'Бронирование не может быть удалено');
        }
    }
}
