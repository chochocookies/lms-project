<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

public function grade()
{
    return $this->hasMany(Grade::class, 'npm', 'npm');
}

public function semester()
{
    return $this->hasMany(Semester::class, 'npm', 'npm');
}

public function attendance()
{
    return $this->hasMany(Attendance::class, 'npm', 'npm');
}

public function courseTakens()
{
    return $this->hasMany(CourseTaken::class, 'npm', 'npm');
}

}
