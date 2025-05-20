<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['npm', 'date', 'status', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

