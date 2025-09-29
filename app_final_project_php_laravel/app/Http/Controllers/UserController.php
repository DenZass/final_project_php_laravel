<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index()
    {
        Gate::authorize('admin');
        return view('users.index', ['users' => User::paginate(10)]);
    }

    public function showBookings(int $userId): View
    {
        Gate::authorize('admin');
        return view('users.show-bookings', ['user' => User::find($userId), 'bookings' => User::find($userId)->bookings]);
    }

    public function deleteBooking(int $userId, int $bookId): RedirectResponse
    {
        Gate::authorize('admin');

        $booking = Booking::find($bookId);
        if($booking){
            $booking->delete();
            return redirect()->route('users.showBookings', ['id' => $userId])->with('resultMessage', 'Бронирование удалено!');
        } else {
            return redirect()->route('users.showBookings', ['id' => $userId])->with('errorMessage', 'Запись отсутствует');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
