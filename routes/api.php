<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookingController;

// use App\Http\Controllers\BookingController;

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


// API routes cho đặt vé
Route::get('/api/seats/{movieId}', [BookingController::class, 'getSeatsByMovie']);
Route::get('/api/showtimes/{movieId}', [BookingController::class, 'getShowtimesByDate']);
Route::get('/seats/{movieId}/{showtimeId}', [BookingController::class, 'getSeatsByShowtime']);
Route::post('/api/book-ticket', [BookingController::class, 'bookTicket']);
Route::get('/api/dates/{movieId}', [BookingController::class, 'getDatesByMovie']);
Route::get('/dates/{movieId}', [BookingController::class, 'getDatesByMovie']); // ✅ Thêm dòng này
Route::get('/showtimes/{movieId}', [BookingController::class, 'getShowtimesByDate']); // ✅ Thêm dòng này



// routes/api.php
Route::get('/theater-systems/{movieId}', [BookingController::class, 'getTheaterSystemsByDate']);
Route::get('/theaters/{theaterSystemId}', [BookingController::class, 'getTheatersBySystem']);
Route::get('/rooms/{theaterId}', [BookingController::class, 'getRoomsByTheater']);
Route::get('/showtimes-by-room/{roomId}', [BookingController::class, 'getShowtimesByRoomAndDate']);
