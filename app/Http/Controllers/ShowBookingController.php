<?php

namespace App\Http\Controllers;

use App\Models\Room;

class ShowBookingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $roomId)
    {
        $room = Room::with('images')->findOrFail($roomId);

        return view('detail', compact('room'));
    }
}
