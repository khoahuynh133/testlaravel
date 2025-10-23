<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // The project uses a `seatstatus` table (not `seat_statuses`). The migration defines: seat_status_id, seat_id, showtime_id, status, id (user)
        // We'll insert a few sample seatstatus rows linking seat_id and showtime_id with statuses.
        DB::table('seat_status')->insert([
            ['seat_status_id' => 1, 'seat_id' => 1, 'showtime_id' => 1, 'status' => 'available', 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['seat_status_id' => 2, 'seat_id' => 2, 'showtime_id' => 1, 'status' => 'booked', 'user_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['seat_status_id' => 3, 'seat_id' => 3, 'showtime_id' => 2, 'status' => 'available', 'user_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['seat_status_id' => 4, 'seat_id' => 4, 'showtime_id' => 3, 'status' => 'booked', 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['seat_status_id' => 5, 'seat_id' => 5, 'showtime_id' => 3, 'status' => 'available', 'user_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['seat_status_id' => 6, 'seat_id' => 6, 'showtime_id' => 4, 'status' => 'available', 'user_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['seat_status_id' => 7, 'seat_id' => 7, 'showtime_id' => 5, 'status' => 'booked', 'user_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['seat_status_id' => 8, 'seat_id' => 8, 'showtime_id' => 6, 'status' => 'available', 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['seat_status_id' => 9, 'seat_id' => 9, 'showtime_id' => 7, 'status' => 'booked', 'user_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['seat_status_id' => 10, 'seat_id' => 10, 'showtime_id' => 8, 'status' => 'available', 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
