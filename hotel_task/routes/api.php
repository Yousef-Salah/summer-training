<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckAccountVerification;
use App\Http\Controllers\Api\DeleteHotelController as ApiDeleteHotelController;


// Assumes auth:sanctum/authentication middleware is applied

// Route::middlware('verification.account' or you can use App\Http\Middleware\CheckAccountVerification)
Route::middleware(CheckAccountVerification::class)->group(function() {
    Route::delete('api/hotels/delete/{id}', [ApiDeleteHotelController::class])->name('api.hotels.delete');
});


// New Routes for auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
