<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        User::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        User::create([
            'name' => 'Eko Aryanto',
            'email' => 'eko@mail.com',
            'password' => Hash::make('Password123@'),
            'role' => 'admin',
            'npm' => '202501010001',
        ]);

        $faker = Faker::create();
        for ($i = 2; $i <= 10; $i++) {
            $day = str_pad(rand(1, 28), 2, '0', STR_PAD_LEFT);
            $month = str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT);
            $npm = '2025' . $month . $day . str_pad($i, 4, '0', STR_PAD_LEFT);

            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('Password123@'),
                'role' => 'student',
                'npm' => $npm,
            ]);
        }

        echo "Seeder: UserSeeder selesai.\n";
    }
}
