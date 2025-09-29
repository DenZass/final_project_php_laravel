<?php

namespace App\View\Components\Users;

use Illuminate\View\Component;
use Illuminate\View\View;

class BookingCardUser extends Component
{
    public $booking;
    public $userId;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($booking, $userId)
    {
        $this->booking = $booking;
        $this->userId = $userId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): View
    {
        return view('components.users.booking-card-user');
    }
}
