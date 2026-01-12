<?php

use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShowBookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/bookings/{roomId}', ShowBookingController::class)
    ->name('bookings.room');

Route::post('bookings/{roomId}', BookingController::class)
    ->name('bookings.store');

Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('isAdmin')->group(function () {
    Route::put('/bookings/{bookingId}/approve', [AdminBookingController::class, 'edit'])
        ->name('bookings.approve');

    Route::put('/bookings/{bookingId}/reject', [AdminBookingController::class, 'edit'])
        ->name('bookings.reject');

    Route::delete('/bookings/{bookingId}', [AdminBookingController::class, 'destroy'])
        ->name('bookings.destroy');

    Route::resource('rooms', RoomController::class)->names('rooms');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
