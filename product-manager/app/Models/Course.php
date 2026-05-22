<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'category', 'level',
        'price', 'duration_hours', 'start_date', 'deadline',
        'max_students', 'thumbnail', 'is_active',
        'is_featured', 'instructor_id',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'start_date' => 'date',
        'deadline' => 'date',
        'max_students' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($course) {
            if (empty($course->slug)) {
                $course->slug = Str::slug($course->title) . '-' . Str::random(4);
            }
        });
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments');
    }

    public function quizQuestions()
    {
        return $this->hasMany(QuizQuestion::class)->orderBy('sort_order');
    }
}
