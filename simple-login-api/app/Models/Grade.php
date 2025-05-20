<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['npm', 'subject_name', 'grade', 'grade_point', 'sks', 'semester_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'npm', 'npm');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }
}
