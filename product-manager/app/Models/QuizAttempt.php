<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    protected $fillable = [
        'enrollment_id', 'score', 'correct_count', 'total_questions',
    ];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
}
