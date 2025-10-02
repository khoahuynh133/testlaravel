<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShowTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $showTimes = [
            // ==== Movie 1 ====
            [
                'movie_id'   => 1,
                'room_id'    => 1,
                'show_date'  => '2025-10-05',
                'start_time' => '2025-10-05 09:00:00',
                'end_time'   => '2025-10-05 11:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'movie_id'   => 1,
                'room_id'    => 2,
                'show_date'  => '2025-10-05',
                'start_time' => '2025-10-05 13:00:00',
                'end_time'   => '2025-10-05 15:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ==== Movie 2 ====
            [
                'movie_id'   => 2,
                'room_id'    => 1,
                'show_date'  => '2025-10-06',
                'start_time' => '2025-10-06 18:00:00',
                'end_time'   => '2025-10-06 20:15:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ==== Movie 3 ====
            [
                'movie_id'   => 3,
                'room_id'    => 3,
                'show_date'  => '2025-10-06',
                'start_time' => '2025-10-06 20:30:00',
                'end_time'   => '2025-10-06 23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ==== Movie 4 ====
            [
                'movie_id'   => 4,
                'room_id'    => 1,
                'show_date'  => '2025-10-07',
                'start_time' => '2025-10-07 09:00:00',
                'end_time'   => '2025-10-07 11:15:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'movie_id'   => 4,
                'room_id'    => 2,
                'show_date'  => '2025-10-07',
                'start_time' => '2025-10-07 14:00:00',
                'end_time'   => '2025-10-07 16:15:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ==== Movie 5 ====
            [
                'movie_id'   => 5,
                'room_id'    => 3,
                'show_date'  => '2025-10-08',
                'start_time' => '2025-10-08 17:00:00',
                'end_time'   => '2025-10-08 19:20:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'movie_id'   => 5,
                'room_id'    => 1,
                'show_date'  => '2025-10-08',
                'start_time' => '2025-10-08 20:00:00',
                'end_time'   => '2025-10-08 22:20:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ==== Movie 6 ====
            [
                'movie_id'   => 6,
                'room_id'    => 2,
                'show_date'  => '2025-10-09',
                'start_time' => '2025-10-09 10:00:00',
                'end_time'   => '2025-10-09 12:10:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'movie_id'   => 6,
                'room_id'    => 3,
                'show_date'  => '2025-10-09',
                'start_time' => '2025-10-09 15:00:00',
                'end_time'   => '2025-10-09 17:10:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('showtimes')->insert($showTimes);
    }
}
