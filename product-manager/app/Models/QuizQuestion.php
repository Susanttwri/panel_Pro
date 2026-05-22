<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $fillable = [
        'course_id', 'question', 'options', 'correct_index', 'sort_order',
    ];

    protected $casts = [
        'options' => 'array',
        'correct_index' => 'integer',
        'sort_order' => 'integer',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
