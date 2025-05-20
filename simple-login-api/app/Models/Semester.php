<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = ['npm', 'name', 'start_date', 'end_date'];

    public function user()
    {
        return $this->belongsTo(User::class, 'npm', 'npm');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'semester_id');
    }
}
