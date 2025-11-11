<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('wo_number')->unique(); // e.g., WO-2025-0101
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
            $table->date('start_date')->nullable(); // Controlled by WM
            $table->date('due_date')->nullable();   // Controlled by WM
            $table->foreignId('handover_to')->nullable()->constrained('technicians')->onDelete('set null'); 
            $table->text('handover_reason')->nullable(); // Reason for handover
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_orders');
    }
};
