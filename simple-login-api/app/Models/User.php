<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Semester;
use App\Models\CourseTaken;
use App\Models\Grade;
use App\Models\Attendance;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'npm',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();

        // Generate npm
        static::creating(function ($user) {
            if (empty($user->npm)) {
                $today = now()->format('Ymd');
                $lastUser = User::whereDate('created_at', now()->toDateString())
                    ->orderBy('npm', 'desc')
                    ->first();

                $lastIncrement = 0;
                if ($lastUser && substr($lastUser->npm, 0, 8) === $today) {
                    $lastIncrement = (int)substr($lastUser->npm, 8, 4);
                }

                $newIncrement = str_pad($lastIncrement + 1, 4, '0', STR_PAD_LEFT);
                $user->npm = $today . $newIncrement;
            }
        });

        // Generate data awal setelah user dibuat
        static::created(function ($user) {
            $semester = Semester::create([
                'npm' => $user->npm,
                'name' => 'Semester 1',
                'start_date' => now()->subMonths(1),
                'end_date' => now()->addMonths(5),
            ]);

            $courses = [
                ['course_name' => 'Matematika Dasar', 'sks' => 3],
                ['course_name' => 'Bahasa Indonesia', 'sks' => 2],
                ['course_name' => 'Pengantar TI', 'sks' => 2],
            ];

            foreach ($courses as $course) {
                CourseTaken::create([
                    'npm' => $user->npm,
                    'course_name' => $course['course_name'],
                    'sks' => $course['sks'],
                    'semester' => 1,
                ]);

                Grade::create([
                    'npm' => $user->npm,
                    'subject_name' => $course['course_name'],
                    'grade' => 'A',
                    'grade_point' => 4,
                    'sks' => $course['sks'],
                    'semester_id' => $semester->id,
                ]);
            }

            Attendance::create([
                'npm' => $user->npm,
                'date' => now()->format('Y-m-d'),
                'status' => 'Hadir',
                'description' => 'Pertemuan Ke-1',
            ]);
        });
    }

    // Relasi

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

    public function courseTaken()
    {
        return $this->hasMany(CourseTaken::class, 'npm', 'npm');
    }

    // Role

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }
}
