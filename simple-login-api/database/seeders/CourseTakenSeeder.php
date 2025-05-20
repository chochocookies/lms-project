<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Semester;
use App\Models\CourseTaken;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseTakenSeeder extends Seeder
{
    public function run()
    {
        $coursesPerSemester = [
            1 => [
                ['course_name' => 'Matematika Dasar', 'sks' => 3],
                ['course_name' => 'Pengantar Teknologi Informasi', 'sks' => 2],
            ],
            2 => [
                ['course_name' => 'Algoritma dan Struktur Data', 'sks' => 4],
                ['course_name' => 'Basis Data', 'sks' => 3],
            ],
            3 => [
                ['course_name' => 'Jaringan Komputer', 'sks' => 3],
                ['course_name' => 'Sistem Operasi', 'sks' => 3],
            ],
            4 => [
                ['course_name' => 'Rekayasa Perangkat Lunak', 'sks' => 3],
                ['course_name' => 'Pemrograman Web', 'sks' => 3],
            ],
            5 => [
                ['course_name' => 'Kecerdasan Buatan', 'sks' => 3],
                ['course_name' => 'Analisis dan Perancangan Sistem', 'sks' => 3],
            ],
            6 => [
                ['course_name' => 'Keamanan Jaringan', 'sks' => 3],
                ['course_name' => 'Pemrograman Mobile', 'sks' => 3],
            ],
            7 => [
                ['course_name' => 'Data Mining', 'sks' => 3],
                ['course_name' => 'Cloud Computing', 'sks' => 3],
            ],
            8 => [
                ['course_name' => 'Proyek Akhir', 'sks' => 6],
                ['course_name' => 'Etika Profesi', 'sks' => 2],
            ],
        ];

        $users = User::all();

        foreach ($users as $user) {
            for ($semester = 1; $semester <= 8; $semester++) {
                // Cari semester milik user berdasarkan nama (misal: "Semester 1")
                $semesterRecord = Semester::where('npm', $user->npm)
                ->where('name', 'Semester ' . $semester)
                ->first();

                if (isset($coursesPerSemester[$semester]) && $semesterRecord) {
                    foreach ($coursesPerSemester[$semester] as $course) {
                        CourseTaken::create([
                            'npm' => $user->npm,
                            'course_name' => $course['course_name'],
                            'sks' => $course['sks'],
                            'semester' => 'Semester ' . $semester,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }

        echo "Seeder: CourseTakenSeeder selesai.\n";
    }
}
