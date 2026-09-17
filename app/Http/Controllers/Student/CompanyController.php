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
        $companies = Company::where('partner_status', 'active')
            ->orderBy('company_name')
            ->get();

        return view('student.companies.index', compact('companies'));
    }
}
