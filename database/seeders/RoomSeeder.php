<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            ['room_id' => 1, 'theater_id' => 1, 'name' => 'Room 1 - Gold', 'created_at' => now(), 'updated_at' => now()],
            ['room_id' => 2, 'theater_id' => 1, 'name' => 'Room 2 - Silver', 'created_at' => now(), 'updated_at' => now()],
            ['room_id' => 3, 'theater_id' => 1, 'name' => 'Room 3 - VIP', 'created_at' => now(), 'updated_at' => now()],
            ['room_id' => 4, 'theater_id' => 2, 'name' => 'Room A', 'created_at' => now(), 'updated_at' => now()],
            ['room_id' => 5, 'theater_id' => 2, 'name' => 'Room B', 'created_at' => now(), 'updated_at' => now()],
            ['room_id' => 6, 'theater_id' => 2, 'name' => 'Room C', 'created_at' => now(), 'updated_at' => now()],
            ['room_id' => 7, 'theater_id' => 3, 'name' => 'Room Nguyễn Du 1', 'created_at' => now(), 'updated_at' => now()],
            ['room_id' => 8, 'theater_id' => 3, 'name' => 'Room Nguyễn Du 2', 'created_at' => now(), 'updated_at' => now()],
            ['room_id' => 9, 'theater_id' => 3, 'name' => 'Room Nguyễn Du VIP', 'created_at' => now(), 'updated_at' => now()],
            ['room_id' => 10, 'theater_id' => 1, 'name' => 'Room 4 - Family', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
