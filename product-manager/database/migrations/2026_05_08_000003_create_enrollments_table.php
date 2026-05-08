<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->date('enrolled_at');
            $table->string('status')->default('active'); // active, completed, dropped
            $table->integer('progress')->default(0); // percentage 0-100
            $table->decimal('amount_paid', 10, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->unique(['student_id', 'course_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
