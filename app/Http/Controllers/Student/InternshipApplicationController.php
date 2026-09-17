<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\GroupMember;
use App\Models\InternshipApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
     * Display the group internship application form.
     */
    public function createGroup()
    {
        $companies = Company::where('partner_status', 'active')
            ->where('available_quota', '>', 0)
            ->orderBy('company_name')
            ->get();

        return view(
            'student.applications.group',
            compact('companies')
        );
    }


    /**
     * Store a group internship application.
     */
    public function storeGroup(Request $request)
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

            'member_ids' => [
                'required',
                'array',
                'min:1',
            ],

            'member_ids.*' => [
                'required',
                'integer',
                'distinct',
                'exists:users,id',
            ],
        ]);


        $company = Company::where('id', $validated['company_id'])
            ->where('partner_status', 'active')
            ->where('available_quota', '>', 0)
            ->firstOrFail();


        $members = User::whereIn(
            'id',
            $validated['member_ids']
        )
            ->where('role', 'student')
            ->get();


        if ($members->count() !== count($validated['member_ids'])) {

            return back()
                ->withErrors([
                    'member_ids' =>
                    'Semua anggota kelompok harus merupakan siswa.',
                ])
                ->withInput();
        }


        if ($members->contains('id', Auth::id())) {

            return back()
                ->withErrors([
                    'member_ids' =>
                    'Ketua kelompok tidak dapat ditambahkan sebagai anggota.',
                ])
                ->withInput();
        }


        $application = DB::transaction(function () use (
            $validated,
            $company
        ) {
            $application = InternshipApplication::create([
                'application_code' =>
                'PKL-' . strtoupper(Str::random(8)),

                'leader_student_id' => Auth::id(),

                'company_id' => $company->id,

                'application_date' => now()->toDateString(),

                'internship_start_date' =>
                $validated['internship_start_date'],

                'internship_end_date' =>
                $validated['internship_end_date'],

                'status' => 'submitted',

                'response_letter_file' => null,
            ]);


            foreach ($validated['member_ids'] as $studentId) {

                GroupMember::create([
                    'internship_application_id' =>
                    $application->id,

                    'student_id' => $studentId,
                ]);
            }


            return $application;
        });


        return redirect()
            ->route('student.application-status')
            ->with(
                'success',
                'Pengajuan PKL kelompok berhasil dikirim dan sedang menunggu validasi Hubin.'
            );
    }


    /**
     * Search student by NIS/NIP.
     */
    public function searchStudent(Request $request)
    {
        $request->validate([
            'nis_nip' => [
                'required',
                'string',
            ],
        ]);


        $student = User::where('nis_nip', $request->nis_nip)
            ->where('role', 'student')
            ->first();


        if (! $student) {

            return response()->json([
                'message' => 'Siswa tidak ditemukan.',
            ], 404);
        }


        if ($student->id === Auth::id()) {

            return response()->json([
                'message' =>
                'Anda tidak dapat menambahkan diri sendiri sebagai anggota kelompok.',
            ], 422);
        }


        return response()->json([
            'id' => $student->id,
            'nis_nip' => $student->nis_nip,
            'full_name' => $student->full_name,
            'class' => $student->class,
            'phone_number' => $student->phone_number,
            'role' => $student->role,
        ]);
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
