<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BookingStatus;
use App\Enums\RoomStatus;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Mockery\Exception;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {

    }

    /**
     * @throws \Exception
     */
    public function approve(string $bookingId)
    {
        try {
            $booking = Booking::findOrFail($bookingId);

            if ($booking->status !== BookingStatus::PENDING) {
                throw new \Exception("Booking already in " . $booking?->status);
            }

            if ($booking->room->status !== RoomStatus::AVAILABLE) {
                throw new \Exception('The room is not currently available');
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
