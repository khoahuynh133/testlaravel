<?php

use App\Http\Controllers\Backend\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BookingAPIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/theaters', [BookingAPIController::class, 'theaters']);
Route::get('/movies', [BookingAPIController::class, 'movies']); // ?theater_id=1
Route::get('/showtimes', [BookingAPIController::class, 'showtimes']); // ?movie_id=1&theater_id=1&date=2025-10-23
Route::get('/seats', [BookingAPIController::class, 'seats']); // ?showtime_id=1
// routes/api.php
Route::post('/tickets', [TicketController::class, 'store']);

// nếu cần mở public, bỏ auth middleware
