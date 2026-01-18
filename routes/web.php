<?php

use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\ShowRoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/bookings/{roomId}', ShowRoomController::class)->name('bookings.room');

Route::post('bookings/{roomId}', BookingController::class)->name('bookings.store');

// Admin Route
Route::middleware(['isAdmin', 'auth'])->prefix('admin')->group(function () {

    Route::put('/bookings/{bookingId}/approve', [AdminBookingController::class, 'approve'])
        ->name('bookings.approve');

    Route::put('/bookings/{bookingId}/reject', [AdminBookingController::class, 'reject'])
        ->name('bookings.reject');

    Route::get('/dashboard', AdminDashboardController::class)->name('admin.dashboard');

    Route::resource('rooms', RoomController::class)->names('rooms');
    Route::resource('amenities', AmenityController::class)->names('amenities');
});

Route::middleware(['auth', 'isUser'])->prefix('user')->group(function () {
    Route::get('/dashboard', UserDashboardController::class)->name('user.dashboard');
});


// Auth Routes - User & Admin
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
