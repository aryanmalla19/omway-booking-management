<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BookingStatus;
use App\Enums\RoomStatus;
use App\Exceptions\InvalidBookingStatusException;
use App\Exceptions\RoomUnavailableException;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Mockery\Exception;

class BookingController extends Controller
{
    public function approve(string $bookingId)
    {
        try {
            $booking = Booking::findOrFail($bookingId);

            if ($booking->status !== BookingStatus::PENDING) {
                throw new InvalidBookingStatusException("Booking already in " . $booking?->status);
            }

            if ($booking->room->status !== RoomStatus::AVAILABLE) {
                throw new RoomUnavailableException('The room is not currently available');
            }

            $booking->update([
                'status' => BookingStatus::APPROVED,
            ]);

            $booking->room->update([
                'status' => RoomStatus::BOOKED,
            ]);

            return redirect()->back()->with('success', 'Successfully approved booking');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }  catch (\Throwable $throwable) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function reject(string $bookingId)
    {
        try {
            $booking = Booking::findOrFail($bookingId);

            if ($booking->status !== BookingStatus::PENDING) {
                throw new InvalidBookingStatusException("Booking already in " . $booking?->status);
            }

            $booking->update([
                'status' => BookingStatus::REJECTED,
            ]);

            return redirect()->back()->with('success', 'Successfully rejected booking');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }  catch (\Throwable $throwable) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
