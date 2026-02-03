<?php

use App\Http\Controllers\Api\FlightController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/books', function () {
    return response()->json([
        'message' => 'API IS WORKING'
    ]);
});

use App\Http\Controllers\Api\BookingController;

Route::get('/flights', [FlightController::class, 'index']);
Route::post('/flights', [FlightController::class, 'store']);
Route::get('/flights/{flight}', [FlightController::class, 'show']);
Route::put('/flights/{flight}', [FlightController::class, 'update']);
Route::delete('/flights/{flight}', [FlightController::class, 'destroy']);
Route::post('/flights/{flight}/book', [BookingController::class, 'store']);
//Route::apiResource('', FlightController::class);