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
        Schema::create('performance_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->foreignId('reviewer_id')->constrained('users')->cascadeOnDelete();
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('communication')->default(0); // 1-5
            $table->integer('teamwork')->default(0); // 1-5
            $table->integer('productivity')->default(0); // 1-5
            $table->integer('reliability')->default(0); // 1-5
            $table->integer('leadership')->default(0); // 1-5
            $table->string('review_period');
            $table->longText('comments')->nullable();
            $table->string('status')->default('draft'); // draft, submitted, completed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_reviews');
    }
};
