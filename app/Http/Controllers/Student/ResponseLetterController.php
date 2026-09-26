<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\InternshipApplication;
use Illuminate\Http\Request;

class ResponseLetterController extends Controller
{
    public function index(Request $request)
    {
        $student = $request->user();

        $applications = InternshipApplication::query()
            ->with([
                'company',
                'introductionLetter',
                'companyResponse',
            ])
            ->where(function ($query) use ($student) {
                $query
                    ->where('leader_student_id', $student->id)
                    ->orWhereHas('groupMembers', function ($query) use ($student) {
                        $query->where('student_id', $student->id);
                    });
            })
            ->latest('application_date')
            ->latest('created_at')
            ->get();

        return view(
            'student.response-letter.index',
            compact('applications')
        );
    }
}
