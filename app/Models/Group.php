<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'group_name',
        'course_id',
        'unique_code',
        'created_by',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_user');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    // Add this relationship for tasks
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function groupTasks()
    {
        return $this->hasMany(GroupTask::class);
    }
}