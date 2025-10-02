<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TheaterSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('theater_systems')->insert([
            [
                'theater_systems_id' => 1,
                'name' => 'CGV',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'theater_systems_id' => 2,
                'name' => 'Lotte Cinema',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'theater_systems_id' => 3,
                'name' => 'Galaxy Cinema',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'theater_systems_id' => 4,
                'name' => 'BHD Star',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
