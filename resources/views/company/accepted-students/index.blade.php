@extends('layouts.app')

@section('title', 'Siswa Diterima')

@section('content')

<div>
    <div class="mb-8">
        <p class="text-sm font-medium text-amber-600">Perusahaan Mitra</p>

        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
            Siswa Diterima
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Daftar siswa yang telah diterima perusahaan untuk melaksanakan
            PKL berdasarkan respons penerimaan perusahaan.
        </p>
    </div>

    @if (session('success'))
    <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
        {{ session('error') }}
    </div>
    @endif


    {{-- Aktif --}}
    <section>
        <div class="mb-4 flex items-end justify-between">
            <div>
                <h2 class="text-xl font-bold text-slate-900">
                    Siswa Aktif
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Siswa yang periode PKL-nya masih berlangsung.
                </p>
            </div>

            <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                {{ $activeApplications->count() }} pengajuan
            </span>
        </div>

        @if ($activeApplications->isEmpty())

        <div class="rounded-2xl border border-slate-200 bg-white p-8 text-center shadow-sm">
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-100">
                <svg
                    class="h-6 w-6 text-slate-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z" />
                </svg>
            </div>

            <h3 class="mt-4 text-base font-semibold text-slate-900">
                Belum ada siswa aktif
            </h3>

            <p class="mt-2 text-sm text-slate-500">
                Belum ada siswa yang sedang menjalani periode PKL.
            </p>
        </div>

        @else

        <div class="space-y-4">

            @foreach ($activeApplications as $application)

            @php
            $isGroup = $application->groupMembers->isNotEmpty();

            $leaderName = trim($application->leaderStudent->full_name);
            $leaderNameParts = preg_split('/\s+/', $leaderName);

            $leaderInitials = count($leaderNameParts) === 1
            ? strtoupper(substr($leaderNameParts[0], 0, 1))
            : strtoupper(
            substr($leaderNameParts[0], 0, 1) .
            substr($leaderNameParts[1], 0, 1)
            );

            $members = $application->groupMembers
            ->filter(fn ($member) =>
            $member->student &&
            $member->student->id !== $application->leader_student_id
            )
            ->values();
            @endphp

            <div class="overflow-hidden rounded-2xl border border-emerald-200 bg-white shadow-sm">

                {{-- Header --}}
                <div class="border-b border-slate-100 px-6 py-5">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                        <div>
                            <div class="flex flex-wrap items-center gap-2">

                                <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                    Diterima
                                </span>

                                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-500">
                                    {{ $isGroup ? 'Kelompok' : 'Individual' }}
                                </span>

                                <span class="text-xs font-medium text-slate-400">
                                    {{ $application->application_code }}
                                </span>

                            </div>

                            <h3 class="mt-3 text-lg font-bold text-slate-900">
                                {{ $application->leaderStudent->full_name }}
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Ketua pengajuan
                                @if ($application->leaderStudent->class)
                                · {{ $application->leaderStudent->class }}
                                @endif
                            </p>
                        </div>

                        <div class="text-left sm:text-right">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                Periode PKL
                            </p>

                            <p class="mt-1 text-sm font-semibold text-slate-700">
                                {{ $application->internship_start_date->format('d M Y') }}
                                -
                                {{ $application->internship_end_date->format('d M Y') }}
                            </p>

                            <p class="mt-1 text-xs font-medium text-emerald-600">
                                Sedang berlangsung
                            </p>
                        </div>

                    </div>
                </div>


                {{-- Members --}}
                <div class="px-6 py-5">

                    @if ($isGroup)

                    <div>
                        <div class="mb-3 flex items-center justify-between">
                            <h4 class="text-sm font-semibold text-slate-900">
                                Anggota Kelompok
                            </h4>

                            <span class="text-xs text-slate-400">
                                {{ $members->count() + 1 }} siswa
                            </span>
                        </div>

                        <div class="space-y-2">

                            {{-- Leader --}}
                            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3">
                                <div class="flex items-center gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-emerald-200 text-sm font-bold text-emerald-700">
                                        {{ $leaderInitials }}
                                    </div>

                                    <div class="min-w-0">
                                        <p class="truncate text-sm font-semibold text-slate-900">
                                            {{ $application->leaderStudent->full_name }}
                                        </p>

                                        <p class="text-xs text-emerald-700">
                                            Ketua kelompok
                                            @if ($application->leaderStudent->class)
                                            · {{ $application->leaderStudent->class }}
                                            @endif
                                        </p>
                                    </div>

                                </div>
                            </div>


                            {{-- Members --}}
                            @foreach ($members as $member)

                            @php
                            $memberName = trim($member->student->full_name);
                            $memberNameParts = preg_split('/\s+/', $memberName);

                            $memberInitials = count($memberNameParts) === 1
                            ? strtoupper(substr($memberNameParts[0], 0, 1))
                            : strtoupper(
                            substr($memberNameParts[0], 0, 1) .
                            substr($memberNameParts[1], 0, 1)
                            );
                            @endphp

                            <div class="rounded-xl border border-slate-200 bg-slate-100 px-4 py-3">
                                <div class="flex items-center gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-slate-200 text-sm font-semibold text-slate-600">
                                        {{ $memberInitials }}
                                    </div>

                                    <div class="min-w-0">
                                        <p class="truncate text-sm font-semibold text-slate-800">
                                            {{ $member->student->full_name }}
                                        </p>

                                        <p class="text-xs text-slate-500">
                                            Anggota
                                            @if ($member->student->class)
                                            · {{ $member->student->class }}
                                            @endif
                                        </p>
                                    </div>

                                </div>
                            </div>

                            @endforeach

                        </div>
                    </div>

                    @else

                    @php
                    $studentName = trim($application->leaderStudent->full_name);
                    $studentNameParts = preg_split('/\s+/', $studentName);

                    $studentInitials = count($studentNameParts) === 1
                    ? strtoupper(substr($studentNameParts[0], 0, 1))
                    : strtoupper(
                    substr($studentNameParts[0], 0, 1) .
                    substr($studentNameParts[1], 0, 1)
                    );
                    @endphp

                    <div class="rounded-xl border border-slate-200 bg-slate-100 px-4 py-3">
                        <div class="flex items-center gap-3">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-slate-200 text-sm font-semibold text-slate-600">
                                {{ $studentInitials }}
                            </div>

                            <div class="min-w-0">
                                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                    Siswa
                                </p>

                                <p class="mt-1 text-sm font-semibold text-slate-800">
                                    {{ $application->leaderStudent->full_name }}
                                </p>

                                @if ($application->leaderStudent->class)
                                <p class="mt-1 text-xs text-slate-500">
                                    {{ $application->leaderStudent->class }}
                                </p>
                                @endif
                            </div>

                        </div>
                    </div>

                    @endif

                </div>


                {{-- Footer --}}
                <div class="flex flex-col gap-3 border-t border-slate-100 bg-slate-50 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex flex-wrap items-center gap-2 text-xs">

                        <span class="rounded-full bg-emerald-100 px-3 py-1 font-medium text-emerald-700">
                            Perusahaan: Diterima
                        </span>

                        <span class="rounded-full bg-blue-100 px-3 py-1 font-medium text-blue-700">
                            Surat Pengantar: Diterbitkan
                        </span>

                    </div>

                    <span class="text-xs font-medium text-slate-400">
                        Diterima
                        {{ $application->companyResponse->responded_at?->format('d M Y') }}
                    </span>

                </div>

            </div>

            @endforeach

        </div>

        @endif
    </section>


    {{-- Alumni --}}
    <section class="mt-12">

        <div class="mb-4 flex items-end justify-between">
            <div>
                <h2 class="text-xl font-bold text-slate-900">
                    Alumni
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Siswa yang periode PKL-nya telah selesai.
                </p>
            </div>

            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                {{ $alumniApplications->count() }} pengajuan
            </span>
        </div>


        @if ($alumniApplications->isEmpty())

        <div class="rounded-2xl border border-slate-200 bg-white p-8 text-center shadow-sm">
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-100">
                <svg
                    class="h-6 w-6 text-slate-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h3 class="mt-4 text-base font-semibold text-slate-900">
                Belum ada alumni
            </h3>

            <p class="mt-2 text-sm text-slate-500">
                Belum ada siswa yang telah menyelesaikan periode PKL.
            </p>
        </div>

        @else

        <div class="space-y-4">

            @foreach ($alumniApplications as $application)

            @php
            $isGroup = $application->groupMembers->isNotEmpty();

            $leaderName = trim($application->leaderStudent->full_name);
            $leaderNameParts = preg_split('/\s+/', $leaderName);

            $leaderInitials = count($leaderNameParts) === 1
            ? strtoupper(substr($leaderNameParts[0], 0, 1))
            : strtoupper(
            substr($leaderNameParts[0], 0, 1) .
            substr($leaderNameParts[1], 0, 1)
            );

            $members = $application->groupMembers
            ->filter(fn ($member) =>
            $member->student &&
            $member->student->id !== $application->leader_student_id
            )
            ->values();
            @endphp

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-50/70 shadow-sm">

                {{-- Header --}}
                <div class="border-b border-slate-200 px-6 py-5">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                        <div>
                            <div class="flex flex-wrap items-center gap-2">

                                <span class="rounded-full bg-slate-200 px-3 py-1 text-xs font-semibold text-slate-600">
                                    Alumni
                                </span>

                                <span class="rounded-full bg-slate-200 px-3 py-1 text-xs font-medium text-slate-500">
                                    {{ $isGroup ? 'Kelompok' : 'Individual' }}
                                </span>

                                <span class="text-xs font-medium text-slate-400">
                                    {{ $application->application_code }}
                                </span>

                            </div>

                            <h3 class="mt-3 text-lg font-bold text-slate-800">
                                {{ $application->leaderStudent->full_name }}
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Ketua pengajuan
                                @if ($application->leaderStudent->class)
                                · {{ $application->leaderStudent->class }}
                                @endif
                            </p>
                        </div>

                        <div class="text-left sm:text-right">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                Periode PKL
                            </p>

                            <p class="mt-1 text-sm font-semibold text-slate-500">
                                {{ $application->internship_start_date->format('d M Y') }}
                                -
                                {{ $application->internship_end_date->format('d M Y') }}
                            </p>

                            <p class="mt-1 text-xs font-medium text-slate-400">
                                Periode telah berakhir
                            </p>
                        </div>

                    </div>
                </div>


                {{-- Members --}}
                <div class="px-6 py-5">

                    @if ($isGroup)

                    <div>
                        <div class="mb-3 flex items-center justify-between">
                            <h4 class="text-sm font-semibold text-slate-800">
                                Anggota Kelompok
                            </h4>

                            <span class="text-xs text-slate-400">
                                {{ $members->count() + 1 }} siswa
                            </span>
                        </div>

                        <div class="space-y-2">

                            {{-- Leader --}}
                            <div class="rounded-xl border border-slate-200 bg-slate-100 px-4 py-3">
                                <div class="flex items-center gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-slate-200 text-sm font-bold text-slate-600">
                                        {{ $leaderInitials }}
                                    </div>

                                    <div class="min-w-0">
                                        <p class="truncate text-sm font-semibold text-slate-800">
                                            {{ $application->leaderStudent->full_name }}
                                        </p>

                                        <p class="text-xs text-slate-500">
                                            Ketua kelompok
                                            @if ($application->leaderStudent->class)
                                            · {{ $application->leaderStudent->class }}
                                            @endif
                                        </p>
                                    </div>

                                </div>
                            </div>


                            {{-- Members --}}
                            @foreach ($members as $member)

                            @php
                            $memberName = trim($member->student->full_name);
                            $memberNameParts = preg_split('/\s+/', $memberName);

                            $memberInitials = count($memberNameParts) === 1
                            ? strtoupper(substr($memberNameParts[0], 0, 1))
                            : strtoupper(
                            substr($memberNameParts[0], 0, 1) .
                            substr($memberNameParts[1], 0, 1)
                            );
                            @endphp

                            <div class="rounded-xl border border-slate-200 bg-slate-100 px-4 py-3">
                                <div class="flex items-center gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-slate-200 text-sm font-semibold text-slate-600">
                                        {{ $memberInitials }}
                                    </div>

                                    <div class="min-w-0">
                                        <p class="truncate text-sm font-semibold text-slate-700">
                                            {{ $member->student->full_name }}
                                        </p>

                                        <p class="text-xs text-slate-500">
                                            Anggota
                                            @if ($member->student->class)
                                            · {{ $member->student->class }}
                                            @endif
                                        </p>
                                    </div>

                                </div>
                            </div>

                            @endforeach

                        </div>
                    </div>

                    @else

                    @php
                    $studentName = trim($application->leaderStudent->full_name);
                    $studentNameParts = preg_split('/\s+/', $studentName);

                    $studentInitials = count($studentNameParts) === 1
                    ? strtoupper(substr($studentNameParts[0], 0, 1))
                    : strtoupper(
                    substr($studentNameParts[0], 0, 1) .
                    substr($studentNameParts[1], 0, 1)
                    );
                    @endphp

                    <div class="rounded-xl border border-slate-200 bg-slate-100 px-4 py-3">
                        <div class="flex items-center gap-3">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-slate-200 text-sm font-semibold text-slate-600">
                                {{ $studentInitials }}
                            </div>

                            <div class="min-w-0">
                                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                    Siswa
                                </p>

                                <p class="mt-1 text-sm font-semibold text-slate-700">
                                    {{ $application->leaderStudent->full_name }}
                                </p>

                                @if ($application->leaderStudent->class)
                                <p class="mt-1 text-xs text-slate-500">
                                    {{ $application->leaderStudent->class }}
                                </p>
                                @endif
                            </div>

                        </div>
                    </div>

                    @endif

                </div>


                {{-- Footer --}}
                <div class="flex flex-col gap-3 border-t border-slate-200 bg-slate-100 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex flex-wrap items-center gap-2 text-xs">

                        <span class="rounded-full bg-slate-200 px-3 py-1 font-medium text-slate-600">
                            Perusahaan: Diterima
                        </span>

                        <span class="rounded-full bg-slate-200 px-3 py-1 font-medium text-slate-600">
                            PKL Selesai
                        </span>

                    </div>

                    <span class="text-xs font-medium text-slate-400">
                        Diterima
                        {{ $application->companyResponse->responded_at?->format('d M Y') }}
                    </span>

                </div>

            </div>

            @endforeach

        </div>

        @endif

    </section>

</div>

@endsection