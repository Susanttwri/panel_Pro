<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'date_of_birth', 'gender',
        'address', 'avatar', 'status', 'student_id',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments');
    }
}
