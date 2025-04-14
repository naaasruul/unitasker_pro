<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    // Specify the table name (optional if it matches the pluralized model name)
    protected $table = 'courses';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'course_name',
        'course_code',
        'course_credit_hours',
    ];

    public function groups()
    {
        return $this->hasMany(Group::class);
    }
    public function lecturers()
    {
        return $this->belongsToMany(User::class, 'course_lecturer', 'course_id', 'lecturer_id');
    }
}
