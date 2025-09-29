<?php

namespace App\Providers;

use App\Services\Bookings\BookingServices;
use App\Services\Bookings\BookingServicesClass;
use App\Services\Hotels\HotelServices;
use App\Services\Hotels\HotelServicesClass;
use App\Services\Rooms\RoomServices;
use App\Services\Rooms\RoomServicesClass;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HotelServices::class, function (){
            return new HotelServicesClass();
        });
        $this->app->bind(BookingServices::class, function (){
            return new BookingServicesClass();
        });
        $this->app->bind(RoomServices::class, function (){
            return new RoomServicesClass();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
