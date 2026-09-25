<?php

namespace App\Http\Controllers\Hubin;

use App\Http\Controllers\Controller;
use App\Models\InternshipApplication;
use Illuminate\Http\Request;

class InternshipApplicationController extends Controller
{
    /**
     * Display all internship applications.
     */
    public function index(Request $request)
    {
        $query = InternshipApplication::with([
            'leaderStudent',
            'company',
            'groupMembers.student',
        ])->latest();

        /*
        |--------------------------------------------------------------------------
        | Filter by status
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($query) use ($search) {

                $query->where(
                    'application_code',
                    'like',
                    "%{$search}%"
                )

                    ->orWhereHas('leaderStudent', function ($query) use ($search) {
                        $query->where(
                            'full_name',
                            'like',
                            "%{$search}%"
                        );
                    })

                    ->orWhereHas('company', function ($query) use ($search) {
                        $query->where(
                            'company_name',
                            'like',
                            "%{$search}%"
                        );
                    });
            });
        }

        $applications = $query->get();

        return view(
            'hubin.applications.index',
            compact('applications')
        );
    }

    /**
     * Display a specific internship application.
     */
    public function show(InternshipApplication $application)
    {
        $application->load([
            'leaderStudent',
            'company',
            'groupMembers.student',
            'introductionLetter',
        ]);

        return view(
            'hubin.applications.show',
            compact('application')
        );
    }

    /**
     * Approve an internship application.
     */
    public function approve(InternshipApplication $application)
    {
        if ($application->status !== 'submitted') {
            return redirect()
                ->route('hubin.applications.show', $application)
                ->with(
                    'error',
                    'Pengajuan ini sudah diproses sebelumnya.'
                );
        }

        $application->status = 'approved';
        $application->save();

        return redirect()
            ->route('hubin.applications.show', $application)
            ->with(
                'success',
                'Pengajuan PKL berhasil disetujui.'
            );
    }

    /**
     * Reject an internship application.
     */
    public function reject(InternshipApplication $application)
    {
        if ($application->status !== 'submitted') {
            return redirect()
                ->route('hubin.applications.show', $application)
                ->with(
                    'error',
                    'Pengajuan ini sudah diproses sebelumnya.'
                );
        }

        $application->status = 'rejected';
        $application->save();

        return redirect()
            ->route('hubin.applications.show', $application)
            ->with(
                'success',
                'Pengajuan PKL berhasil ditolak.'
            );
    }

    /**
     * Return an application to submitted status.
     */
    public function resetStatus(InternshipApplication $application)
    {
        if (! in_array(
            $application->status,
            ['approved', 'rejected']
        )) {
            return redirect()
                ->route('hubin.applications.show', $application)
                ->with(
                    'error',
                    'Pengajuan ini masih dalam status menunggu proses.'
                );
        }

        $application->status = 'submitted';
        $application->save();

        return redirect()
            ->route('hubin.applications.show', $application)
            ->with(
                'success',
                'Status pengajuan berhasil dikembalikan ke Menunggu Proses.'
            );
    }
}
