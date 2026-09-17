@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div>

    {{-- Header --}}
    <div class="mb-8">

        <p class="text-sm font-medium text-amber-600">
            Student
        </p>

        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
            Dashboard
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Selamat datang kembali, {{ auth()->user()->full_name }}.
        </p>

    </div>


    {{-- Welcome Card --}}
    <div class="rounded-2xl bg-amber-500 p-6 shadow-sm">

        <p class="text-sm font-medium text-amber-100">
            SIMPEL
        </p>

        <h2 class="mt-2 text-2xl font-bold text-white">
            Mulai perjalanan PKL Anda.
        </h2>

        <p class="mt-2 max-w-xl text-sm leading-6 text-amber-50">
            Cari perusahaan mitra, ajukan tempat PKL,
            dan pantau status pengajuan Anda melalui satu portal.
        </p>

    </div>


    {{-- Application Statistics --}}
    <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

        {{-- Total --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <p class="text-sm font-medium text-slate-500">
                Total Pengajuan
            </p>

            <p class="mt-2 text-3xl font-bold text-slate-900">
                {{ $totalApplications }}
            </p>

            <p class="mt-1 text-sm text-slate-400">
                Seluruh pengajuan
            </p>

        </div>


        {{-- Submitted --}}
        <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5 shadow-sm">

            <p class="text-sm font-medium text-amber-700">
                Menunggu Validasi
            </p>

            <p class="mt-2 text-3xl font-bold text-amber-900">
                {{ $submittedApplications }}
            </p>

            <p class="mt-1 text-sm text-amber-600">
                Sedang diproses Hubin
            </p>

        </div>


        {{-- Approved --}}
        <div class="rounded-2xl border border-green-200 bg-green-50 p-5 shadow-sm">

            <p class="text-sm font-medium text-green-700">
                Disetujui
            </p>

            <p class="mt-2 text-3xl font-bold text-green-900">
                {{ $approvedApplications }}
            </p>

            <p class="mt-1 text-sm text-green-600">
                Pengajuan diterima
            </p>

        </div>


        {{-- Rejected --}}
        <div class="rounded-2xl border border-red-200 bg-red-50 p-5 shadow-sm">

            <p class="text-sm font-medium text-red-700">
                Ditolak
            </p>

            <p class="mt-2 text-3xl font-bold text-red-900">
                {{ $rejectedApplications }}
            </p>

            <p class="mt-1 text-sm text-red-600">
                Pengajuan ditolak
            </p>

        </div>

    </div>

</div>

@endsection