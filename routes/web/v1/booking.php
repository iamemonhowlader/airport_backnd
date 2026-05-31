<?php

use App\Http\Controllers\Web\V1\Booking\BookingController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin/bookings')
    ->name('admin.bookings.')
    ->middleware('auth')
    ->controller(BookingController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{booking}', 'show')->name('show');
        Route::patch('/{booking}/status', 'updateStatus')->name('updateStatus');
        Route::delete('/{booking}', 'destroy')->name('destroy');
    });

