<?php

namespace App\View\Components\Rooms;

use Illuminate\View\Component;
use Illuminate\View\View;

class RoomListItem extends Component
{
    public $room;
    public $adminRead;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($room, $adminRead = false)
    {
        $this->room = $room;
        $this->adminRead = $adminRead;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): View
    {
        return view('components.rooms.room-list-item');
    }
}
