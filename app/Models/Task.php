<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['assignment_id', 'name', 'description', 'is_completed'];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }
}
