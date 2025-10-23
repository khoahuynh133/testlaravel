<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tickets')->insertOrIgnore([
            ['ticket_id' => 1, 'user_id' => 2, 'showtime_id' => 1, 'seat_id' => 1, 'price' => 80000.00, 'booking_time' => now(), 'status' => 'paid', 'created_at' => now(), 'updated_at' => now()],
            ['ticket_id' => 2, 'user_id' => 3, 'showtime_id' => 2, 'seat_id' => 2, 'price' => 90000.00, 'booking_time' => now(), 'status' => 'paid', 'created_at' => now(), 'updated_at' => now()],
            ['ticket_id' => 3, 'user_id' => 2, 'showtime_id' => 3, 'seat_id' => 4, 'price' => 75000.00, 'booking_time' => now(), 'status' => 'pending', 'created_at' => now(), 'updated_at' => now()],
            ['ticket_id' => 4, 'user_id' => 1, 'showtime_id' => 5, 'seat_id' => 7, 'price' => 70000.00, 'booking_time' => now(), 'status' => 'paid', 'created_at' => now(), 'updated_at' => now()],
            ['ticket_id' => 5, 'user_id' => 3, 'showtime_id' => 6, 'seat_id' => 8, 'price' => 70000.00, 'booking_time' => now(), 'status' => 'cancelled', 'created_at' => now(), 'updated_at' => now()],
            ['ticket_id' => 6, 'user_id' => 2, 'showtime_id' => 7, 'seat_id' => 10, 'price' => 85000.00, 'booking_time' => now(), 'status' => 'paid', 'created_at' => now(), 'updated_at' => now()],
            ['ticket_id' => 7, 'user_id' => 3, 'showtime_id' => 8, 'seat_id' => 9, 'price' => 78000.00, 'booking_time' => now(), 'status' => 'paid', 'created_at' => now(), 'updated_at' => now()],
            ['ticket_id' => 8, 'user_id' => 2, 'showtime_id' => 9, 'seat_id' => 3, 'price' => 72000.00, 'booking_time' => now(), 'status' => 'paid', 'created_at' => now(), 'updated_at' => now()],
            ['ticket_id' => 9, 'user_id' => 1, 'showtime_id' => 4, 'seat_id' => 5, 'price' => 75000.00, 'booking_time' => now(), 'status' => 'paid', 'created_at' => now(), 'updated_at' => now()],
            ['ticket_id' => 10, 'user_id' => 3, 'showtime_id' => 10, 'seat_id' => 6, 'price' => 80000.00, 'booking_time' => now(), 'status' => 'pending', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
