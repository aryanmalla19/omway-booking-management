<?php

namespace App\Http\Controllers\Admin;

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
        $bookings = Booking::with(['room', 'user'])
            ->latest()
            ->paginate(10);

        return view('admin.dashboard', compact('bookings'));
    }
}
