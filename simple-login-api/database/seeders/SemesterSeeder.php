<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Semester;


class SemesterSeeder extends Seeder
{
    public function run()
    {
        Semester::truncate(); // kosongkan tabel dulu (optional)

        Semester::create([
            'user_id' => 1,
            'name' => 'Semester 1',
            'start_date' => '2024-09-01',
            'end_date' => '2025-01-15',
        ]);

        Semester::create([
            'user_id' => 1,
            'name' => 'Semester 2',
            'start_date' => '2025-02-01',
            'end_date' => '2025-06-15',
        ]);

        echo "Data semester berhasil disisipkan.\n";
    }
}
