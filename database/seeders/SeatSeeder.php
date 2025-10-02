<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Giả sử mỗi phòng có 5 hàng (A–E), mỗi hàng 10 ghế
        $rows = ['A', 'B', 'C', 'D', 'E'];
        $seatsPerRow = 10;

        // Lấy tất cả room_id từ bảng rooms
        $rooms = DB::table('rooms')->pluck('room_id');

        $data = [];

        foreach ($rooms as $roomId) {
            foreach ($rows as $row) {
                for ($i = 1; $i <= $seatsPerRow; $i++) {
                    $data[] = [
                        'room_id'     => $roomId,
                        'seat_number' => $row . $i, // VD: A1, A2, B3...
                        'status'      => 'available',
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ];
                }
            }
        }

        DB::table('seats')->insert($data);
    }
}
