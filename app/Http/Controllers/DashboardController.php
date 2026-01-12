<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $bookings = Booking::with(['room', 'user'])
            ->latest()
            ->paginate(10);

        return view('dashboard', compact('bookings'));
    }
}
