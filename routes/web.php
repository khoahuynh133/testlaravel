<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Frontend\NowShowingController;
use App\Http\Controllers\Frontend\ComingSoonMovieController;
use App\Http\Controllers\Frontend\MovieController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Đây là nơi khai báo tất cả các route của ứng dụng.
| Mặc định nhóm này dùng middleware "web".
|
*/

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/phim-dang-chieu', [HomeController::class, 'home'])->name('now_showing_movie');
Route::get('/phim-sap-chieu', [HomeController::class, 'home'])->name('coming_soon_movie');
Route::get('/dat-ve/{slug}/', [MovieController::class, 'showBooking'])->name('movie.booking');
// ===================== PHẦN ĐƯỢC BẢO VỆ =====================
Route::middleware(['auth', 'verified', 'is_admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    //     ->name('admin.dashboard');
    Route::resource('admin/movies', \App\Http\Controllers\Backend\MovieController::class)->names('movies');
    Route::resource('admin/theaters', \App\Http\Controllers\Backend\TheaterController::class)->names('theaters');
    Route::resource('admin/rooms', \App\Http\Controllers\Backend\RoomController::class)->names('rooms');
    Route::get('admin/rooms/{room}/seats', [\App\Http\Controllers\Backend\RoomController::class, 'seats'])
        ->name('rooms.seats');
    // routes/web.php
    Route::post('admin/seats/store-multiple', [\App\Http\Controllers\Backend\SeatController::class, 'storeMultiple'])->name('seats.store_multiple');

    Route::resource('admin/showtimes', \App\Http\Controllers\Backend\ShowTimeController::class)->names('showtimes');
    Route::resource('admin/seats', \App\Http\Controllers\Backend\SeatController::class)->names('seats');
    Route::resource('admin/users', \App\Http\Controllers\Backend\UserController::class)->names('users');
    Route::resource('admin/tickets', \App\Http\Controllers\Backend\TicketController::class)->names('tickets');
    Route::post('admin/tickets/{ticket}/receive', [\App\Http\Controllers\Backend\TicketController::class, 'receive'])->name('tickets.receive');
});

// ===================== PROFILE NGƯỜI DÙNG =====================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\BookingController;

Route::get('/booking', [BookingController::class, 'index'])->name('booking')->middleware('auth');
require __DIR__ . '/auth.php';
