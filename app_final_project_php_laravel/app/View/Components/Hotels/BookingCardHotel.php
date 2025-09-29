<?php

namespace App\View\Components\Hotels;

use Illuminate\View\Component;
use Illuminate\View\View;

class BookingCardHotel extends Component
{
    public $booking;
    public $hotelId;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($booking, $hotelId)
    {
        $this->booking = $booking;
        $this->hotelId = $hotelId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): View
    {
        return view('components.hotels.booking-card-hotel');
    }
}
