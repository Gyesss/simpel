<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\InternshipApplication;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if (! $user->company) {
            abort(404);
        }

        $company = $user->company;


        /*
        |--------------------------------------------------------------------------
        | Base Query
        |--------------------------------------------------------------------------
        |
        | Company hanya melihat pengajuan milik perusahaannya
        | yang sudah disetujui Hubin dan surat pengantar sudah diterbitkan.
        |
        */

        $baseQuery = InternshipApplication::query()
            ->where('company_id', $company->id)
            ->where('status', 'approved')
            ->whereHas('introductionLetters', function ($query) {
                $query->where('status', 'issued');
            });


        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        // Jumlah pengajuan yang sudah dapat diproses perusahaan.
        $totalApplications = (clone $baseQuery)->count();


        // Jumlah pengajuan yang belum mendapatkan keputusan perusahaan.
        $pendingApplications = (clone $baseQuery)
            ->where(function ($query) {
                $query
                    ->whereDoesntHave('companyResponse')
                    ->orWhereHas('companyResponse', function ($query) {
                        $query->where('status', 'pending');
                    });
            })
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Accepted Students
        |--------------------------------------------------------------------------
        |
        | Satu application dapat berisi satu atau banyak siswa.
        |
        | Contoh:
        | - Individu              = 1 siswa
        | - Kelompok 4 siswa     = 1 leader + 3 group members
        |
        | Karena itu acceptedApplications dihitung berdasarkan jumlah
        | anggota, bukan jumlah application.
        |
        */

        $acceptedApplications = (clone $baseQuery)
            ->withCount('groupMembers')
            ->whereHas('companyResponse', function ($query) {
                $query->where('status', 'accepted');
            })
            ->get();

        $acceptedStudents = $acceptedApplications->sum(function ($application) {
            return 1 + $application->group_members_count;
        });


        /*
        |--------------------------------------------------------------------------
        | Recent Applications
        |--------------------------------------------------------------------------
        */

        $recentApplications = (clone $baseQuery)
            ->with([
                'leaderStudent',
                'companyResponse',
                'groupMembers.student',
                'introductionLetter',
            ])
            ->latest('application_date')
            ->latest('created_at')
            ->take(5)
            ->get();


        return view('company.dashboard', compact(
            'company',
            'totalApplications',
            'pendingApplications',
            'acceptedStudents',
            'recentApplications',
        ));
    }
}
