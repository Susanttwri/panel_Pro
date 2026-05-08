<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'specialization', 'bio',
        'avatar', 'qualification', 'experience_years', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'experience_years' => 'integer',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
