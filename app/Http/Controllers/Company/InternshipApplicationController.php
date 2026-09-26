<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\InternshipApplication;
use Illuminate\Http\Request;

class InternshipApplicationController extends Controller
{
    /**
     * Display internship applications available to the company.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        if (! $user->company) {
            abort(404);
        }

        $applications = InternshipApplication::query()
            ->with([
                'leaderStudent',
                'companyResponse',
                'groupMembers.student',
                'introductionLetter',
            ])
            ->where('company_id', $user->company->id)
            ->where('status', 'approved')
            ->whereHas('introductionLetter', function ($query) {
                $query->where('status', 'issued');
            })
            ->latest('application_date')
            ->latest('created_at')
            ->get();

        return view(
            'company.applications.index',
            compact('applications')
        );
    }
}
