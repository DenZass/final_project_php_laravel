<?php

namespace App\Services\Bookings;

use App\Mail\BookingComplitedMailing;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BookingServicesClass implements BookingServices
{
    public function store(): int|bool
    {
        $startedDayCarbon = \Carbon\Carbon::parse(request()->input('started_at'));
        $finishDayCarbon = \Carbon\Carbon::parse(request()->input('finished_at'));
        $diffInDays = $finishDayCarbon->diffInDays($startedDayCarbon);

        $newBooking = new Booking();
        $newBooking->room_id = request()->input('room_id');
        $newBooking->user_id = request()->user()->id;
        $newBooking->started_at = request()->input('started_at');
        $newBooking->finished_at = request()->input('finished_at');
        $newBooking->days = $diffInDays;
        $newBooking->price = request()->input('price') * $diffInDays;

        if($newBooking->save()) {
            $email = User::find(Auth::id())->email;
            Mail::to($email)->send(new BookingComplitedMailing($newBooking));
            return $newBooking->id;
        }
        return false;
    }
}
