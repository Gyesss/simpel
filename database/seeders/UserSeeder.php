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
            'login_id' => '1234567890',
            'nis_nip' => '1234567890',
            'full_name' => 'Student Demo',
            'class' => 'XI RPL 1',
            'email' => null,
            'password' => 'password',
            'role' => 'student',
            'phone_number' => '081234567890',
        ]);

        User::create([
            'login_id' => '1234567891',
            'nis_nip' => '1234567891',
            'full_name' => 'Student Demo 2',
            'class' => 'XI RPL 1',
            'email' => null,
            'password' => 'password',
            'role' => 'student',
            'phone_number' => '081234567893',
        ]);

        User::create([
            'login_id' => '1234567892',
            'nis_nip' => '1234567892',
            'full_name' => 'Student Demo 3',
            'class' => 'XI RPL 1',
            'email' => null,
            'password' => 'password',
            'role' => 'student',
            'phone_number' => '081234567894',
        ]);

        User::create([
            'login_id' => '1234567893',
            'nis_nip' => '1234567893',
            'full_name' => 'Student Demo 4',
            'class' => 'XI RPL 1',
            'email' => null,
            'password' => 'password',
            'role' => 'student',
            'phone_number' => '081234567895',
        ]);

        User::create([
            'login_id' => '1234567894',
            'nis_nip' => '1234567894',
            'full_name' => 'Student Demo 5',
            'class' => 'XI RPL 1',
            'email' => null,
            'password' => 'password',
            'role' => 'student',
            'phone_number' => '081234567896',
        ]);

        User::create([
            'login_id' => 'HUBIN001',
            'nis_nip' => '19800101202601',
            'full_name' => 'Admin Hubin',
            'class' => null,
            'email' => null,
            'password' => 'password',
            'role' => 'hubin',
            'phone_number' => '081234567891',
        ]);

        User::create([
            'login_id' => 'COMPANY001',
            'nis_nip' => null,
            'full_name' => 'Company Demo',
            'class' => null,
            'email' => null,
            'password' => 'password',
            'role' => 'company',
            'phone_number' => '081234567892',
        ]);
    }
}
