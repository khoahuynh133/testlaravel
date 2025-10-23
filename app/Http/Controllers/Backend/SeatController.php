<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Seat;
use App\Models\Room;
use Illuminate\Http\Request;


class SeatController extends Controller
{
    public function index()
    {
        $seats = Seat::with('room.theater')->get();
        return view('backend.seats.index', compact('seats'));
    }

    public function create()
    {
        $rooms = Room::with('theater')->get();
        return view('backend.seats.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,room_id',
            'seat_number' => 'required|integer',
            'seat_type' => 'required|in:standard,vip',
        ]);

        Seat::create($request->all());

        return redirect()->route('seats.index')
            ->with('success', 'Seat created successfully.');
    }

    public function storeMultiple(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,room_id',
            'rows' => 'required|integer|min:1|max:26',
            'columns' => 'required|integer|min:1|max:50',
            'seat_type' => 'required|in:standard,vip',
        ]);

        $room_id = $request->room_id;
        $rows = $request->rows;
        $columns = $request->columns;
        $seat_type = $request->seat_type;

        $letters = range('A', 'Z');
        $seats = [];

        for ($i = 0; $i < $rows; $i++) {
            $rowLetter = $letters[$i];
            for ($j = 1; $j <= $columns; $j++) {
                $seats[] = [
                    'room_id' => $room_id,
                    'seat_number' => $rowLetter . $j,
                    'seat_type' => $seat_type,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert ghế
        Seat::insert($seats);

        // Lấy ghế vừa tạo
        $seatRecords = Seat::where('room_id', $room_id)
            ->whereIn('seat_number', array_map(fn($s) => $s['seat_number'], $seats))
            ->get();

        // Tạo SeatStatus mặc định
        $seatStatusData = [];
        foreach ($seatRecords as $seat) {
            $seatStatusData[] = [
                'seat_id' => $seat->seat_id,
                'status' => 'available',
                'showtime_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        \DB::table('seat_status')->insert($seatStatusData);

        return redirect()->route('seats.index')
            ->with('success', 'Tạo ghế và trạng thái thành công!');
    }




    public function edit($id)
    {
        $seat = Seat::findOrFail($id);
        $rooms = Room::with('theater')->get();
        return view('backend.seats.edit', compact('seat', 'rooms'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,room_id',
            'seat_number' => 'required|integer',
            'seat_type' => 'required|in:standard,vip',
        ]);

        $seat = Seat::findOrFail($id);
        $seat->update($request->all());

        return redirect()->route('seats.index')
            ->with('success', 'Seat updated successfully.');
    }

    public function destroy($id)
    {
        $seat = Seat::findOrFail($id);
        $seat->delete();

        return redirect()->route('seats.index')
            ->with('success', 'Seat deleted successfully.');
    }
}
