<?php

use App\Http\Controllers\Api\DeleteHotelController as ApiDeleteHotelController;
use Illuminate\Support\Facades\Route;

Route::delete('api/hotels/delete/{id}', [ApiDeleteHotelController::class])->name('api.hotels.delete');