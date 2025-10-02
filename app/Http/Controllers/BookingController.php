<?php

namespace App\Http\Controllers;

use App\Models\ShowTime;
use App\Models\Room;
use App\Models\Seat;
use App\Models\SeatStatus;
use App\Models\Ticket;
use App\Models\TicketDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // ✅ Thêm dòng này

class BookingController extends Controller
{
    // Hàm cũ - có thể giữ lại nếu cần dùng cho nơi khác
    public function getSeatsByMovie($movieId)
    {
        // Lấy suất chiếu đầu tiên của phim (có thể thay bằng logic chọn suất theo ngày, giờ)
        $showtime = ShowTime::where('movie_id', $movieId)
            ->orderBy('start_time', 'asc')
            ->first();

        if (!$showtime) {
            return response()->json([
                'message' => 'Không tìm thấy suất chiếu cho phim này.',
                'seats' => [],
                'showtime' => null,
            ], 404);
        }

        // Lấy danh sách ghế trong phòng của suất chiếu này
        $room = Room::find($showtime->room_id);

        if (!$room) {
            return response()->json([
                'message' => 'Phòng chiếu không tồn tại.',
                'seats' => [],
                'showtime' => null,
            ], 404);
        }

        $seats = $room->seats;

        // Lấy trạng thái ghế (đã đặt hay chưa) từ bảng `seat_status` cho suất chiếu này
        $bookedSeats = SeatStatus::where('showtime_id', $showtime->showtime_id)
            ->where('status', 'booked')  // ✅ Thêm điều kiện này
            ->pluck('seat_id')
            ->toArray();

        $seatData = $seats->map(function ($seat) use ($bookedSeats) {
            return [
                'id' => $seat->seat_id,
                'number' => $seat->seat_number,
                'type' => $seat->seat_type ?? 'normal', // Ví dụ: normal, vip, couple
                'status' => in_array($seat->seat_id, $bookedSeats) ? 'booked' : 'available',
            ];
        });

        return response()->json([
            'message' => 'Dữ liệu ghế đã được tải thành công.',
            'seats' => $seatData,
            'showtime' => [
                'showtime_id' => $showtime->showtime_id,
                'start_time' => $showtime->start_time,
                'room_name' => $room->name,
            ],
            'movie_id' => $movieId,
        ]);
    }

    // ✅ Thêm hàm mới: Lấy danh sách suất chiếu theo ngày
    public function getShowtimesByDate($movieId, Request $request)
    {
        $date = $request->query('date'); // YYYY-MM-DD

        if (!$date) {
            return response()->json(['message' => 'Vui lòng chọn ngày.'], 400);
        }

        $showtimes = ShowTime::where('movie_id', $movieId)
            ->whereDate('start_time', $date)
            ->get(['showtime_id', 'start_time']);

        return response()->json([
            'showtimes' => $showtimes,
        ]);
    }

    // ✅ Thêm hàm mới: Lấy ghế theo suất chiếu
    public function getSeatsByShowtime($movieId, $showtimeId)
    {
        $showtime = ShowTime::where('movie_id', $movieId)
            ->where('showtime_id', $showtimeId)
            ->first();

        if (!$showtime) {
            return response()->json([
                'message' => 'Suất chiếu không tồn tại.',
                'seats' => [],
            ], 404);
        }

        $room = Room::find($showtime->room_id);
        if (!$room) {
            return response()->json([
                'message' => 'Phòng chiếu không tồn tại.',
                'seats' => [],
            ], 404);
        }

        $seats = $room->seats;

        // ✅ CHỈ LẤY NHỮNG GHẾ ĐÃ ĐƯỢC ĐẶT (booked)
        $bookedSeats = SeatStatus::where('showtime_id', $showtimeId)
            ->where('status', 'booked')  // ✅ Đảm bảo dòng này có
            ->pluck('seat_id')
            ->toArray();

        $seatData = $seats->map(function ($seat) use ($bookedSeats) {
            return [
                'id' => $seat->seat_id,
                'number' => $seat->seat_number,
                'type' => $seat->seat_type ?? 'standard',
                'status' => in_array($seat->seat_id, $bookedSeats) ? 'booked' : 'available', // ✅ Logic đúng
                'price' => 80000,
            ];
        });

        return response()->json([
            'message' => 'Dữ liệu ghế đã được tải thành công.',
            'seats' => $seatData,
            'showtime' => [
                'showtime_id' => $showtime->showtime_id,
                'start_time' => $showtime->start_time,
                'room_name' => $room->name,
            ],
            'movie_id' => $movieId,
        ]);
    }

