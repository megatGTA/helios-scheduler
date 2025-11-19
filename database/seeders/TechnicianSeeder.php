<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TechnicianSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('technicians')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'role_id' => 1, // WM
                'name' => 'WM Khairol'
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'role_id' => 2, // CS
                'name' => 'CS Ahmad'
            ],
            [
                'id' => 3,
                'user_id' => 3,
                'role_id' => 2, // CS
                'name' => 'CS Zahid'
            ]
        ]);
    }
}

