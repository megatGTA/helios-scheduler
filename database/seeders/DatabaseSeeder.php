<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolesTableSeeder::class,
            TechniciansTableSeeder::class,
            WorkOrdersTableSeeder::class,
            ScheduleTasksTableSeeder::class,
            AssignmentsTableSeeder::class,
            
        ]);
    }
}
