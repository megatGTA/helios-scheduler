<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssignmentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('assignments')->insert([
            [
                'schedule_task_id' => 1,
                'technician_id' => 1,
                'assigned_date' => '2025-10-30',
                'status' => 'assigned',
                'remarks' => 'Initial assignment for engine oil replacement.',
            ],
            [
                'schedule_task_id' => 2,
                'technician_id' => 2,
                'assigned_date' => '2025-10-31',
                'status' => 'assigned',
                'remarks' => 'Assigned for compressor inspection.',
            ],
        ]);
    }
}
