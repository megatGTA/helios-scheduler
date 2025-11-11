<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        Role::insert([
            ['name' => 'Workshop Manager', 'description' => 'Manages planning and scheduling'],
            ['name' => 'CS', 'description' => 'Technician handling assigned work'],
            ['name' => 'Executive', 'description' => 'Supports WM and CS with approvals']
        ]);
    }
}
