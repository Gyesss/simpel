<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\InternshipApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InternshipApplicationController extends Controller
{
    /**
     * Display the individual internship application form.
     */
    public function createIndividual()
    {
        $companies = Company::where('partner_status', 'active')
            ->where('available_quota', '>', 0)
            ->orderBy('company_name')
            ->get();

        return view(
            'student.applications.individual',
            compact('companies')
        );
    }

    /**
     * Store an individual internship application.
     */
    public function storeIndividual(Request $request)
    {
        $validated = $request->validate([
            'company_id' => [
                'required',
                'exists:companies,id',
            ],

            'internship_start_date' => [
                'required',
                'date',
            ],

            'internship_end_date' => [
                'required',
                'date',
                'after_or_equal:internship_start_date',
            ],
        ]);

        $company = Company::where('id', $validated['company_id'])
            ->where('partner_status', 'active')
            ->where('available_quota', '>', 0)
            ->firstOrFail();

        InternshipApplication::create([
            'application_code' => 'PKL-' . strtoupper(Str::random(8)),
            'leader_student_id' => Auth::id(),
            'company_id' => $company->id,
            'application_date' => now()->toDateString(),
            'internship_start_date' => $validated['internship_start_date'],
            'internship_end_date' => $validated['internship_end_date'],
            'status' => 'submitted',
            'response_letter_file' => null,
        ]);

        return redirect()
            ->route('student.application-status')
            ->with(
                'success',
                'Pengajuan PKL berhasil dikirim dan sedang menunggu validasi Hubin.'
            );
    }

    /**
     * Display the student's internship application status.
     */
    public function status()
    {
        $applications = InternshipApplication::with('company')
            ->where('leader_student_id', Auth::id())
            ->latest('application_date')
            ->get();

        return view(
            'student.applications.status',
            compact('applications')
        );
    }
}
