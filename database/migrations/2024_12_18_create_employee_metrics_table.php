<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Projects table
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('completion_percentage')->default(0); // 0-100
            $table->enum('status', ['not_started', 'in_progress', 'completed'])->default('not_started');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });

        // Time tracking table
        Schema::create('time_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->date('date');
            $table->integer('active_time')->default(0); // in minutes
            $table->integer('pause_time')->default(0); // in minutes
            $table->integer('extra_time')->default(0); // in minutes
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // Attendance table
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->date('date');
            $table->enum('status', ['present', 'absent', 'late', 'on_leave'])->default('present');
            $table->time('check_in')->nullable();
            $table->time('check_out')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // KPI Performance table
        Schema::create('kpi_performance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->date('date');
            $table->decimal('kpi_score', 5, 2); // 0-100
            $table->string('metric')->nullable(); // e.g., sales, quality, attendance
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kpi_performance');
        Schema::dropIfExists('attendance');
        Schema::dropIfExists('time_logs');
        Schema::dropIfExists('projects');
    }
};
