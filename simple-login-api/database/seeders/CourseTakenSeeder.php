<?php

namespace Database\Seeders;

use App\Models\CourseTaken;
use Illuminate\Database\Seeder;

class CourseTakenSeeder extends Seeder
{
    public function run()
    {
        CourseTaken::truncate(); // Kosongkan tabel dulu (opsional)

        CourseTaken::insert([
            [
                'user_id' => 1,
                'course_name' => 'Matematika Diskrit',
                'sks' => 3,
                'semester' => 'Ganjil 2024/2025',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'course_name' => 'Algoritma dan Struktur Data',
                'sks' => 4,
                'semester' => 'Ganjil 2024/2025',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        echo "Data course_taken berhasil disisipkan.\n";
    }
}
