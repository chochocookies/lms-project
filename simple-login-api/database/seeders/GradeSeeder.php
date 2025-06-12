<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Grade;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    public function run(): void
    {
        $gradeOptions = [
            ['grade' => 'A', 'point' => 4.0],
            ['grade' => 'B+', 'point' => 3.5],
            ['grade' => 'B', 'point' => 3.0],
            ['grade' => 'C+', 'point' => 2.5],
            ['grade' => 'C', 'point' => 2.0],
        ];

        $users = User::with('courseTaken')->get();

        foreach ($users as $user) {
            foreach ($user->courseTaken as $course) {
                $grade = $gradeOptions[array_rand($gradeOptions)];

                Grade::create([
                    'npm' => $user->npm,
                    'subject_name' => $course->course_name,
                    'grade' => $grade['grade'],
                    'grade_point' => $grade['point'],
                    'sks' => $course->sks,
                    'semester_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('Data grade berhasil disisipkan untuk semua user.');
    }
}
