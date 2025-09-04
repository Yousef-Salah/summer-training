<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\NavBarSetBackgroundColor;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{hotel}/view', [HotelController::class, 'show'])->name('hotels.show');

Route::post('/navbar/set-background', NavBarSetBackgroundColor::class)->name('navbar.set-background');

