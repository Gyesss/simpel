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
    /*
    |--------------------------------------------------------------------------
    | Create Individual Application
    |--------------------------------------------------------------------------
    */

    public function createIndividual(Request $request)
    {
        $redirect = $this->ensureStudentCanCreateApplication();

        if ($redirect) {
            return $redirect;
        }

        $companies = Company::where('partner_status', 'active')
            ->orderBy('company_name')
            ->get();

        $selectedCompanyId = $request->query('company_id');

        return view(
            'student.applications.individual',
            compact('companies', 'selectedCompanyId')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Store Individual Application
    |--------------------------------------------------------------------------
    */

    public function storeIndividual(Request $request)
    {
        $redirect = $this->ensureStudentCanCreateApplication();

        if ($redirect) {
            return $redirect;
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
            ->firstOrFail();

        InternshipApplication::create([
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

        return redirect()
            ->route('student.application-status')
            ->with(
                'success',
                'Pengajuan PKL berhasil dikirim dan sedang menunggu validasi Hubin.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Edit Individual Application
    |--------------------------------------------------------------------------
    */

    public function editIndividual(InternshipApplication $application)
    {
        $this->authorizeApplicationEdit($application);

        if ($application->groupMembers()->exists()) {
            abort(403);
        }

        $companies = Company::where('partner_status', 'active')
            ->orderBy('company_name')
            ->get();

        return view(
            'student.applications.individual-edit',
            compact('application', 'companies')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Individual Application
    |--------------------------------------------------------------------------
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


    /*
    |--------------------------------------------------------------------------
    | Create Group Application
    |--------------------------------------------------------------------------
    */

    public function createGroup(Request $request)
    {
        $redirect = $this->ensureStudentCanCreateApplication();

        if ($redirect) {
            return $redirect;
        }

        $companies = Company::where('partner_status', 'active')
            ->orderBy('company_name')
            ->get();

        $selectedCompanyId = $request->query('company_id');

        return view(
            'student.applications.group',
            compact('companies', 'selectedCompanyId')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Store Group Application
    |--------------------------------------------------------------------------
    */

    public function storeGroup(Request $request)
    {
        $redirect = $this->ensureStudentCanCreateApplication();

        if ($redirect) {
            return $redirect;
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
            ->firstOrFail();

        $members = User::whereIn(
            'id',
            $validated['member_ids']
        )
            ->where('role', 'student')
            ->get();

        if (
            $members->count() !==
            count($validated['member_ids'])
        ) {
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

        /*
        |--------------------------------------------------------------------------
        | Check Active Applications
        |--------------------------------------------------------------------------
        |
        | Every student may only be involved in one active application.
        | Active = submitted or approved.
        |
        */

        $studentIds = $members
            ->pluck('id')
            ->push(Auth::id())
            ->unique()
            ->values();

        $studentsWithActiveApplications =
            $this->studentsWithActiveApplications(
                $studentIds
            );

        if ($studentsWithActiveApplications->isNotEmpty()) {
            $names = User::whereIn(
                'id',
                $studentsWithActiveApplications
            )
                ->pluck('full_name')
                ->implode(', ');

            return back()
                ->withErrors([
                    'member_ids' =>
                    "Siswa berikut masih memiliki pengajuan PKL aktif: {$names}.",
                ])
                ->withInput();
        }

        DB::transaction(function () use (
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
        });

        return redirect()
            ->route('student.application-status')
            ->with(
                'success',
                'Pengajuan PKL kelompok berhasil dikirim dan sedang menunggu validasi Hubin.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Edit Group Application
    |--------------------------------------------------------------------------
    */

    public function editGroup(InternshipApplication $application)
    {
        $this->authorizeApplicationEdit($application);

        if (! $application->groupMembers()->exists()) {
            abort(403);
        }

        $companies = Company::where('partner_status', 'active')
            ->orderBy('company_name')
            ->get();

        $application->load([
            'groupMembers.student',
            'leaderStudent',
        ]);

        return view(
            'student.applications.group-edit',
            compact('application', 'companies')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Group Application
    |--------------------------------------------------------------------------
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
            ->firstOrFail();

        $members = User::whereIn(
            'id',
            $validated['member_ids']
        )
            ->where('role', 'student')
            ->get();

        if (
            $members->count() !==
            count($validated['member_ids'])
        ) {
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

        /*
        |--------------------------------------------------------------------------
        | Check Active Applications
        |--------------------------------------------------------------------------
        |
        | The current application is excluded because its members are already
        | part of this application.
        |
        */

        $studentIds = $members
            ->pluck('id')
            ->push(Auth::id())
            ->unique()
            ->values();

        $studentsWithActiveApplications =
            $this->studentsWithActiveApplications(
                $studentIds,
                $application->id
            );

        if ($studentsWithActiveApplications->isNotEmpty()) {
            $names = User::whereIn(
                'id',
                $studentsWithActiveApplications
            )
                ->pluck('full_name')
                ->implode(', ');

            return back()
                ->withErrors([
                    'member_ids' =>
                    "Siswa berikut sudah terlibat dalam pengajuan PKL aktif lain: {$names}.",
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


    /*
    |--------------------------------------------------------------------------
    | Cancel Application
    |--------------------------------------------------------------------------
    */

    public function cancel(InternshipApplication $application)
    {
        $this->authorizeApplicationEdit($application);

        $isGroup = $application
            ->groupMembers()
            ->exists();

        DB::transaction(function () use ($application) {
            $application->delete();
        });

        $message = $isGroup
            ? 'Pengajuan PKL kelompok berhasil dibatalkan.'
            : 'Pengajuan PKL berhasil dibatalkan.';

        return redirect()
            ->route('student.application-status')
            ->with('success', $message);
    }


    /*
    |--------------------------------------------------------------------------
    | Withdraw From Group
    |--------------------------------------------------------------------------
    */

    public function withdrawFromGroup(
        InternshipApplication $application
    ) {
        if ($application->status !== 'submitted') {
            abort(403);
        }

        $isMember = $application
            ->groupMembers()
            ->where('student_id', Auth::id())
            ->exists();

        if (! $isMember) {
            abort(403);
        }

        /*
        |--------------------------------------------------------------------------
        | Delete the entire group application
        |--------------------------------------------------------------------------
        |
        | The member does not leave only themselves.
        | The entire application is cancelled so the remaining group members
        | must create a new application.
        |
        */

        DB::transaction(function () use ($application) {
            $application->delete();
        });

        return redirect()
            ->route('student.application-status')
            ->with(
                'success',
                'Anda telah mengundurkan diri dari kelompok. Pengajuan kelompok tersebut dibatalkan dan harus dibuat kembali oleh kelompok yang tersisa.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Transfer Group Leader
    |--------------------------------------------------------------------------
    */

    public function transferLeader(
        Request $request,
        InternshipApplication $application
    ) {
        $this->authorizeApplicationEdit($application);

        if (! $application->groupMembers()->exists()) {
            abort(403);
        }

        $validated = $request->validate([
            'new_leader_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],
        ]);

        $newLeader = User::where('id', $validated['new_leader_id'])
            ->where('role', 'student')
            ->first();

        if (! $newLeader) {
            return back()
                ->withErrors([
                    'new_leader_id' =>
                    'Ketua baru harus merupakan siswa.',
                ]);
        }

        if ($newLeader->id === $application->leader_student_id) {
            return back()
                ->withErrors([
                    'new_leader_id' =>
                    'Siswa tersebut sudah menjadi ketua kelompok.',
                ]);
        }

        $isMember = $application
            ->groupMembers()
            ->where('student_id', $newLeader->id)
            ->exists();

        if (! $isMember) {
            return back()
                ->withErrors([
                    'new_leader_id' =>
                    'Ketua baru harus merupakan anggota kelompok yang sudah terdaftar.',
                ]);
        }

        DB::transaction(function () use (
            $application,
            $newLeader
        ) {
            $oldLeaderId = $application->leader_student_id;

            $application->update([
                'leader_student_id' => $newLeader->id,
            ]);

            /*
            |--------------------------------------------------------------------------
            | New leader leaves group_members
            |--------------------------------------------------------------------------
            */

            $application
                ->groupMembers()
                ->where('student_id', $newLeader->id)
                ->delete();

            /*
            |--------------------------------------------------------------------------
            | Old leader becomes a regular group member
            |--------------------------------------------------------------------------
            */

            GroupMember::firstOrCreate([
                'internship_application_id' =>
                $application->id,
                'student_id' => $oldLeaderId,
            ]);
        });

        return redirect()
            ->route(
                'student.applications.group.edit',
                $application
            )
            ->with(
                'success',
                'Ketua kelompok berhasil dipindahkan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Search Student
    |--------------------------------------------------------------------------
    */

    public function searchStudent(Request $request)
    {
        $request->validate([
            'nis_nip' => [
                'required',
                'string',
            ],
        ]);

        $student = User::where(
            'nis_nip',
            $request->nis_nip
        )
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


    /*
    |--------------------------------------------------------------------------
    | Application Status
    |--------------------------------------------------------------------------
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


    /*
    |--------------------------------------------------------------------------
    | Authorization
    |--------------------------------------------------------------------------
    */

    private function authorizeApplicationEdit(
        InternshipApplication $application
    ): void {
        if ($application->status !== 'submitted') {
            abort(403);
        }

        if (
            $application->leader_student_id !==
            Auth::id()
        ) {
            abort(403);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Prevent Multiple Active Applications
    |--------------------------------------------------------------------------
    */

    private function ensureStudentCanCreateApplication()
    {
        if (
            $this->studentHasActiveApplication(
                Auth::id()
            )
        ) {
            return redirect()
                ->route('student.application-status')
                ->with(
                    'error',
                    'Anda masih memiliki pengajuan PKL yang sedang diproses atau sudah disetujui.'
                );
        }

        return null;
    }


    private function studentHasActiveApplication(
        int $studentId,
        ?int $excludeApplicationId = null
    ): bool {
        return InternshipApplication::query()
            ->whereIn('status', [
                'submitted',
                'approved',
            ])
            ->when(
                $excludeApplicationId,
                function ($query) use (
                    $excludeApplicationId
                ) {
                    $query->where(
                        'id',
                        '!=',
                        $excludeApplicationId
                    );
                }
            )
            ->where(function ($query) use ($studentId) {
                $query
                    ->where(
                        'leader_student_id',
                        $studentId
                    )
                    ->orWhereHas(
                        'groupMembers',
                        function ($query) use (
                            $studentId
                        ) {
                            $query->where(
                                'student_id',
                                $studentId
                            );
                        }
                    );
            })
            ->exists();
    }


    private function studentsWithActiveApplications(
        $studentIds,
        ?int $excludeApplicationId = null
    ) {
        $studentIds = collect($studentIds)
            ->unique()
            ->values();

        if ($studentIds->isEmpty()) {
            return collect();
        }

        $applications = InternshipApplication::query()
            ->with('groupMembers')
            ->whereIn('status', [
                'submitted',
                'approved',
            ])
            ->when(
                $excludeApplicationId,
                function ($query) use (
                    $excludeApplicationId
                ) {
                    $query->where(
                        'id',
                        '!=',
                        $excludeApplicationId
                    );
                }
            )
            ->where(function ($query) use ($studentIds) {
                $query
                    ->whereIn(
                        'leader_student_id',
                        $studentIds
                    )
                    ->orWhereHas(
                        'groupMembers',
                        function ($query) use (
                            $studentIds
                        ) {
                            $query->whereIn(
                                'student_id',
                                $studentIds
                            );
                        }
                    );
            })
            ->get();

        $conflictingStudentIds = collect();

        foreach ($applications as $application) {
            if (
                $studentIds->contains(
                    $application->leader_student_id
                )
            ) {
                $conflictingStudentIds->push(
                    $application->leader_student_id
                );
            }

            foreach (
                $application->groupMembers
                as $member
            ) {
                if (
                    $studentIds->contains(
                        $member->student_id
                    )
                ) {
                    $conflictingStudentIds->push(
                        $member->student_id
                    );
                }
            }
        }

        return $conflictingStudentIds
            ->unique()
            ->values();
    }
}
