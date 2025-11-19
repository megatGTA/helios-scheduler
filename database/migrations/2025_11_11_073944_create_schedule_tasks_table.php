<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('schedule_tasks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('work_order_id')->constrained()->onDelete('cascade');
        $table->foreignId('cs_id')->nullable()->constrained('technicians')->nullOnDelete();

        $table->string('task_name');
        $table->text('description')->nullable();

        $table->date('start_date')->nullable();
        $table->date('due_date')->nullable();
        $table->date('planned_date')->nullable();

        $table->string('asset_name')->nullable();

        $table->enum('status', ['pending','assigned','in_progress','completed'])
              ->default('pending');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_tasks');
    }
};
