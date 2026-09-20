<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'company_name' => 'PT Teknologi Nusantara',
            'full_address' => 'Jl. Soekarno Hatta No. 123, Bandung',
            'hr_contact' => '081234567801',
            'available_quota' => 10,
            'partner_status' => 'active',
        ]);

        Company::create([
            'company_name' => 'CV Kreatif Digital',
            'full_address' => 'Jl. Cihanjuang No. 45, Cimahi',
            'hr_contact' => '081234567802',
            'available_quota' => 5,
            'partner_status' => 'active',
        ]);

        Company::create([
            'company_name' => 'PT Solusi Informatika Indonesia',
            'full_address' => 'Jl. Buah Batu No. 88, Bandung',
            'hr_contact' => '081234567803',
            'available_quota' => 0,
            'partner_status' => 'active',
        ]);

        Company::create([
            'company_name' => 'PT Mitra Industri Sejahtera',
            'full_address' => 'Jl. Raya Lembang No. 20, Bandung Barat',
            'hr_contact' => '081234567804',
            'available_quota' => 8,
            'partner_status' => 'inactive',
        ]);

        Company::create([
            'company_name' => 'PT ABC',
            'full_address' => 'Jl. ABC No. 123, Jakarta',
            'hr_contact' => '081234567805',
            'available_quota' => 3,
            'partner_status' => 'active',
        ]);
    }
}
