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
        \DB::table('theaters')->insertOrIgnore([
            [
                'theater_id' => 1,
                'name' => 'TVC Vincom Center',
                'address' => '72 Lê Thánh Tôn, Quận 1, TP.HCM',
                'city' => 'TP.HCM',
                'phone_number' => '028-3936-7999',
                'email' => 'vincom@cgv.vn',
                'total_screens' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'theater_id' => 2,
                'name' => 'TVC Hà Nội',
                'address' => '54 Liễu Giai, Ba Đình, Hà Nội',
                'city' => 'Hà Nội',
                'phone_number' => '024-3333-8888',
                'email' => 'lottehn@lotte.vn',
                'total_screens' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'theater_id' => 3,
                'name' => 'TVC Nguyễn Du',
                'address' => '116 Nguyễn Du, Quận 1, TP.HCM',
                'city' => 'TP.HCM',
                'phone_number' => '028-3929-3939',
                'email' => 'nguyendu@galaxy.vn',
                'total_screens' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
