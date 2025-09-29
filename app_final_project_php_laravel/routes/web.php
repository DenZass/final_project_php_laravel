<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\FacilitieController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
    Route::get('/hotels/{id}', [HotelController::class, 'show'])->where('id', '[0-9]+')->name('hotels.show');
    Route::get('/hotel/create', [HotelController::class, 'showFormCreate'])->name('hotels.showFormCreate');
    Route::post('/hotel/create', [HotelController::class, 'create'])->name('hotels.create');
    Route::get('/hotels/{id}/update', [HotelController::class, 'showFormUpdate'])->where('id', '[0-9]+')->name('hotels.showFormUpdate');
    Route::post('/hotels/{id}/update', [HotelController::class, 'update'])->where('id', '[0-9]+')->name('hotels.update');
    Route::get('/hotels/{id}/delete', [HotelController::class, 'delete'])->where('id', '[0-9]+')->name('hotels.delete');
    Route::get('/hotels/{id}/bookings', [HotelController::class, 'showBookings'])->where('id', '[0-9]+')->name('hotels.showBookings');
    Route::get('/hotels/{hotelId}/bookings/{bookId}/delete', [HotelController::class, 'deleteBooking'])
        ->where([
            'hotelId' => '[0-9]+',
            'bookId' => '[0-9]+',
        ])->name('hotels.deleteBooking');
    Route::get('/hotels/{hotelId}/rooms/{roomId}/delete', [RoomController::class, 'delete'])
        ->where([
            'hotelId' => '[0-9]+',
            'roomId' => '[0-9]+',
        ])->name('rooms.delete');
    Route::get('/hotels/{hotelId}/rooms/{roomId}/update', [RoomController::class, 'showFormUpdate'])->where([
        'hotelId' => '[0-9]+',
        'roomId' => '[0-9]+',
    ])->name('rooms.showFormUpdate');
    Route::post('/hotels/{hotelId}/rooms/{roomId}/update', [RoomController::class, 'update'])->where([
        'hotelId' => '[0-9]+',
        'roomId' => '[0-9]+',
    ])->name('rooms.update');

    Route::get('/hotels/{hotelId}/rooms/create', [RoomController::class, 'showFormCreate'])->where(['hotelId' => '[0-9]+'])->name('rooms.showFormCreate');
    Route::post('/hotels/{hotelId}/rooms/create', [RoomController::class, 'create'])->where(['hotelId' => '[0-9]+'])->name('rooms.create');

    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{id}', [BookingController::class, 'show'])->where('id', '[0-9]+')->name('bookings.show');
    Route::post('/da', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{id}/delete', [BookingController::class, 'delete'])->where(['id' => '[0-9]+'])->name('bookings.delete');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/bookings', [UserController::class, 'showBookings'])->where('id', '[0-9]+')->name('users.showBookings');
    Route::get('/users/{userId}/bookings/{bookId}/delete', [UserController::class, 'deleteBooking'])
        ->where([
            'userId' => '[0-9]+',
            'bookId' => '[0-9]+',
            ])->name('users.deleteBooking');

    Route::get('/facilities', [FacilitieController::class, 'index'])->name('facilities.index');
    Route::get('/facilities/create', [FacilitieController::class, 'showFormCreate'])->name('facilities.showFormCreate');
    Route::post('/facilities/create', [FacilitieController::class, 'create'])->name('facilities.create');
    Route::get('/facilities/{id}/update', [FacilitieController::class, 'showFormUpdate'])->where('id', '[0-9]+')->name('facilities.showFormUpdate');
    Route::post('/facilities/{id}/update', [FacilitieController::class, 'update'])->where('id', '[0-9]+')->name('facilities.update');
    Route::get('/facilities/{id}/delete', [FacilitieController::class, 'delete'])->where('id', '[0-9]+')->name('facilities.delete');
});

require __DIR__.'/auth.php';

