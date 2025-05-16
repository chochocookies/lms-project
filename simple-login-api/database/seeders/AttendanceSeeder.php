<?php

namespace Database\Seeders;

use App\Models\Attendance;
use Illuminate\Database\Seeder;


class AttendanceSeeder extends Seeder
{
    public function run()
    {
        Attendance::truncate(); // Kosongkan tabel attendance dulu (opsional)

        Attendance::insert([
            [
                'user_id' => 1,
                'date' => '2025-05-01',
                'status' => 'hadir',
                'description' => 'Hadir tepat waktu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'date' => '2025-05-02',
                'status' => 'izin',
                'description' => 'Ada keperluan keluarga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        echo "Data attendance berhasil disisipkan.\n";
    }
}
