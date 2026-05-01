<?php

use App\Http\Controllers\Api\V1\Booking\BookingController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/bookings', [BookingController::class, 'store'])->name('api.v1.bookings.store');
});

