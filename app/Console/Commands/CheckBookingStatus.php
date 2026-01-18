<?php

namespace App\Console\Commands;

use App\Enums\BookingStatus;
use App\Enums\RoomStatus;
use App\Models\Booking;
use Illuminate\Console\Command;

class CheckBookingStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-booking';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Booking Status';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        // This should be a job but I wrote code here
        $bookings = Booking::with('room')->where([
            'status' => BookingStatus::APPROVED,
            'is_checked_out' => false,
        ])
            ->wherePast('check_out')
            ->get();

        foreach ($bookings as $booking) {
            $booking->update([
                'is_checked_out' => true,
            ]);

            if ($booking->room->status !== RoomStatus::AVAILABLE) {
                $booking->room->update([
                    'status' => RoomStatus::AVAILABLE,
                ]);
            }
        }

        $this->info('Expired bookings processed successfully.');
    }
}
