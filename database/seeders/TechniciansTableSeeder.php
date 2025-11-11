<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Technician;

class TechniciansTableSeeder extends Seeder
{
    public function run(): void
    {
        Technician::insert([
            ['name' => 'Azlan', 'role_id' => 1, 'email' => 'azlan@gta.com', 'status' => 'active'],
            ['name' => 'Faris', 'role_id' => 2, 'email' => 'faris@gta.com', 'status' => 'active'],
            ['name' => 'Hafiz', 'role_id' => 2, 'email' => 'hafiz@gta.com', 'status' => 'active'],
            ['name' => 'Sarah', 'role_id' => 3, 'email' => 'sarah@gta.com', 'status' => 'active']
        ]);
    }
}
