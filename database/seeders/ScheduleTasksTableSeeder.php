<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleTasksTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('schedule_tasks')->insert([
            [
                'work_order_id' => 1,
                'task_name' => 'Engine Oil Replacement',
                'asset_name' => 'Turbine A',
                'description' => 'Replace engine oil and inspect filters.',
                'planned_date' => '2025-10-30',
                'start_date' => '2025-10-30',
                'due_date' => '2025-11-01',
                'status' => 'pending',
            ],
            [
                'work_order_id' => 1,
                'task_name' => 'Compressor Blade Check',
                'asset_name' => 'Compressor Unit C',
                'description' => 'Inspect compressor blades for wear and damage.',
                'planned_date' => '2025-10-31',
                'start_date' => '2025-10-31',
                'due_date' => '2025-11-02',
                'status' => 'pending',
            ],
            [
                'work_order_id' => 2,
                'task_name' => 'Hydraulic Line Pressure Test',
                'asset_name' => 'Hydraulic Pump B',
                'description' => 'Test hydraulic line pressure and inspect for leaks.',
                'planned_date' => '2025-11-03',
                'start_date' => '2025-11-03',
                'due_date' => '2025-11-05',
                'status' => 'pending',
            ],
        ]);
    }
}
