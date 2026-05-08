<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->text('address')->nullable();
            $table->string('avatar')->nullable();
            $table->string('status')->default('active'); // active, inactive, suspended
            $table->string('student_id')->unique()->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
