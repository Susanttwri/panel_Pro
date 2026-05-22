<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->string('question');
            $table->json('options');
            $table->unsignedTinyInteger('correct_index');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('score');
            $table->unsignedTinyInteger('correct_count');
            $table->unsignedTinyInteger('total_questions');
            $table->timestamps();
        });

        Schema::table('enrollments', function (Blueprint $table) {
            $table->unsignedTinyInteger('quiz_best_score')->default(0)->after('progress');
            $table->timestamp('last_activity_at')->nullable()->after('quiz_best_score');
        });
    }

    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropColumn(['quiz_best_score', 'last_activity_at']);
        });
        Schema::dropIfExists('quiz_attempts');
        Schema::dropIfExists('quiz_questions');
    }
};
