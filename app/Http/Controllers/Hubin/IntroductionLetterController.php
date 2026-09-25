<?php

namespace App\Http\Controllers\Hubin;

use App\Http\Controllers\Controller;
use App\Models\IntroductionLetter;
use App\Models\InternshipApplication;
use Illuminate\Http\Request;

class IntroductionLetterController extends Controller
{
    public function index()
    {
        $letters = IntroductionLetter::with([
            'internshipApplication.leaderStudent',
            'internshipApplication.company',
            'internshipApplication.groupMembers.student',
        ])
            ->latest('letter_date')
            ->get();

        return view(
            'hubin.introduction-letters.index',
            compact('letters')
        );
    }

    public function create(InternshipApplication $application)
    {
        abort_unless(
            $application->status === 'approved',
            403,
            'Surat pengantar hanya dapat dibuat untuk pengajuan yang telah disetujui.'
        );

        if ($application->introductionLetter) {
            return redirect()
                ->route(
                    'hubin.introduction-letters.show',
                    $application->introductionLetter
                )
                ->with(
                    'error',
                    'Surat pengantar untuk pengajuan ini sudah dibuat.'
                );
        }

        $application->load([
            'leaderStudent',
            'company',
            'groupMembers.student',
        ]);

        return view(
            'hubin.introduction-letters.create',
            compact('application')
        );
    }

    public function store(
        Request $request,
        InternshipApplication $application
    ) {
        abort_unless(
            $application->status === 'approved',
            403,
            'Surat pengantar hanya dapat dibuat untuk pengajuan yang telah disetujui.'
        );

        if ($application->introductionLetter) {
            return redirect()
                ->route(
                    'hubin.introduction-letters.show',
                    $application->introductionLetter
                )
                ->with(
                    'error',
                    'Surat pengantar untuk pengajuan ini sudah dibuat.'
                );
        }

        $validated = $request->validate([
            'letter_date' => [
                'required',
                'date',
            ],
        ]);

        $year = now()->year;

        $lastLetter = IntroductionLetter::whereYear(
            'letter_date',
            $year
        )
            ->orderByDesc('id')
            ->first();

        $sequence = $lastLetter
            ? ((int) preg_replace(
                '/[^0-9]/',
                '',
                explode('/', $lastLetter->letter_number)[0]
            )) + 1
            : 1;

        $letterNumber = str_pad(
            $sequence,
            3,
            '0',
            STR_PAD_LEFT
        ) . '/PKL/HUBIN/' . $year;

        $letter = IntroductionLetter::create([
            'internship_application_id' => $application->id,
            'letter_number' => $letterNumber,
            'letter_date' => $validated['letter_date'],
        ]);

        return redirect()
            ->route(
                'hubin.introduction-letters.show',
                $letter
            )
            ->with(
                'success',
                'Surat pengantar berhasil dibuat.'
            );
    }

    public function show(IntroductionLetter $introductionLetter)
    {
        $introductionLetter->load([
            'internshipApplication.leaderStudent',
            'internshipApplication.company',
            'internshipApplication.groupMembers.student',
        ]);

        return view(
            'hubin.introduction-letters.show',
            compact('introductionLetter')
        );
    }
}
