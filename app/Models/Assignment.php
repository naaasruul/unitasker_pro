<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = ['name', 'description', 'due_date', 'priority'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function group()
{
    return $this->belongsTo(Group::class);
}
}
