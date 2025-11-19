<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('work_orders', function (Blueprint $table) {
            $table->foreignId('cs_id')->nullable()
                ->after('priority')
                ->constrained('technicians')
                ->nullOnDelete();

            $table->text('handover_reason')->nullable()->after('cs_id');

            $table->enum('status', ['pending', 'in_progress', 'completed'])
                ->default('pending')
                ->after('handover_reason');
        });
    }

    public function down(): void
    {
        Schema::table('work_orders', function (Blueprint $table) {
            $table->dropForeign(['cs_id']);
            $table->dropColumn('cs_id');
            $table->dropColumn('handover_reason');
            $table->dropColumn('status');
        });
    }
};
