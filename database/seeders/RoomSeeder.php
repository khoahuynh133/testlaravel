<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ✅ Lấy danh sách theater_id từ bảng theaters
        $theaters = DB::table('theaters')->pluck('theater_id', 'name');

        // Thêm dữ liệu mẫu
        DB::table('rooms')->insert([
            [
                'theater_id' => $theaters['CGV Nguyễn Trãi'] ?? 1,
                'theater_systems_id' => 1,
                'name'       => 'Phòng 1',
                'capacity'   => 120,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'theater_id' => $theaters['CGV Nguyễn Trãi'] ?? 1,
                'theater_systems_id' => 1,
                'name'       => 'Phòng 2',
                'capacity'   => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'theater_id' => $theaters['Lotte Cinema Quận 7'] ?? 2,
                 'theater_systems_id' => 2,
                'name'       => 'Phòng 1',
                'capacity'   => 150,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'theater_id' => $theaters['Galaxy Tân Bình'] ?? 3,
                 'theater_systems_id' => 2,
                'name'       => 'Phòng 1',
                'capacity'   => 80,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
