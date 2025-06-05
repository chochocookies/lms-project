<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Attendance;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceSeeder extends Seeder
{
    public function run()
    {
        $statusOptions = ['Hadir', 'Alfa'];

        $users = User::with('courseTaken')->get();

        foreach ($users as $user) {
            foreach ($user->courseTaken as $course) {
                for ($i = 1; $i <= 14; $i++) {
                    Attendance::create([
                        'npm' => $user->npm,
                        'date' => now()->addWeeks($i)->toDateString(),
                        'status' => $statusOptions[array_rand($statusOptions)],
                        'description' => 'Pertemuan ke-' . $i,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        echo "Seeder: AttendanceSeeder selesai.\n";
    }
}
