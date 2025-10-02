<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TheaterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Giả sử các hệ thống rạp đã có id từ 1 đến 5 tương ứng với các hệ thống đã seed trước đó
        $theaters = [
            // CGV
            ['name' => 'CGV Vincom Đồng Khởi', 'theater_systems_id' => 1],
            ['name' => 'CGV Crescent Mall', 'theater_systems_id' => 1],
            // Lotte Cinema
            ['name' => 'Lotte Cinema Nam Sài Gòn', 'theater_systems_id' => 2],
            ['name' => 'Lotte Cinema Gò Vấp', 'theater_systems_id' => 2],
            // Galaxy Cinema
            ['name' => 'Galaxy Nguyễn Du', 'theater_systems_id' => 3],
            ['name' => 'Galaxy Kinh Dương Vương', 'theater_systems_id' => 3],
            // BHD Star
            ['name' => 'BHD Star Bitexco', 'theater_systems_id' => 4],
            ['name' => 'BHD Star Vincom Thảo Điền', 'theater_systems_id' => 4],

        ];
        foreach ($theaters as &$theater) {
            $theater['created_at'] = now();
            $theater['updated_at'] = now();
        }
        
        \DB::table('theaters')->insert($theaters);
    }
}
