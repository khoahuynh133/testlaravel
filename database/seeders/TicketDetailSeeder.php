<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $ticketIds = DB::table('tickets')->pluck('ticket_id')->toArray();
        $seatIds   = DB::table('seats')->pluck('seat_id')->toArray();

        if (empty($ticketIds) || empty($seatIds)) {
            $this->command->info('⚠️ Không có dữ liệu trong bảng tickets hoặc seats để tạo ticket_details.');
            return;
        }

        $data = [];

        foreach ($ticketIds as $ticketId) {
            // mỗi vé chọn ngẫu nhiên từ 1-3 ghế
            $selectedSeats = (array)array_rand($seatIds, rand(1, 3));

            foreach ($selectedSeats as $seatIndex) {
                $data[] = [
                    'ticket_id'  => $ticketId,
                    'seat_id'    => $seatIds[$seatIndex],
                    'price'      => rand(80000, 120000), // giá ngẫu nhiên
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('ticket_details')->insert($data);

        $this->command->info('✅ Seed dữ liệu ticket_details thành công.');
    }
}
