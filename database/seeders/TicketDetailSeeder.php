<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ticketitems')->insert([
            ['ticketitem_id' => 1, 'ticket_id' => 1, 'seat_id' => 1, 'price' => 80000.00, 'created_at' => now(), 'updated_at' => now()],
            ['ticketitem_id' => 2, 'ticket_id' => 2, 'seat_id' => 2, 'price' => 90000.00, 'created_at' => now(), 'updated_at' => now()],
            ['ticketitem_id' => 3, 'ticket_id' => 3, 'seat_id' => 4, 'price' => 75000.00, 'created_at' => now(), 'updated_at' => now()],
            ['ticketitem_id' => 4, 'ticket_id' => 4, 'seat_id' => 7, 'price' => 70000.00, 'created_at' => now(), 'updated_at' => now()],
            ['ticketitem_id' => 5, 'ticket_id' => 5, 'seat_id' => 8, 'price' => 70000.00, 'created_at' => now(), 'updated_at' => now()],
            ['ticketitem_id' => 6, 'ticket_id' => 6, 'seat_id' => 10, 'price' => 85000.00, 'created_at' => now(), 'updated_at' => now()],
            ['ticketitem_id' => 7, 'ticket_id' => 7, 'seat_id' => 9, 'price' => 78000.00, 'created_at' => now(), 'updated_at' => now()],
            ['ticketitem_id' => 8, 'ticket_id' => 8, 'seat_id' => 3, 'price' => 72000.00, 'created_at' => now(), 'updated_at' => now()],
            ['ticketitem_id' => 9, 'ticket_id' => 9, 'seat_id' => 5, 'price' => 75000.00, 'created_at' => now(), 'updated_at' => now()],
            ['ticketitem_id' => 10, 'ticket_id' => 10, 'seat_id' => 6, 'price' => 80000.00, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
