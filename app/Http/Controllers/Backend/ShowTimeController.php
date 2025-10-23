<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShowTime;
use App\Models\Movie;
use App\Models\Room;
use App\Models\Seat;
use App\Models\SeatStatus;
use Illuminate\Http\Request;

class ShowTimeController extends Controller
{
    public function index()
    {
        $showtimes = ShowTime::with('movie', 'room.theater')->get();
        return view('backend.showtimes.index', compact('showtimes'));
    }

    public function create()
    {
        $movies = Movie::all();
        $rooms = Room::with('theater')->get();
        return view('backend.showtimes.create', compact('movies', 'rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,movie_id',
            'room_id' => 'required|exists:rooms,room_id',
            'show_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'price' => 'required|numeric',
        ]);

        // 1️⃣ Tạo showtime
        $showtime = ShowTime::create($request->all());

        // 2️⃣ Lấy tất cả ghế trong phòng của showtime
        $seats = Seat::where('room_id', $showtime->room_id)->get();

        // 3️⃣ Tạo seat_status cho mỗi ghế
        foreach ($seats as $seat) {
            SeatStatus::create([
                'seat_id' => $seat->seat_id,
                'showtime_id' => $showtime->showtime_id,
                'status' => 'available',
            ]);
        }

        return redirect()->route('showtimes.index')
            ->with('success', 'Showtime created successfully with seat statuses.');
    }

    public function edit($id)
    {
        $showtime = ShowTime::findOrFail($id);
        $movies = Movie::all();
        $rooms = Room::with('theater')->get();
        return view('backend.showtimes.edit', compact('showtime', 'movies', 'rooms'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,movie_id',
            'room_id' => 'required|exists:rooms,room_id',
            'show_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'price' => 'required|numeric',
        ]);

        $showtime = ShowTime::findOrFail($id);
        $showtime->update($request->all());

        return redirect()->route('showtimes.index')
            ->with('success', 'Showtime updated successfully.');
    }

    public function destroy($id)
    {
        $showtime = ShowTime::findOrFail($id);
        $showtime->delete();

        return redirect()->route('showtimes.index')
            ->with('success', 'Showtime deleted successfully.');
    }
}
