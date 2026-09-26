@extends('layouts.app')

@section('title', 'Dashboard Perusahaan')

@section('content')

<div>

    {{-- Header --}}
    <div class="mb-8">

        <p class="text-sm font-medium text-amber-600">
            Perusahaan Mitra
        </p>

        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
            Dashboard
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Selamat datang, {{ auth()->user()->full_name }}.
        </p>

    </div>


    {{-- Overview --}}
    <div class="rounded-2xl bg-amber-500 p-6 shadow-sm">

        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

            <div>

                <p class="text-sm font-medium text-amber-100">
                    SIMPEL
                </p>

                <h2 class="mt-2 text-2xl font-bold text-white">
                    Kelola penerimaan siswa PKL.
                </h2>

                <p class="mt-2 max-w-xl text-sm leading-6 text-amber-50">
                    Lihat siswa SMK ICB yang melamar,
                    periksa pengajuan, dan konfirmasi penerimaan
                    siswa PKL.
                </p>

            </div>


            <div class="shrink-0">

                <a
                    href="{{ route('company.applications.index') }}"
                    class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-amber-700 shadow-sm transition hover:bg-amber-50">

                    Lihat Lamaran

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="h-4 w-4">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M13.5 4.5 19 10m0 0-5.5 5.5M19 10H5" />

                    </svg>

                </a>

            </div>

        </div>

    </div>


    {{-- Statistics --}}
    <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">

        {{-- Lamaran Masuk --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Lamaran Masuk
                    </p>

                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        {{ $totalApplications }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Pengajuan siap diproses perusahaan
                    </p>

                </div>


                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="h-5 w-5">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707L19 19a2 2 0 0 1-2 2Z" />

                    </svg>

                </div>

            </div>

        </div>


        {{-- Menunggu Konfirmasi --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Menunggu Konfirmasi
                    </p>

                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        {{ $pendingApplications }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Pengajuan belum mendapat keputusan
                    </p>

                </div>


                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-600">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="h-5 w-5">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 6v6l4 2" />

                        <circle
                            cx="12"
                            cy="12"
                            r="9" />

                    </svg>

                </div>

            </div>

        </div>


        {{-- Siswa Diterima --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:col-span-2 lg:col-span-1">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Siswa Diterima
                    </p>

                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        {{ $acceptedStudents }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Total siswa yang diterima
                    </p>

                </div>


                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="h-5 w-5">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m5 12 4 4L19 6" />

                    </svg>

                </div>

            </div>

        </div>

    </div>


    {{-- Company Information --}}
    <div class="mt-6 grid gap-6 lg:grid-cols-3">

        {{-- Recent Applications --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm lg:col-span-2">

            <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">

                <div>

                    <h2 class="font-semibold text-slate-900">
                        Lamaran Terbaru
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">
                        Pengajuan PKL terbaru yang dapat diproses.
                    </p>

                </div>


                <a
                    href="{{ route('company.applications.index') }}"
                    class="text-xs font-semibold text-amber-600 hover:text-amber-700">

                    Lihat Semua

                </a>

            </div>


            @if ($recentApplications->isNotEmpty())

            <div class="divide-y divide-slate-100">

                @foreach ($recentApplications as $application)

                @php
                $response = $application->companyResponse;
                @endphp

                <div class="px-5 py-4">

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                        <div class="min-w-0">

                            <p class="truncate text-sm font-semibold text-slate-800">
                                {{ $application->leaderStudent->full_name }}
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                {{ $application->application_code }}

                                @if ($application->groupMembers->isNotEmpty())

                                · {{ $application->groupMembers->count() + 1 }} siswa

                                @else

                                · Individu

                                @endif

                            </p>

                        </div>


                        <div class="flex items-center gap-3">

                            @if ($response?->status === 'accepted')

                            <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                                Diterima
                            </span>

                            @elseif ($response?->status === 'rejected')

                            <span class="rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">
                                Ditolak
                            </span>

                            @elseif ($response?->status === 'withdrawn')

                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                Dibatalkan
                            </span>

                            @else

                            <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
                                Menunggu
                            </span>

                            @endif


                            <a
                                href="{{ route('company.applications.index') }}"
                                class="text-xs font-semibold text-slate-500 hover:text-slate-800">

                                Lihat

                            </a>

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

            @else

            <div class="px-5 py-10 text-center">

                <p class="text-sm font-medium text-slate-700">
                    Belum ada lamaran masuk.
                </p>

                <p class="mt-1 text-xs text-slate-500">
                    Lamaran siswa akan muncul di sini setelah
                    disetujui Hubin dan surat pengantar diterbitkan.
                </p>

            </div>

            @endif

        </div>


        {{-- Company Information --}}
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-5 py-4">

                <h2 class="font-semibold text-slate-900">
                    Informasi Perusahaan
                </h2>

                <p class="mt-1 text-xs text-slate-500">
                    Informasi yang digunakan dalam sistem SIMPEL.
                </p>

            </div>


            <div class="space-y-5 p-5">

                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Nama Perusahaan
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $company->company_name }}
                    </p>

                </div>


                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Kontak HR
                    </p>

                    <p class="mt-1 text-sm font-medium text-slate-700">
                        {{ $company->hr_contact }}
                    </p>

                </div>


                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Kuota Tersedia
                    </p>

                    <p class="mt-1 text-2xl font-bold text-slate-900">
                        {{ $company->available_quota }}
                    </p>

                    <p class="mt-1 text-xs text-slate-500">
                        Kuota yang tercatat pada sistem.
                    </p>

                </div>


                <a
                    href="{{ route('company.profile.edit') }}"
                    class="inline-flex w-full items-center justify-center rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">

                    Kelola Informasi Perusahaan

                </a>

            </div>

        </div>

    </div>


    {{-- Quick Actions --}}
    <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

        <h2 class="font-semibold text-slate-900">
            Akses Cepat
        </h2>

        <div class="mt-4 grid gap-3 sm:grid-cols-2">

            <a
                href="{{ route('company.applications.index') }}"
                class="group rounded-xl border border-slate-200 p-4 transition hover:border-amber-300 hover:bg-amber-50">

                <p class="text-sm font-semibold text-slate-800 group-hover:text-amber-700">
                    Kelola Lamaran
                </p>

                <p class="mt-1 text-xs leading-5 text-slate-500">
                    Periksa dan berikan respons terhadap pengajuan PKL siswa.
                </p>

            </a>


            <a
                href="{{ route('company.accepted-students.index') }}"
                class="group rounded-xl border border-slate-200 p-4 transition hover:border-emerald-300 hover:bg-emerald-50">

                <p class="text-sm font-semibold text-slate-800 group-hover:text-emerald-700">
                    Siswa Diterima
                </p>

                <p class="mt-1 text-xs leading-5 text-slate-500">
                    Lihat siswa yang telah diterima untuk melaksanakan PKL.
                </p>

            </a>

        </div>

    </div>

</div>

@endsection