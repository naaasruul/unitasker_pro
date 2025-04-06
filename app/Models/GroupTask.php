<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupTask extends Model
{
    protected $fillable = [
        'group_id',
        'created_by',
        'name',
        'description',
        'is_completed',
        'required_skills',
        'status', // Add this line
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
