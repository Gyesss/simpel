@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div>

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


    {{-- Stats --}}
    <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">

        <div class="rounded-2xl border border-slate-200 bg-white p-5">

            <p class="text-sm text-slate-500">
                Pengajuan Aktif
            </p>

            <p class="mt-2 text-3xl font-bold text-slate-900">
                0
            </p>

        </div>


        <div class="rounded-2xl border border-slate-200 bg-white p-5">

            <p class="text-sm text-slate-500">
                Status Pengajuan
            </p>

            <p class="mt-2 text-3xl font-bold text-slate-900">
                -
            </p>

        </div>


        <div class="rounded-2xl border border-slate-200 bg-white p-5 sm:col-span-2 lg:col-span-1">

            <p class="text-sm text-slate-500">
                Perusahaan Dipilih
            </p>

            <p class="mt-2 text-3xl font-bold text-slate-900">
                -
            </p>

        </div>

    </div>

</div>

@endsection