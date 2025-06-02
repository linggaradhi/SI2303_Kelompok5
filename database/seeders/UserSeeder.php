<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private static function adminSeed()
    {
        // Version 1
        for ($i = 1; $i <= 5; $i++) {
            User::firstOrCreate(['name' => 'admin' . $i], [
                'email' => 'admin' . $i . '@example.com',
                'password' => Hash::make('pwadmin' . $i),
                'role' => 'admin',
            ]);
        }
    }
    public function run(): void
    {
        self::adminSeed();
    }
}
