<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();

        User::insert([
            [
                'name' => 'Eko Aryanto',
                'email' => 'ekoa@mail.com',
                'password' => Hash::make('Password123#'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        echo "Data user berhasil disisipkan.\n";
    }
}
