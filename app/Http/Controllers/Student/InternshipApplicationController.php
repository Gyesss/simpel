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
    public function createIndividual(Request $request)
    {
        $companies = Company::where('partner_status', 'active')
            ->where('available_quota', '>', 0)
            ->orderBy('company_name')
            ->get();

        $selectedCompanyId = $request->query('company_id');

        return view(
            'student.applications.individual',
            compact(
                'companies',
                'selectedCompanyId'
            )
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
     * Display the individual internship application edit form.
     */
    public function editIndividual(InternshipApplication $application)
    {
        $this->authorizeApplicationEdit($application);

        if ($application->groupMembers()->exists()) {
            abort(403);
        }

        $companies = Company::where('partner_status', 'active')
            ->where(function ($query) use ($application) {
                $query
                    ->where('available_quota', '>', 0)
                    ->orWhere('id', $application->company_id);
            })
            ->orderBy('company_name')
            ->get();

        return view(
            'student.applications.individual-edit',
            compact(
                'application',
                'companies'
            )
        );
    }


    /**
     * Update an individual internship application.
     */
    public function updateIndividual(
        Request $request,
        InternshipApplication $application
    ) {
        $this->authorizeApplicationEdit($application);

        if ($application->groupMembers()->exists()) {
            abort(403);
        }

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
            ->where(function ($query) use ($application) {
                $query
                    ->where('available_quota', '>', 0)
                    ->orWhere('id', $application->company_id);
            })
            ->firstOrFail();


        $application->update([
            'company_id' => $company->id,
            'internship_start_date' =>
            $validated['internship_start_date'],
            'internship_end_date' =>
            $validated['internship_end_date'],
        ]);


        return redirect()
            ->route('student.application-status')
            ->with(
                'success',
                'Pengajuan PKL berhasil diperbarui.'
            );
    }


    /**
     * Display the group internship application form.
     */
    public function createGroup(Request $request)
    {
        $companies = Company::where('partner_status', 'active')
            ->where('available_quota', '>', 0)
            ->orderBy('company_name')
            ->get();

        $selectedCompanyId = $request->query('company_id');

        return view(
            'student.applications.group',
            compact(
                'companies',
                'selectedCompanyId'
            )
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
     * Display the group internship application edit form.
     */
    public function editGroup(InternshipApplication $application)
    {
        $this->authorizeApplicationEdit($application);

        if (! $application->groupMembers()->exists()) {
            abort(403);
        }

        $companies = Company::where('partner_status', 'active')
            ->where(function ($query) use ($application) {
                $query
                    ->where('available_quota', '>', 0)
                    ->orWhere('id', $application->company_id);
            })
            ->orderBy('company_name')
            ->get();

        $application->load([
            'groupMembers.student',
        ]);

        return view(
            'student.applications.group-edit',
            compact(
                'application',
                'companies'
            )
        );
    }


    /**
     * Update a group internship application.
     */
    public function updateGroup(
        Request $request,
        InternshipApplication $application
    ) {
        $this->authorizeApplicationEdit($application);

        if (! $application->groupMembers()->exists()) {
            abort(403);
        }

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
            ->where(function ($query) use ($application) {
                $query
                    ->where('available_quota', '>', 0)
                    ->orWhere('id', $application->company_id);
            })
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


        DB::transaction(function () use (
            $application,
            $validated,
            $company
        ) {
            $application->update([
                'company_id' => $company->id,

                'internship_start_date' =>
                $validated['internship_start_date'],

                'internship_end_date' =>
                $validated['internship_end_date'],
            ]);


            $application->groupMembers()->delete();


            foreach ($validated['member_ids'] as $studentId) {

                GroupMember::create([
                    'internship_application_id' =>
                    $application->id,

                    'student_id' => $studentId,
                ]);
            }
        });


        return redirect()
            ->route('student.application-status')
            ->with(
                'success',
                'Pengajuan PKL kelompok berhasil diperbarui.'
            );
    }


    /**
     * Cancel an internship application.
     */
    public function cancel(InternshipApplication $application)
    {
        $this->authorizeApplicationEdit($application);

        $application->delete();

        return redirect()
            ->route('student.application-status')
            ->with(
                'success',
                'Pengajuan PKL berhasil dibatalkan.'
            );
    }


    /**
     * Authorize the current student to edit or cancel an application.
     *
     * Rules:
     * - The application must still be submitted.
     * - The current student must be the leader.
     *
     * This covers:
     * - individual applications, where the applicant is the leader;
     * - group applications, where only the group leader may edit/cancel.
     */
    private function authorizeApplicationEdit(
        InternshipApplication $application
    ): void {
        if ($application->status !== 'submitted') {
            abort(403);
        }

        if ($application->leader_student_id !== Auth::id()) {
            abort(403);
        }
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
        $applications = InternshipApplication::with([
            'company',
            'leaderStudent',
            'groupMembers.student',
        ])
            ->where(function ($query) {

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
            })
            ->latest('application_date')
            ->get();

        return view(
            'student.applications.status',
            compact('applications')
        );
    }
}
