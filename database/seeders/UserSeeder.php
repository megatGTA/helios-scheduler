<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'WM Khairol',
                'email' => 'wm@gta.com',
                'password' => Hash::make('password'), // password: password
                'role_id' => 1,
            ],
            [
                'id' => 2,
                'name' => 'CS Ahmad',
                'email' => 'cs1@gta.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
            ],
            [
                'id' => 3,
                'name' => 'CS Zahid',
                'email' => 'cs2@gta.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
            ],
        ]);
    }
}
