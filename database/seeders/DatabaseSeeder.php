<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\SeatStatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AclUserSeeder::class);
        $this->call(TheaterSystemSeeder::class);
        $this->call(TheaterSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(SeatSeeder::class);
        $this->call(MovieSeeder::class);
        $this->call(ShowTimeSeeder::class); 
        $this->call(SeatStatusSeeder::class);
        $this->call(TicketSeeder::class);
        $this->call(TicketDetailSeeder::class);



    }
}
