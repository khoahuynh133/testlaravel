<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $userIds = DB::table('acl_users')->pluck('id')->toArray();
        $showtimeIds = DB::table('showtimes')->pluck('showtime_id')->toArray();

        if (empty($userIds) || empty($showtimeIds)) {
            $this->command->info('⚠️ Không có dữ liệu trong bảng users hoặc showtimes để tạo tickets.');
            return;
        }

        $statuses = ['pending', 'paid', 'cancelled'];

        $data = [];

        // Tạo 20 vé mẫu
        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                'user_id'      => $userIds[array_rand($userIds)],
                'showtime_id'  => $showtimeIds[array_rand($showtimeIds)],
                'booking_time' => now()->subMinutes(rand(1, 5000)),
                'total_price'  => rand(80000, 200000), // Giá vé ngẫu nhiên
                'status'       => $statuses[array_rand($statuses)],
                'created_at'   => now(),
                'updated_at'   => now(),
            ];
        }

        DB::table('tickets')->insert($data);

        $this->command->info('✅ Seed dữ liệu tickets thành công.');
    }
}
