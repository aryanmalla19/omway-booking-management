<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $bookings = Booking::with('room')
            ->where('user_id', auth()->id())
            ->paginate(10);

        return view('user.dashboard', compact('bookings'));
    }
}
