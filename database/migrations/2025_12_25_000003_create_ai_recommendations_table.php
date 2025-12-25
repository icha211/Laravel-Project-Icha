<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->foreignId('performance_measurement_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('sociometric_assessment_id')->nullable()->constrained()->onDelete('cascade');
            
            $table->string('period');
            $table->integer('year');
            
            // Aspect Analysis
            $table->json('technical_analysis')->nullable(); // Strengths, weaknesses, score
            $table->json('interpersonal_analysis')->nullable();
            $table->json('work_ethics_analysis')->nullable();
            
            // Overall Assessment
            $table->text('overall_summary')->nullable();
            $table->decimal('combined_score', 5, 2)->default(0);
            $table->enum('performance_level', ['excellent', 'good', 'satisfactory', 'needs_improvement', 'poor'])->default('satisfactory');
            
            // Recommendations
            $table->json('skill_development')->nullable(); // Specific skills to improve
            $table->json('training_programs')->nullable(); // Recommended training
            $table->json('education_recommendations')->nullable(); // Higher education suggestions
            $table->json('action_steps')->nullable(); // Specific actionable steps
            
            // Career Development
            $table->json('career_path_suggestions')->nullable();
            $table->json('promotion_readiness')->nullable();
            
            // AI Metadata
            $table->string('ai_model')->nullable(); // e.g., "gpt-4", "claude-3"
            $table->timestamp('generated_at')->nullable();
            $table->integer('confidence_score')->nullable(); // 0-100
            
            $table->timestamps();
            
            $table->index(['employee_id', 'period', 'year']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_recommendations');
    }
};
