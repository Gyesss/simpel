@extends('layouts.app')

@section('title', 'Dashboard Hubin')

@section('content')

<div>

    {{-- Header --}}
    <div class="mb-8">

        <p class="text-sm font-medium text-amber-600">
            Hubin
        </p>

        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
            Dashboard
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Pantau pengajuan dan data PKL siswa.
        </p>

    </div>


    {{-- Statistics --}}
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

        {{-- Students --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

            <p class="text-sm font-medium text-slate-500">
                Total Siswa
            </p>

            <p class="mt-2 text-3xl font-bold text-slate-900">
                {{ $totalStudents }}
            </p>

            <p class="mt-1 text-sm text-slate-400">
                Siswa terdaftar
            </p>

        </div>


        {{-- Companies --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

            <p class="text-sm font-medium text-slate-500">
                Perusahaan
            </p>

            <p class="mt-2 text-3xl font-bold text-slate-900">
                {{ $totalCompanies }}
            </p>

            <p class="mt-1 text-sm text-slate-400">
                Perusahaan terdaftar
            </p>

        </div>


        {{-- Applications --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

            <p class="text-sm font-medium text-slate-500">
                Pengajuan PKL
            </p>

            <p class="mt-2 text-3xl font-bold text-slate-900">
                {{ $totalApplications }}
            </p>

            <p class="mt-1 text-sm text-slate-400">
                Total pengajuan
            </p>

        </div>


        {{-- Pending --}}
        <div class="rounded-2xl border border-amber-200 bg-amber-50 p-6 shadow-sm">

            <p class="text-sm font-medium text-amber-700">
                Menunggu Proses
            </p>

            <p class="mt-2 text-3xl font-bold text-amber-800">
                {{ $pendingApplications }}
            </p>

            <p class="mt-1 text-sm text-amber-600">
                Pengajuan perlu ditinjau
            </p>

        </div>

    </div>


    {{-- Main Content --}}
    <div class="mt-6 grid gap-6 lg:grid-cols-2">


        {{-- Recent Applications --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

            <div class="mb-6">

                <h2 class="text-lg font-semibold text-slate-900">
                    Pengajuan Terbaru
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Pengajuan PKL yang baru masuk.
                </p>

            </div>


            @if ($recentApplications->isNotEmpty())

            <div class="space-y-4">

                @foreach ($recentApplications as $application)

                <div class="rounded-xl border border-slate-100 p-4">

                    <div class="flex items-start justify-between gap-4">

                        <div>

                            <p class="font-semibold text-slate-900">
                                {{ $application->leaderStudent->full_name ?? '-' }}
                            </p>

                            <p class="mt-1 text-sm text-slate-500">
                                {{ $application->company->company_name ?? '-' }}
                            </p>

                        </div>


                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium capitalize text-slate-600">
                            {{ $application->status }}
                        </span>

                    </div>

                </div>

                @endforeach

            </div>

            @else

            <p class="text-sm text-slate-500">
                Belum ada pengajuan PKL.
            </p>

            @endif

        </div>


        {{-- Companies --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

            <div class="mb-6">

                <h2 class="text-lg font-semibold text-slate-900">
                    Perusahaan
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Ringkasan perusahaan yang terdaftar.
                </p>

            </div>


            @if ($companies->isNotEmpty())

            <div class="space-y-4">

                @foreach ($companies as $company)

                <div class="flex items-center justify-between gap-4 rounded-xl border border-slate-100 p-4">

                    <div>

                        <p class="font-semibold text-slate-900">
                            {{ $company->company_name }}
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            Status:
                            <span class="capitalize">
                                {{ $company->partner_status }}
                            </span>
                        </p>

                    </div>


                    <div class="text-right">

                        <p class="text-lg font-bold text-slate-900">
                            {{ $company->available_quota }}
                        </p>

                        <p class="text-xs text-slate-400">
                            Kuota
                        </p>

                    </div>

                </div>

                @endforeach

            </div>

            @else

            <p class="text-sm text-slate-500">
                Belum ada perusahaan terdaftar.
            </p>

            @endif

        </div>

    </div>

</div>

@endsection