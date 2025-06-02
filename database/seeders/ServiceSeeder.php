<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::insert([
            ['nama' => 'Cuci Biasa', 'harga' => 20000],
            ['nama' => 'Deep Clean', 'harga' => 40000],
            ['nama' => 'Fast Clean', 'harga' => 30000],
        ]);
    }
}
