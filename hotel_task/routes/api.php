<?php

use App\Http\Controllers\Api\DeleteHotelController as ApiDeleteHotelController;
use App\Http\Middleware\CheckAccountVerification;
use Illuminate\Support\Facades\Route;

// Assumes auth:sanctum/authentication middleware is applied

// Route::middlware('verification.account' or you can use App\Http\Middleware\CheckAccountVerification)
Route::middleware(CheckAccountVerification::class)->group(function() {
    Route::delete('api/hotels/delete/{id}', [ApiDeleteHotelController::class])->name('api.hotels.delete');
});
