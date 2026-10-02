<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});
 
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('tickets', TicketController::class)
        ->only(['index', 'create', 'store', 'show']);
});

require __DIR__.'/settings.php';
