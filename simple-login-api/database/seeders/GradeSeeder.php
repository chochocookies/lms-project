<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grade;
use App\Models\User;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user pertama (pastikan user ada di DB)
        $user = User::first();

        if (!$user) {
            $this->command->warn('Tidak ada user ditemukan. Seeder Grade tidak dijalankan.');
            return;
        }

        $grades = [
            [
                'user_id' => $user->id,
                'subject_name' => 'Matematika Diskrit',
                'grade' => 'A',
                'grade_point' => 4.0,
                'sks' => 3,
            ],
            [
                'user_id' => $user->id,
                'subject_name' => 'Algoritma dan Struktur Data',
                'grade' => 'B+',
                'grade_point' => 3.5,
                'sks' => 3,
            ],

        ];

        foreach ($grades as $grade) {
            Grade::create($grade);
        }

        $this->command->info('Data grade berhasil disisipkan.');
    }
}
