<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\InternshipApplication;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the student dashboard.
     */
    public function index()
    {
        $applications = InternshipApplication::where(function ($query) {

            $query
                ->where(
                    'leader_student_id',
                    Auth::id()
                )
                ->orWhereHas(
                    'groupMembers',
                    function ($query) {

                        $query->where(
                            'student_id',
                            Auth::id()
                        );
                    }
                );
        });


        $totalApplications = (clone $applications)->count();


        $submittedApplications = (clone $applications)
            ->where('status', 'submitted')
            ->count();


        $approvedApplications = (clone $applications)
            ->where('status', 'approved')
            ->count();


        $rejectedApplications = (clone $applications)
            ->where('status', 'rejected')
            ->count();


        return view(
            'student.dashboard',
            compact(
                'totalApplications',
                'submittedApplications',
                'approvedApplications',
                'rejectedApplications'
            )
        );
    }
}
