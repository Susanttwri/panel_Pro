<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        'student_id', 'course_id', 'enrolled_at', 'status',
        'progress', 'quiz_best_score', 'last_activity_at',
        'amount_paid', 'notes',
    ];

    protected $casts = [
        'enrolled_at' => 'date',
        'amount_paid' => 'decimal:2',
        'progress' => 'integer',
        'quiz_best_score' => 'integer',
        'last_activity_at' => 'datetime',
    ];

    public function remainingPercent(): int
    {
        return max(0, 100 - (int) $this->progress);
    }

    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    public function latestQuizAttempt()
    {
        return $this->hasOne(QuizAttempt::class)->latestOfMany();
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
