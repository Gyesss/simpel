@extends('layouts.app')

@section('title', 'Pengajuan PKL')

@section('content')

<div>

    {{-- Page Header --}}
    <div class="mb-8">

        <p class="text-sm font-medium text-amber-600">
            Student
        </p>

        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
            Pengajuan PKL
        </h1>

        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
            Ajukan tempat Praktik Kerja Lapangan (PKL)
            secara individu atau bersama kelompok.
        </p>

    </div>


    {{-- Application Type --}}
    <div class="grid gap-5 md:grid-cols-2">

        {{-- Individual --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

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
                        d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 19.5a7.5 7.5 0 0 1 15 0" />

                </svg>

            </div>

            <h2 class="mt-5 text-lg font-semibold text-slate-900">
                Pengajuan Individu
            </h2>

            <p class="mt-2 text-sm leading-6 text-slate-500">
                Ajukan PKL secara mandiri tanpa anggota kelompok.
            </p>

            <a
                href="{{ route('student.applications.individual') }}"
                class="mt-6 inline-flex w-full items-center justify-center rounded-xl bg-amber-500 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-amber-600">

                Ajukan Individu

            </a>

        </div>


        {{-- Group --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

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
                        d="M15 19.125a7.5 7.5 0 0 0-6 0M18.75 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM11.25 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM3.75 19.125a7.5 7.5 0 0 1 6-7.125M20.25 19.125a7.5 7.5 0 0 0-6-7.125" />

                </svg>

            </div>

            <h2 class="mt-5 text-lg font-semibold text-slate-900">
                Pengajuan Kelompok
            </h2>

            <p class="mt-2 text-sm leading-6 text-slate-500">
                Ajukan PKL bersama kelompok yang sudah dibentuk.
            </p>

            <a
                href="{{ route('student.applications.group') }}"
                class="mt-6 inline-flex w-full items-center justify-center rounded-xl border border-amber-500 bg-white px-4 py-2.5 text-sm font-semibold text-amber-600 transition hover:bg-amber-50">

                Ajukan Kelompok

            </a>

        </div>

    </div>


    {{-- Information --}}
    <div class="mt-6 rounded-2xl border border-amber-200 bg-amber-50 p-5">

        <div class="flex gap-3">

            <div class="mt-0.5 shrink-0 text-amber-600">

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
                        d="M11.25 11.25h1.5v5.25h-1.5zM12 7.5h.007v.007H12zM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />

                </svg>

            </div>

            <div>

                <h2 class="text-sm font-semibold text-amber-900">
                    Informasi Pengajuan
                </h2>

                <p class="mt-1 text-sm leading-6 text-amber-800">
                    Pilih perusahaan mitra yang masih aktif.
                    Informasi kuota digunakan sebagai bahan pertimbangan
                    dalam proses penempatan PKL, tetapi kekurangan kuota
                    tidak secara otomatis menghalangi pengajuan.
                    Pengajuan akan diperiksa dan divalidasi oleh Hubin
                    bersama perusahaan sebelum mendapatkan surat
                    pengantar PKL.
                </p>

            </div>

        </div>

    </div>

</div>

@endsection