<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameAssignmentsToHandoverLogs extends Migration
{
    public function up(): void
    {
        // If the old table exists and the target doesn't, rename it.
        if (Schema::hasTable('assignments') && ! Schema::hasTable('work_order_handover_logs')) {
            Schema::rename('assignments', 'work_order_handover_logs');
        }

        // If the target table exists, alter it (drop old columns if present, add new fields).
        if (Schema::hasTable('work_order_handover_logs')) {
            Schema::table('work_order_handover_logs', function (Blueprint $table) {

                // Drop FK + column: schedule_task_id
                if (Schema::hasColumn('work_order_handover_logs', 'schedule_task_id')) {
                    // drop foreign — original FK name is from assignments table
                    try {
                        $table->dropForeign('assignments_schedule_task_id_foreign');
                    } catch (\Exception $e) {
                        // ignore if not present
                    }
                    $table->dropColumn('schedule_task_id');
                }

                // Drop FK + column: technician_id
                if (Schema::hasColumn('work_order_handover_logs', 'technician_id')) {
                    try {
                        $table->dropForeign('assignments_technician_id_foreign');
                    } catch (\Exception $e) {
                        // ignore if not present
                    }
                    $table->dropColumn('technician_id');
                }

                // Drop assigned_at if exists
                if (Schema::hasColumn('work_order_handover_logs', 'assigned_at')) {
                    $table->dropColumn('assigned_at');
                }

                // Add new handover log fields only if they don't exist yet
                if (! Schema::hasColumn('work_order_handover_logs', 'work_order_id')) {
                    $table->foreignId('work_order_id')->after('id')->constrained()->cascadeOnDelete();
                }
                if (! Schema::hasColumn('work_order_handover_logs', 'old_cs_id')) {
                    $table->foreignId('old_cs_id')->nullable()->constrained('technicians')->nullOnDelete();
                }
                if (! Schema::hasColumn('work_order_handover_logs', 'new_cs_id')) {
                    $table->foreignId('new_cs_id')->nullable()->constrained('technicians')->nullOnDelete();
                }
                if (! Schema::hasColumn('work_order_handover_logs', 'changed_by')) {
                    $table->foreignId('changed_by')->nullable()->constrained('users')->nullOnDelete();
                }
                if (! Schema::hasColumn('work_order_handover_logs', 'reason')) {
                    $table->text('reason')->nullable();
                }
                if (! Schema::hasColumn('work_order_handover_logs', 'changed_at')) {
                    $table->timestamp('changed_at')->useCurrent();
                }
            });
        }
    }

    public function down(): void
    {
        // We cannot easily recreate the original assignments table structure in down().
        // If you want to revert, handle manually or implement a down migration that recreates the assignments table.
        if (Schema::hasTable('work_order_handover_logs')) {
            Schema::rename('work_order_handover_logs', 'assignments');
        }
    }
}
