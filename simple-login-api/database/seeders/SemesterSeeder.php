<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Semester;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemesterSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            for ($i = 1; $i <= 8; $i++) {
                $startYear = 2024 + floor(($i - 1) / 2);
                $startMonth = ($i % 2 == 1) ? '09' : '02';
                $startDate = $startYear . '-' . $startMonth . '-01';
                $endDate = date('Y-m-d', strtotime("+5 months", strtotime($startDate)));

                Semester::create([
                    'npm' => $user->npm,
                    'name' => 'Semester ' . $i,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        echo "Seeder: SemesterSeeder selesai.\n";
    }
}
