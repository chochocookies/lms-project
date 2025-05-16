<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function grade()
{
    return $this->hasOne(Grade::class);
}

public function semester()
{
    return $this->hasOne(Semester::class);
}

public function attendance()
{
    return $this->hasOne(Attendance::class);
}

public function courseTaken()
{
    return $this->hasOne(CourseTaken::class);
}
}
