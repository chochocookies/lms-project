<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseTaken extends Model
{
    protected $fillable = ['npm', 'course_name', 'sks', 'semester'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
