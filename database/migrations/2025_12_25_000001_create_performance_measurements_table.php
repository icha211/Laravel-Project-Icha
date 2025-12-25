<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('performance_measurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->string('period'); // Q1 2025, Jan-Mar 2025, etc.
            $table->integer('year');
            
            // KPI Metrics
            $table->decimal('kpi_score', 5, 2)->default(0);
            $table->json('kpi_details')->nullable(); // Store individual KPI items
            
            // Additional Work
            $table->integer('additional_work_count')->default(0);
            $table->json('additional_work_details')->nullable();
            
            // Awards & Recognition
            $table->integer('award_points')->default(0);
            $table->json('awards')->nullable();
            
            // Work Contract Performance
            $table->enum('contract_performance', ['excellent', 'good', 'satisfactory', 'needs_improvement', 'poor'])->default('satisfactory');
            $table->text('contract_notes')->nullable();
            
            // Attendance & Punctuality
            $table->decimal('attendance_rate', 5, 2)->default(100);
            $table->integer('late_days')->default(0);
            $table->integer('absent_days')->default(0);
            
            // Productivity Metrics
            $table->integer('tasks_completed')->default(0);
            $table->integer('tasks_on_time')->default(0);
            $table->decimal('productivity_score', 5, 2)->default(0);
            
            // Overall Score
            $table->decimal('total_score', 5, 2)->default(0);
            $table->enum('status', ['draft', 'submitted', 'reviewed'])->default('draft');
            
            $table->foreignId('reviewed_by')->nullable()->constrained('users');
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
            
            $table->index(['employee_id', 'period', 'year']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('performance_measurements');
    }
};
