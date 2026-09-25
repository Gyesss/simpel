<?php

namespace App\Http\Controllers\Hubin;

use App\Http\Controllers\Controller;
use App\Models\IntroductionLetter;
use App\Models\InternshipApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IntroductionLetterController extends Controller
{
    /**
     * Display a listing of introduction letters.
     */
    public function index(Request $request)
    {
        $query = IntroductionLetter::with([
            'internshipApplication.leaderStudent',
            'internshipApplication.company',
            'withdrawnBy',
        ])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($query) use ($search) {

                $query->where(
                    'letter_number',
                    'like',
                    "%{$search}%"
                )

                    ->orWhereHas('internshipApplication', function ($query) use ($search) {

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
            });
        }

        $introductionLetters = $query->get();

        return view(
            'hubin.introduction-letters.index',
            compact('introductionLetters')
        );
    }

    /**
     * Show the form for creating a new introduction letter.
     */
    public function create(InternshipApplication $application)
    {
        $application->load([
            'leaderStudent',
            'company',
            'groupMembers.student',
            'introductionLetter',
        ]);

        if ($application->status !== 'approved') {

            return redirect()
                ->route(
                    'hubin.applications.show',
                    $application
                )
                ->with(
                    'error',
                    'Surat pengantar hanya dapat dibuat untuk pengajuan yang sudah disetujui.'
                );
        }

        if ($application->introductionLetter) {

            return redirect()
                ->route(
                    'hubin.introduction-letters.show',
                    $application->introductionLetter
                )
                ->with(
                    'error',
                    'Pengajuan ini sudah memiliki surat pengantar.'
                );
        }

        return view(
            'hubin.introduction-letters.create',
            compact('application')
        );
    }

    /**
     * Store a newly created introduction letter.
     */
    public function store(
        Request $request,
        InternshipApplication $application
    ) {
        $validated = $request->validate([
            'letter_date' => [
                'required',
                'date',
            ],
        ], [
            'letter_date.required' => 'Tanggal surat wajib diisi.',
            'letter_date.date' => 'Tanggal surat tidak valid.',
        ]);

        if ($application->status !== 'approved') {

            return redirect()
                ->route(
                    'hubin.applications.show',
                    $application
                )
                ->with(
                    'error',
                    'Surat pengantar hanya dapat dibuat untuk pengajuan yang sudah disetujui.'
                );
        }

        if ($application->introductionLetter()->exists()) {

            return redirect()
                ->route(
                    'hubin.applications.show',
                    $application
                )
                ->with(
                    'error',
                    'Pengajuan ini sudah memiliki surat pengantar.'
                );
        }

        $introductionLetter = DB::transaction(function () use (
            $application,
            $validated
        ) {

            /*
            |--------------------------------------------------------------------------
            | Determine Letter Date
            |--------------------------------------------------------------------------
            */

            $letterDate = \Carbon\Carbon::parse(
                $validated['letter_date']
            );

            $year = $letterDate->year;

            /*
            |--------------------------------------------------------------------------
            | Find Last Number For This Year
            |--------------------------------------------------------------------------
            |
            | The number is stored inside the letter_number itself.
            | Example:
            |
            | 421.5/001/PKL/SMK-ICB/IX/2026
            |
            */

            $prefix = '421.5/';

            $lastLetter = IntroductionLetter::where(
                'letter_number',
                'like',
                $prefix . '%/PKL/SMK-ICB/%/' . $year
            )
                ->orderByDesc('id')
                ->lockForUpdate()
                ->first();

            /*
            |--------------------------------------------------------------------------
            | Determine Next Sequence
            |--------------------------------------------------------------------------
            */

            $nextNumber = 1;

            if ($lastLetter) {

                $parts = explode(
                    '/',
                    $lastLetter->letter_number
                );

                /*
                 * Expected structure:
                 *
                 * 0 => 421.5
                 * 1 => 001
                 * 2 => PKL
                 * 3 => SMK-ICB
                 * 4 => IX
                 * 5 => 2026
                 */

                if (isset($parts[1]) && is_numeric($parts[1])) {

                    $nextNumber = ((int) $parts[1]) + 1;
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Roman Month
            |--------------------------------------------------------------------------
            */

            $romanMonths = [
                1 => 'I',
                2 => 'II',
                3 => 'III',
                4 => 'IV',
                5 => 'V',
                6 => 'VI',
                7 => 'VII',
                8 => 'VIII',
                9 => 'IX',
                10 => 'X',
                11 => 'XI',
                12 => 'XII',
            ];

            $romanMonth = $romanMonths[$letterDate->month];

            /*
            |--------------------------------------------------------------------------
            | Generate Letter Number
            |--------------------------------------------------------------------------
            */

            $letterNumber = sprintf(
                '421.5/%03d/PKL/SMK-ICB/%s/%d',
                $nextNumber,
                $romanMonth,
                $year
            );

            /*
            |--------------------------------------------------------------------------
            | Create Letter
            |--------------------------------------------------------------------------
            */

            return IntroductionLetter::create([
                'internship_application_id' => $application->id,
                'letter_number' => $letterNumber,
                'letter_date' => $validated['letter_date'],
                'status' => 'draft',
            ]);
        });

        return redirect()
            ->route(
                'hubin.introduction-letters.show',
                $introductionLetter
            )
            ->with(
                'success',
                'Surat pengantar berhasil dibuat sebagai draft dengan nomor surat otomatis.'
            );
    }

    /**
     * Display the specified introduction letter.
     */
    public function show(IntroductionLetter $introductionLetter)
    {
        $introductionLetter->load([
            'internshipApplication.leaderStudent',
            'internshipApplication.company',
            'internshipApplication.groupMembers.student',
            'withdrawnBy',
        ]);

        return view(
            'hubin.introduction-letters.show',
            compact('introductionLetter')
        );
    }

    /**
     * Issue the introduction letter.
     */
    public function issue(IntroductionLetter $introductionLetter)
    {
        if ($introductionLetter->status !== 'draft') {

            return redirect()
                ->route(
                    'hubin.introduction-letters.show',
                    $introductionLetter
                )
                ->with(
                    'error',
                    'Hanya surat berstatus draft yang dapat diterbitkan.'
                );
        }

        $application = $introductionLetter->internshipApplication;

        if (! $application || $application->status !== 'approved') {

            return redirect()
                ->route(
                    'hubin.introduction-letters.show',
                    $introductionLetter
                )
                ->with(
                    'error',
                    'Surat hanya dapat diterbitkan untuk pengajuan yang disetujui.'
                );
        }

        $introductionLetter->update([
            'status' => 'issued',
        ]);

        return redirect()
            ->route(
                'hubin.introduction-letters.show',
                $introductionLetter
            )
            ->with(
                'success',
                'Surat pengantar berhasil diterbitkan.'
            );
    }

    /**
     * Suspend the introduction letter.
     */
    public function suspend(
        Request $request,
        IntroductionLetter $introductionLetter
    ) {
        $validated = $request->validate([
            'withdrawal_reason' => [
                'required',
                'string',
                'max:2000',
            ],
        ], [
            'withdrawal_reason.required' => 'Alasan penangguhan wajib diisi.',
            'withdrawal_reason.max' => 'Alasan penangguhan maksimal 2000 karakter.',
        ]);

        if ($introductionLetter->status !== 'issued') {

            return redirect()
                ->route(
                    'hubin.introduction-letters.show',
                    $introductionLetter
                )
                ->with(
                    'error',
                    'Hanya surat yang sudah diterbitkan yang dapat ditangguhkan.'
                );
        }

        $introductionLetter->update([
            'status' => 'suspended',
            'withdrawal_reason' => $validated['withdrawal_reason'],
            'withdrawn_at' => now(),
            'withdrawn_by' => Auth::id(),
        ]);

        return redirect()
            ->route(
                'hubin.introduction-letters.show',
                $introductionLetter
            )
            ->with(
                'success',
                'Surat pengantar berhasil ditangguhkan.'
            );
    }

    /**
     * Cancel the introduction letter.
     */
    public function cancel(
        Request $request,
        IntroductionLetter $introductionLetter
    ) {
        $validated = $request->validate([
            'withdrawal_reason' => [
                'required',
                'string',
                'max:2000',
            ],
        ], [
            'withdrawal_reason.required' => 'Alasan pembatalan wajib diisi.',
            'withdrawal_reason.max' => 'Alasan pembatalan maksimal 2000 karakter.',
        ]);

        if (! in_array(
            $introductionLetter->status,
            ['draft', 'issued']
        )) {

            return redirect()
                ->route(
                    'hubin.introduction-letters.show',
                    $introductionLetter
                )
                ->with(
                    'error',
                    'Surat dengan status saat ini tidak dapat dibatalkan.'
                );
        }

        $introductionLetter->update([
            'status' => 'cancelled',
            'withdrawal_reason' => $validated['withdrawal_reason'],
            'withdrawn_at' => now(),
            'withdrawn_by' => Auth::id(),
        ]);

        return redirect()
            ->route(
                'hubin.introduction-letters.show',
                $introductionLetter
            )
            ->with(
                'success',
                'Surat pengantar berhasil dibatalkan.'
            );
    }

    /**
     * Restore a suspended introduction letter.
     */
    public function restore(
        IntroductionLetter $introductionLetter
    ) {
        if ($introductionLetter->status !== 'suspended') {

            return redirect()
                ->route(
                    'hubin.introduction-letters.show',
                    $introductionLetter
                )
                ->with(
                    'error',
                    'Hanya surat yang ditangguhkan yang dapat diaktifkan kembali.'
                );
        }

        $introductionLetter->update([
            'status' => 'issued',
            'withdrawal_reason' => null,
            'withdrawn_at' => null,
            'withdrawn_by' => null,
        ]);

        return redirect()
            ->route(
                'hubin.introduction-letters.show',
                $introductionLetter
            )
            ->with(
                'success',
                'Surat pengantar berhasil diaktifkan kembali.'
            );
    }
}
