<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Room;

class ShowRoomController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $roomId)
    {
        $room = Room::with(['images', 'amenities'])->findOrFail($roomId);

        return view('room', compact('room'));
    }
}
