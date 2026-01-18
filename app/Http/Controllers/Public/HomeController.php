<?php

namespace App\Http\Controllers\Public;

use App\Enums\RoomStatus;
use App\Http\Controllers\Controller;
use App\Models\Room;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $rooms = Room::with(['images'])
            ->where('status', RoomStatus::AVAILABLE->value)
            ->latest()
            ->limit(5)
            ->get();

        return view('welcome', compact('rooms'));
    }
}
