<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/admin', function () {
    return redirect()->route('dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::get('/dashboard', function () {
    return view('backend.layouts.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

require 'v1/auth.php';
require 'v1/user.php';
require 'v1/settings/mail.php';
require 'v1/booking.php';
