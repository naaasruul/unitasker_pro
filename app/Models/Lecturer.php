<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    protected $fillable = [
        'lecturer_name',
        'lecturer_staffId',
        'lecturer_username',
    ];
}
