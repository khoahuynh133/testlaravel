<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SeatStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Lấy danh sách các seat_id, showtime_id, user_id có sẵn trong DB
        $seatIds = DB::table('seats')->pluck('seat_id')->toArray();
        $showtimeIds = DB::table('showtimes')->pluck('showtime_id')->toArray();
        $userIds = DB::table('acl_users')->pluck('id')->toArray();

        if (empty($seatIds) || empty($showtimeIds)) {
            $this->command->info('Không đủ dữ liệu trong bảng seats hoặc showtimes để tạo dữ liệu mẫu.');
            return;
        }

        $statuses = ['available', 'booked'];


        $data = [];

        // Tạo dữ liệu mẫu cho seat_status
        // Trong SeatStatusSeeder
        foreach ($showtimeIds as $showtimeId) {
            $bookedCount = 0;
            $maxBooked = rand(5, 15); // Mỗi suất chỉ có tối đa 5-15 ghế đã đặt

            foreach ($seatIds as $seatId) {
                $status = 'available';

                if ($bookedCount < $maxBooked && rand(0, 10) > 7) { // 30% khả năng booked
                    $status = 'booked';
                    $bookedCount++;
                }

                $userId = null;
                if ($status === 'booked' && !empty($userIds)) {
                    $userId = $userIds[array_rand($userIds)];
                }

                $data[] = [
                    'seat_id' => $seatId,
                    'showtime_id' => $showtimeId,
                    'status' => $status,
                    'user_id' => $userId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Chèn dữ liệu vào bảng
        DB::table('seat_status')->insert($data);
    }
}
