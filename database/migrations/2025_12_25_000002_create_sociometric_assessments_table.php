<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sociometric_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->string('period');
            $table->integer('year');
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
            
            // Aggregate Scores (calculated from responses)
            $table->decimal('technical_score', 5, 2)->default(0); // Pengetahuan & Keterampilan
            $table->decimal('interpersonal_score', 5, 2)->default(0); // Membangun Hubungan
            $table->decimal('work_ethics_score', 5, 2)->default(0); // Disiplin, Cermat, Teliti, Integritas
            $table->decimal('overall_score', 5, 2)->default(0);
            
            $table->timestamps();
            
            $table->index(['employee_id', 'period', 'year']);
        });

        Schema::create('sociometric_questions', function (Blueprint $table) {
            $table->id();
            $table->enum('aspect', ['technical', 'interpersonal', 'work_ethics']);
            $table->string('question_text');
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('sociometric_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->constrained('sociometric_assessments')->onDelete('cascade');
            $table->foreignId('question_id')->constrained('sociometric_questions')->onDelete('cascade');
            $table->foreignId('respondent_id')->constrained('users')->onDelete('cascade');
            $table->enum('respondent_type', ['self', 'supervisor', 'peer', 'subordinate']);
            
            // Rating: 1-5 scale
            // 1 = Sangat tidak menguasai/sangat tidak bagus
            // 2 = Tidak menguasai/tidak bagus
            // 3 = Cukup menguasai/cukup bagus
            // 4 = Menguasai/bagus
            // 5 = Sangat menguasai/sangat bagus
            $table->integer('rating'); // 1-5
            $table->text('comment')->nullable();
            
            $table->timestamps();
            
            $table->unique(['assessment_id', 'question_id', 'respondent_id']);
            $table->index(['assessment_id', 'respondent_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sociometric_responses');
        Schema::dropIfExists('sociometric_questions');
        Schema::dropIfExists('sociometric_assessments');
    }
};
