<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
use App\Enums\RoomStatus;
use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Mockery\Exception;

class BookingController extends Controller
{
    public function __invoke(StoreBookingRequest $request, string $roomId)
    {
        try {
            $data = $request->validated();

            $room = Room::findOrFail($roomId);

            if($room->status === RoomStatus::BOOKED) {
                throw new Exception('The Room is already Booked');
            }

            $checkIn  = Carbon::parse($data['check_in']);
            $checkOut = Carbon::parse($data['check_out']);

            $totalDays = $checkIn->diffInDays($checkOut);

            $totalPrice = $totalDays * $room->price_per_day;

            Booking::create([
                'check_in' => $data['check_in'],
                'check_out' => $data['check_out'],
                'total_days' => $totalDays,
                'total_price' => $totalPrice,
                'room_id' => $room->id,
                'user_id' => auth()->id(),
                'status' => BookingStatus::PENDING->value,
            ]);

            return redirect()->route('home')->with('success', 'Successfully booked');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
