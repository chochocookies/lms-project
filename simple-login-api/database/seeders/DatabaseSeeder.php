<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\GradeSeeder;
use Database\Seeders\SemesterSeeder;
use Database\Seeders\AttendanceSeeder;
use Database\Seeders\CourseTakenSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
public function run(): void
{
    $this->call([
        UserSeeder::class,
        SemesterSeeder::class,
        CourseTakenSeeder::class,
        GradeSeeder::class,
        AttendanceSeeder::class,
    ]);
}
}
