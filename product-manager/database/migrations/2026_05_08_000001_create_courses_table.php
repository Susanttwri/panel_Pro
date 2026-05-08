<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('category')->default('General');
            $table->string('level')->default('Beginner');
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('duration_hours')->default(0);
            $table->string('thumbnail')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->unsignedBigInteger('instructor_id')->nullable();
            $table->foreign('instructor_id')->references('id')->on('instructors')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
