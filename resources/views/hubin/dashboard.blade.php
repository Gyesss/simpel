@extends('layouts.app')

@section('title', 'Dashboard Hubin')

@section('content')

<div>

    <div class="mb-8">

        <p class="text-sm font-medium text-amber-600">
            Hubin / Admin PKL
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
            Kelola kegiatan PKL.
        </h2>

        <p class="mt-2 max-w-xl text-sm leading-6 text-amber-50">
            Kelola perusahaan mitra, kuota, pengajuan siswa,
            persetujuan, surat pengantar, dan pembimbing PKL.
        </p>

    </div>


    {{-- Stats --}}
    <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

        <div class="rounded-2xl border border-slate-200 bg-white p-5">

            <p class="text-sm text-slate-500">
                Perusahaan Mitra
            </p>

            <p class="mt-2 text-3xl font-bold text-slate-900">
                0
            </p>

        </div>


        <div class="rounded-2xl border border-slate-200 bg-white p-5">

            <p class="text-sm text-slate-500">
                Pengajuan Baru
            </p>

            <p class="mt-2 text-3xl font-bold text-slate-900">
                0
            </p>

        </div>


        <div class="rounded-2xl border border-slate-200 bg-white p-5">

            <p class="text-sm text-slate-500">
                Disetujui
            </p>

            <p class="mt-2 text-3xl font-bold text-slate-900">
                0
            </p>

        </div>


        <div class="rounded-2xl border border-slate-200 bg-white p-5">

            <p class="text-sm text-slate-500">
                Menunggu
            </p>

            <p class="mt-2 text-3xl font-bold text-slate-900">
                0
            </p>

        </div>

    </div>

</div>

@endsection