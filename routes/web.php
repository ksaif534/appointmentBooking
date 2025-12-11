<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/our-services', [PageController::class, 'services'])->name('public.services');

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('appointments', \App\Http\Controllers\AppointmentController::class);
    Route::resource('services', \App\Http\Controllers\ServiceController::class);
    Route::resource('staff-details', \App\Http\Controllers\StaffDetailController::class);
    Route::resource('staff-services', \App\Http\Controllers\StaffServiceController::class);
    Route::resource('staff-availabilities', \App\Http\Controllers\StaffAvailabilityController::class);
    
    // Booking Routes
    Route::get('/book', [\App\Http\Controllers\BookingController::class, 'index'])->name('booking.index');
    Route::get('/book/{service}', [\App\Http\Controllers\BookingController::class, 'create'])->name('booking.create');
    Route::post('/book', [\App\Http\Controllers\BookingController::class, 'store'])->name('booking.store');
});

require __DIR__.'/auth.php';
