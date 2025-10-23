<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Theater;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('theater')->get();
        return view('backend.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $theaters = Theater::all();
        return view('backend.rooms.create', compact('theaters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:128',
            'theater_id' => 'required|exists:theaters,theater_id',
        ]);

        Room::create($request->all());

        return redirect()->route('rooms.index')
            ->with('success', 'Room created successfully.');
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        $theaters = Theater::all();
        return view('backend.rooms.edit', compact('room', 'theaters'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:128',
            'theater_id' => 'required|exists:theaters,theater_id',
        ]);

        $room = Room::findOrFail($id);
        $room->update($request->all());

        return redirect()->route('rooms.index')
            ->with('success', 'Room updated successfully.');
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect()->route('rooms.index')
            ->with('success', 'Room deleted successfully.');
    }

    public function seats(Request $request, $id)
    {
        // Nếu muốn lọc theo showtime, lấy từ query string
        $showtimeId = $request->query('showtime_id');

        $room = Room::with(['seats.seatStatuses' => function ($q) use ($showtimeId) {
            if ($showtimeId) {
                $q->where('showtime_id', $showtimeId); // chỉ lấy trạng thái theo suất chiếu
            }
        }])->findOrFail($id);

        $seats = $room->seats->map(function ($seat) {
            // Lấy trạng thái ghế nếu có, mặc định 'available'
            $status = $seat->seatStatuses->first();
            return [
                'seat_number' => $seat->seat_number,
                'seat_type'   => $seat->seat_type,
                'status'      => $status->status ?? 'available',
            ];
        });

        return response()->json([
            'room_name' => $room->name,
            'seats'     => $seats,
        ]);
    }
}
