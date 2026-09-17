@extends('layouts.app')

@section('title', 'Katalog Perusahaan')

@section('content')

<div>

    {{-- Page Header --}}
    <div class="mb-8">

        <p class="text-sm font-medium text-amber-600">
            Student
        </p>

        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
            Katalog Perusahaan
        </h1>

        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
            Lihat daftar perusahaan mitra yang tersedia
            untuk kegiatan Praktik Kerja Lapangan (PKL).
        </p>

    </div>


    {{-- Company List --}}
    @if ($companies->isNotEmpty())

    <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">

        @foreach ($companies as $company)

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

            {{-- Company Icon --}}
            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">

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
                        d="M3.75 21h16.5M4.5 18.75h15M5.25 18.75V9.75L12 4.5l6.75 5.25v9" />

                </svg>

            </div>


            {{-- Company Name --}}
            <h2 class="mt-5 text-lg font-semibold text-slate-900">
                {{ $company->company_name }}
            </h2>


            {{-- Address --}}
            <p class="mt-2 text-sm leading-6 text-slate-500">
                {{ $company->full_address }}
            </p>


            {{-- HR Contact --}}
            <div class="mt-5 border-t border-slate-100 pt-4">

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Kontak HRD
                </p>

                <p class="mt-1 text-sm font-medium text-slate-700">
                    {{ $company->hr_contact }}
                </p>

            </div>


            {{-- Quota --}}
            <div class="mt-4 flex items-center justify-between">

                <span class="text-sm text-slate-500">
                    Kuota tersedia
                </span>

                <span class="rounded-full bg-amber-50 px-3 py-1 text-sm font-semibold text-amber-700">
                    {{ $company->available_quota }} siswa
                </span>

            </div>


            {{-- Application Button --}}
            @if ($company->available_quota > 0)

            <button
                type="button"
                class="mt-5 w-full rounded-xl bg-amber-500 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-amber-600">

                Ajukan PKL

            </button>

            @else

            <button
                type="button"
                disabled
                class="mt-5 w-full cursor-not-allowed rounded-xl bg-slate-100 px-4 py-2.5 text-sm font-semibold text-slate-400">

                Kuota Penuh

            </button>

            @endif

        </div>

        @endforeach

    </div>

    @else

    {{-- Empty State --}}
    <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center">

        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-amber-50 text-amber-500">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.8"
                stroke="currentColor"
                class="h-6 w-6">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3.75 21h16.5M4.5 18.75h15M5.25 18.75V9.75L12 4.5l6.75 5.25v9" />

            </svg>

        </div>


        <h2 class="mt-4 text-base font-semibold text-slate-800">
            Belum ada perusahaan
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Data perusahaan mitra akan ditampilkan di sini.
        </p>

    </div>

    @endif

</div>

@endsection