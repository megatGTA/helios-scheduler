<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkOrdersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('work_orders')->insert([
            [
                'wo_number' => 'WO-2025-0001',
                'title' => 'Engine Inspection - A320',
                'description' => 'Routine inspection of aircraft engine components.',
                'start_date' => '2025-10-28',
                'due_date' => '2025-11-02',
                'status' => 'in_progress',
                'handover_to' => null,
                'handover_reason' => null,
            ],
            [
                'wo_number' => 'WO-2025-0002',
                'title' => 'Hydraulic System Maintenance',
                'description' => 'Scheduled maintenance of hydraulic systems.',
                'start_date' => '2025-11-03',
                'due_date' => '2025-11-06',
                'status' => 'pending',
                'handover_to' => null,
                'handover_reason' => null,
            ],
        ]);
    }
}
