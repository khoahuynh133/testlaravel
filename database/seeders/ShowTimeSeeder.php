<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShowTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('showtimes')->insert([
            ['showtime_id' => 1, 'movie_id' => 1, 'room_id' => 1, 'start_time' => '10:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['showtime_id' => 2, 'movie_id' => 1, 'room_id' => 1, 'start_time' => '13:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['showtime_id' => 3, 'movie_id' => 2, 'room_id' => 4, 'start_time' => '11:30:00', 'created_at' => now(), 'updated_at' => now()],
            ['showtime_id' => 4, 'movie_id' => 2, 'room_id' => 5, 'start_time' => '16:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['showtime_id' => 5, 'movie_id' => 3, 'room_id' => 7, 'start_time' => '19:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['showtime_id' => 6, 'movie_id' => 3, 'room_id' => 8, 'start_time' => '09:30:00', 'created_at' => now(), 'updated_at' => now()],
            ['showtime_id' => 7, 'movie_id' => 1, 'room_id' => 10, 'start_time' => '14:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['showtime_id' => 8, 'movie_id' => 2, 'room_id' => 6, 'start_time' => '17:30:00', 'created_at' => now(), 'updated_at' => now()],
            ['showtime_id' => 9, 'movie_id' => 3, 'room_id' => 9, 'start_time' => '20:30:00', 'created_at' => now(), 'updated_at' => now()],
            ['showtime_id' => 10, 'movie_id' => 1, 'room_id' => 2, 'start_time' => '12:00:00', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
