<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin HRD PLN UP3 Jambi',
            'email' => 'admin@pln.co.id',
            'password' => Hash::make('password123'),
            'role' => 'hrd',
            'phone' => '081234567890',
        ]);

        User::create([
            'name' => 'Keuangan & Umum',
            'email' => 'keu@pln.co.id',
            'password' => Hash::make('password123'),
            'role' => 'mentor',
            'phone' => '082198765432',
        ]);

        User::create([
            'name' => 'K3 & Lingkungan',
            'email' => 'k3@pln.co.id',
            'password' => Hash::make('password123'),
            'role' => 'mentor',
            'phone' => '085211223344',
        ]);
        User::create([
            'name' => 'Jaringan',
            'email' => 'jaringan@pln.co.id',
            'password' => Hash::make('password123'),
            'role' => 'mentor',
            'phone' => '082198765432',
        ]);

        User::create([
            'name' => 'Pemasaran & Niaga',
            'email' => 'pemasaran@pln.co.id',
            'password' => Hash::make('password123'),
            'role' => 'mentor',
            'phone' => '085211223344',
        ]);

        User::create([
            'name' => 'Defry',
            'email' => 'defry@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'intern',
            'phone' => '089566778899',
        ]);
    }
}
