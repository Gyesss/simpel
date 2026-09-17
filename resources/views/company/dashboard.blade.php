@extends('layouts.app')

@section('title', 'Dashboard Perusahaan')

@section('content')

<div>

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

        <p class="text-sm font-medium text-amber-100">
            SIMPEL
        </p>

        <h2 class="mt-2 text-2xl font-bold text-white">
            Kelola penerimaan siswa PKL.
        </h2>

        <p class="mt-2 max-w-xl text-sm leading-6 text-amber-50">
            Lihat siswa SMK ICB yang melamar,
            periksa pengajuan, dan konfirmasi penerimaan siswa PKL.
        </p>

    </div>


    {{-- Stats --}}
    <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">

        <div class="rounded-2xl border border-slate-200 bg-white p-5">

            <p class="text-sm text-slate-500">
                Lamaran Masuk
            </p>

            <p class="mt-2 text-3xl font-bold text-slate-900">
                0
            </p>

        </div>


        <div class="rounded-2xl border border-slate-200 bg-white p-5">

            <p class="text-sm text-slate-500">
                Menunggu Konfirmasi
            </p>

            <p class="mt-2 text-3xl font-bold text-slate-900">
                0
            </p>

        </div>


        <div class="rounded-2xl border border-slate-200 bg-white p-5 sm:col-span-2 lg:col-span-1">

            <p class="text-sm text-slate-500">
                Siswa Diterima
            </p>

            <p class="mt-2 text-3xl font-bold text-slate-900">
                0
            </p>

        </div>

    </div>

</div>

@endsection