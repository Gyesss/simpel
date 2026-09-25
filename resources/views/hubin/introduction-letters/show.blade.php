@extends('layouts.app')

@section('title', 'Detail Surat Pengantar')

@section('content')

<div>

    {{-- Header --}}
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

        <div>

            <p class="text-sm font-medium text-amber-600">
                Hubin
            </p>

            <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
                Surat Pengantar PKL
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                {{ $introductionLetter->letter_number }}
            </p>

        </div>


        <a
            href="{{ route('hubin.introduction-letters.index') }}"
            class="inline-flex items-center justify-center rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">

            Kembali

        </a>

    </div>


    {{-- Notifications --}}
    @if (session('success'))

    <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 p-4">

        <p class="text-sm font-medium text-green-700">
            {{ session('success') }}
        </p>

    </div>

    @endif


    @if (session('error'))

    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4">

        <p class="text-sm font-medium text-red-700">
            {{ session('error') }}
        </p>

    </div>

    @endif


    @php
    $application = $introductionLetter->internshipApplication;
    $isGroup = $application->groupMembers->isNotEmpty();
    @endphp


    <div class="grid gap-6 lg:grid-cols-3">


        {{-- Main --}}
        <div class="space-y-6 lg:col-span-2">


            {{-- Letter Information --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <h2 class="mb-6 text-lg font-semibold text-slate-900">
                    Informasi Surat
                </h2>

                <div class="grid gap-5 sm:grid-cols-2">

                    <div>

                        <p class="text-sm text-slate-500">
                            Nomor Surat
                        </p>

                        <p class="mt-1 font-semibold text-slate-900">
                            {{ $introductionLetter->letter_number }}
                        </p>

                    </div>


                    <div>

                        <p class="text-sm text-slate-500">
                            Tanggal Surat
                        </p>

                        <p class="mt-1 font-medium text-slate-900">
                            {{ $introductionLetter->letter_date->format('d F Y') }}
                        </p>

                    </div>


                    <div>

                        <p class="text-sm text-slate-500">
                            Kode Pengajuan
                        </p>

                        <p class="mt-1 font-medium text-slate-900">
                            {{ $application->application_code }}
                        </p>

                    </div>


                    <div>

                        <p class="text-sm text-slate-500">
                            Jenis Pengajuan
                        </p>

                        @if ($isGroup)

                        <span class="mt-1 inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                            Kelompok
                        </span>

                        @else

                        <span class="mt-1 inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                            Individual
                        </span>

                        @endif

                    </div>

                </div>

            </div>


            {{-- Student --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <h2 class="mb-6 text-lg font-semibold text-slate-900">
                    Peserta PKL
                </h2>


                @if ($isGroup)

                <div class="space-y-3">

                    <div class="rounded-xl border border-amber-200 bg-amber-50 p-4">

                        <p class="text-xs font-semibold uppercase tracking-wide text-amber-700">
                            Ketua Kelompok
                        </p>

                        <p class="mt-1 font-semibold text-slate-900">
                            {{ $application->leaderStudent->full_name ?? '-' }}
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            {{ $application->leaderStudent->class ?? '-' }}
                        </p>

                    </div>


                    @foreach ($application->groupMembers as $member)

                    <div class="rounded-xl border border-slate-100 p-4">

                        <p class="font-medium text-slate-900">
                            {{ $member->student->full_name ?? '-' }}
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            {{ $member->student->class ?? '-' }}
                        </p>

                    </div>

                    @endforeach

                </div>

                @else

                <div class="rounded-xl border border-slate-100 p-4">

                    <p class="font-semibold text-slate-900">
                        {{ $application->leaderStudent->full_name ?? '-' }}
                    </p>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $application->leaderStudent->class ?? '-' }}
                    </p>

                </div>

                @endif

            </div>

        </div>


        {{-- Sidebar --}}
        <div class="space-y-6">


            {{-- Company --}}
            @if ($application->company)

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <h2 class="mb-5 text-lg font-semibold text-slate-900">
                    Perusahaan Tujuan
                </h2>

                <p class="font-semibold text-slate-900">
                    {{ $application->company->company_name }}
                </p>

                <p class="mt-2 text-sm leading-6 text-slate-500">
                    {{ $application->company->full_address }}
                </p>

                <div class="mt-4 border-t border-slate-100 pt-4">

                    <p class="text-sm text-slate-500">
                        Kontak HR
                    </p>

                    <p class="mt-1 text-sm font-medium text-slate-900">
                        {{ $application->company->hr_contact }}
                    </p>

                </div>

            </div>

            @endif


            {{-- Application --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <h2 class="mb-5 text-lg font-semibold text-slate-900">
                    Periode PKL
                </h2>

                <p class="text-sm text-slate-500">
                    Mulai
                </p>

                <p class="mt-1 font-medium text-slate-900">
                    {{ \Carbon\Carbon::parse($application->internship_start_date)->format('d F Y') }}
                </p>

                <p class="mt-4 text-sm text-slate-500">
                    Selesai
                </p>

                <p class="mt-1 font-medium text-slate-900">
                    {{ \Carbon\Carbon::parse($application->internship_end_date)->format('d F Y') }}
                </p>

            </div>


            {{-- Future PDF --}}
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">

                <p class="text-sm font-semibold text-slate-700">
                    Dokumen Surat
                </p>

                <p class="mt-1 text-sm leading-6 text-slate-500">
                    Fitur preview dan cetak PDF akan ditambahkan setelah struktur surat sekolah ditentukan.
                </p>

            </div>

        </div>

    </div>

</div>

@endsection