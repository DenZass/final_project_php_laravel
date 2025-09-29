<?php

namespace App\View\Components\Hotels;

use App\Models\Hotel;
use Illuminate\View\Component;
use Illuminate\View\View;

class HotelCard extends Component
{
    public Hotel $hotel;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($hotel)
    {
        $this->hotel = $hotel;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): View
    {
        return view('components.hotels.hotel-card');
    }
}
