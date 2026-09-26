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

    /**
     * Display students accepted by the company.
     */
    public function acceptedStudents(Request $request)
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
            ->whereHas('companyResponse', function ($query) {
                $query->where('status', 'accepted');
            })
            ->whereHas('introductionLetter', function ($query) {
                $query->where('status', 'issued');
            })
            ->latest('application_date')
            ->latest('created_at')
            ->get();

        $activeApplications = $applications
            ->filter(function ($application) {
                return ! $application->internship_end_date->isPast();
            })
            ->values();

        $alumniApplications = $applications
            ->filter(function ($application) {
                return $application->internship_end_date->isPast();
            })
            ->values();

        return view(
            'company.accepted-students.index',
            compact(
                'activeApplications',
                'alumniApplications'
            )
        );
    }

    /**
     * Accept an internship application.
     */
    public function accept(
        Request $request,
        InternshipApplication $application
    ) {
        $this->authorizeApplication($request, $application);

        $response = $application->companyResponse()->firstOrNew();

        $response->status = 'accepted';
        $response->responded_at = now();
        $response->save();

        return redirect()
            ->route('company.applications.index')
            ->with(
                'success',
                'Pengajuan PKL berhasil diterima.'
            );
    }

    /**
     * Reject an internship application.
     */
    public function reject(
        Request $request,
        InternshipApplication $application
    ) {
        $this->authorizeApplication($request, $application);

        $response = $application->companyResponse()->firstOrNew();

        $response->status = 'rejected';
        $response->responded_at = now();
        $response->save();

        return redirect()
            ->route('company.applications.index')
            ->with(
                'success',
                'Pengajuan PKL berhasil ditolak.'
            );
    }

    /**
     * Withdraw the company's previous response.
     */
    public function withdraw(
        Request $request,
        InternshipApplication $application
    ) {
        $this->authorizeApplication($request, $application);

        $response = $application->companyResponse;

        if (! $response) {
            return redirect()
                ->route('company.applications.index')
                ->with(
                    'error',
                    'Belum ada respons perusahaan yang dapat dibatalkan.'
                );
        }

        if (! in_array(
            $response->status,
            ['accepted', 'rejected']
        )) {
            return redirect()
                ->route('company.applications.index')
                ->with(
                    'error',
                    'Respons perusahaan saat ini tidak dapat dibatalkan.'
                );
        }

        $response->status = 'withdrawn';
        $response->responded_at = now();
        $response->save();

        return redirect()
            ->route('company.applications.index')
            ->with(
                'success',
                'Respons perusahaan berhasil dibatalkan.'
            );
    }

    /**
     * Ensure the application belongs to the logged-in company
     * and is still eligible for a company response.
     */
    private function authorizeApplication(
        Request $request,
        InternshipApplication $application
    ): void {
        $user = $request->user();

        if (! $user->company) {
            abort(404);
        }

        if ($application->company_id !== $user->company->id) {
            abort(403);
        }

        if ($application->status !== 'approved') {
            abort(403);
        }

        $hasIssuedLetter = $application
            ->introductionLetters()
            ->where('status', 'issued')
            ->exists();

        if (! $hasIssuedLetter) {
            abort(403);
        }
    }
}
