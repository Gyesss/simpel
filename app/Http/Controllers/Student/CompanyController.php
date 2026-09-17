<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display the company catalog.
     */
    public function index()
    {
        $companies = Company::orderByRaw("
                CASE
                    WHEN partner_status = 'active' AND available_quota > 0 THEN 0
                    WHEN partner_status = 'active' AND available_quota = 0 THEN 1
                    ELSE 2
                END
            ")
            ->orderBy('company_name')
            ->get();

        return view(
            'student.companies.index',
            compact('companies')
        );
    }
}
