<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nis_nip' => '1234567890',
            'full_name' => 'Student Demo',
            'class' => 'XI RPL 1',
            'email' => 'student@example.com',
            'password' => 'password',
            'role' => 'student',
            'phone_number' => '081234567890',
        ]);

        User::create([
            'nis_nip' => '19800101202601',
            'full_name' => 'Admin Hubin',
            'class' => null,
            'email' => 'hubin@example.com',
            'password' => 'password',
            'role' => 'hubin',
            'phone_number' => '081234567891',
        ]);

        User::create([
            'nis_nip' => 'COMPANY001',
            'full_name' => 'Company Demo',
            'class' => null,
            'email' => 'company@example.com',
            'password' => 'password',
            'role' => 'company',
            'phone_number' => '081234567892',
        ]);
    }
}