    // Lấy hệ thống rạp theo ngày và phim
    // app/Http/Controllers/BookingController.php

    public function getTheaterSystemsByDate($movieId, Request $request)
    {
        $date = $request->query('date');
        if (!$date) {
            return response()->json(['message' => 'Vui lòng chọn ngày.'], 400);
        }

        // Lấy các suất chiếu theo ngày và phim
        $showtimeIds = ShowTime::where('movie_id', $movieId)
            ->whereDate('start_time', $date)
            ->pluck('showtime_id');

        // Lấy các room_id từ các suất chiếu
        $roomIds = ShowTime::whereIn('showtime_id', $showtimeIds)->pluck('room_id');

        // Lấy các theater_systems_id từ các room
        $theaterSystemIds = Room::whereIn('room_id', $roomIds)
            ->pluck('theater_systems_id')
            ->unique();

        // Lấy tên hệ thống rạp
        $theaterSystems = DB::table('theater_systems')
            ->whereIn('theater_systems_id', $theaterSystemIds)
            ->get(['theater_systems_id', 'name']);

        return response()->json(['theater_systems' => $theaterSystems]);
    }

    public function getTheatersBySystem($theaterSystemId)
    {
        $theaters = DB::table('theaters')
            ->where('theater_systems_id', $theaterSystemId)
            ->get(['theater_id', 'name']);

        return response()->json(['theaters' => $theaters]);
    }

    // Lấy danh sách phòng theo rạp
    public function getRoomsByTheater($theaterId)
    {
        $rooms = DB::table('rooms')
            ->where('theater_id', $theaterId)
            ->get(['room_id', 'name']);

        return response()->json(['rooms' => $rooms]);
    }

    // Lấy suất chiếu theo phòng và ngày
    public function getShowtimesByRoomAndDate($roomId, Request $request)
    {
        $date = $request->query('date');

        $showtimes = ShowTime::where('room_id', $roomId)
            ->whereDate('start_time', $date)
            ->get(['showtime_id', 'start_time']);

        return response()->json(['showtimes' => $showtimes]);
    }

    // Tương tự cho các API khác: theaters, rooms, showtimes

    // Hàm đặt vé (nếu bạn cần)
    public function bookTicket(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'payment_method' => 'required|in:momo,card',
            'seat_ids' => 'required|array',
            'seat_ids.*' => 'integer|exists:seats,seat_id',
            'movie_id' => 'required|exists:movies,movie_id',
            'showtime_id' => 'required|exists:showtimes,showtime_id',
        ]);

        if (!auth()->check()) {
            return response()->json(['message' => 'Bạn cần đăng nhập để đặt vé.'], 401);
        }

        $user = auth()->user();

        // ✅ Thêm booking_time
        $ticket = Ticket::create([
            'user_id' => $user->id,
            'showtime_id' => $request->showtime_id,
            'total_price' => 0,
            'status' => 'pending',
            'booking_time' => now(), // ✅ Thêm dòng này
        ]);

        $totalPrice = 0;

        // Tạo chi tiết vé và cập nhật trạng thái ghế
        foreach ($request->seat_ids as $seatId) {
            $ticketDetail = new TicketDetail([
                'ticket_id' => $ticket->ticket_id,
                'seat_id' => $seatId,
                'price' => 80000,
            ]);
            $ticket->ticketDetails()->save($ticketDetail);

            $totalPrice += 80000;

            // Cập nhật trạng thái ghế
            SeatStatus::updateOrCreate(
                [
                    'seat_id' => $seatId,
                    'showtime_id' => $request->showtime_id
                ],
                [
                    'status' => 'booked',
                    'user_id' => $user->id
                ]
            );
        }

        // Cập nhật lại tổng tiền
        $ticket->update(['total_price' => $totalPrice]);

        return response()->json(['message' => 'Đặt vé thành công!']);
    }

    public function getDatesByMovie($movieId)
    {
        $dates = ShowTime::where('movie_id', $movieId)
            ->selectRaw('DATE(start_time) as date')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get(['date']);

        return response()->json([
            'dates' => $dates->pluck('date')->toArray(),
        ]);
    }
}
