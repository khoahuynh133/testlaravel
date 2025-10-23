<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        DB::table('seats')->insert([
            ['seat_id' => 1, 'seat_number' => 1, 'room_id' => 1, 'seat_type' => 'standard', 'created_at' => now(), 'updated_at' => now()],
            ['seat_id' => 2, 'seat_number' => 2, 'room_id' => 1, 'seat_type' => 'standard', 'created_at' => now(), 'updated_at' => now()],
            ['seat_id' => 3, 'seat_number' => 3, 'room_id' => 1, 'seat_type' => 'vip', 'created_at' => now(), 'updated_at' => now()],
            ['seat_id' => 4, 'seat_number' => 1, 'room_id' => 2, 'seat_type' => 'standard', 'created_at' => now(), 'updated_at' => now()],
            ['seat_id' => 5, 'seat_number' => 2, 'room_id' => 2, 'seat_type' => 'vip', 'created_at' => now(), 'updated_at' => now()],
            ['seat_id' => 6, 'seat_number' => 1, 'room_id' => 3, 'seat_type' => 'standard', 'created_at' => now(), 'updated_at' => now()],
            ['seat_id' => 7, 'seat_number' => 2, 'room_id' => 3, 'seat_type' => 'standard', 'created_at' => now(), 'updated_at' => now()],
            ['seat_id' => 8, 'seat_number' => 1, 'room_id' => 4, 'seat_type' => 'vip', 'created_at' => now(), 'updated_at' => now()],
            ['seat_id' => 9, 'seat_number' => 2, 'room_id' => 4, 'seat_type' => 'standard', 'created_at' => now(), 'updated_at' => now()],
            ['seat_id' => 10, 'seat_number' => 1, 'room_id' => 1, 'seat_type' => 'standard', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
