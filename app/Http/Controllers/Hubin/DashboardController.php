<?php

namespace App\Http\Controllers\Hubin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\InternshipApplication;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = User::where('role', 'student')->count();

        $totalCompanies = Company::count();

        $totalApplications = InternshipApplication::count();

        $pendingApplications = InternshipApplication::where(
            'status',
            'submitted'
        )->count();

        $recentApplications = InternshipApplication::with([
            'leaderStudent',
            'company',
        ])
            ->latest()
            ->take(5)
            ->get();

        $companies = Company::orderBy('company_name')
            ->take(5)
            ->get();

        return view('hubin.dashboard', compact(
            'totalStudents',
            'totalCompanies',
            'totalApplications',
            'pendingApplications',
            'recentApplications',
            'companies'
        ));
    }
}
