@extends('layouts.public')

@section('title', 'SIMPEL')

@section('content')

<div class="relative min-h-[calc(100svh-4rem)]">

    {{-- Background decoration --}}
    <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden">

        <div
            class="absolute -left-32 top-20 h-96 w-96 rounded-full bg-amber-200/40 blur-3xl">
        </div>

        <div
            class="absolute -right-32 top-40 h-96 w-96 rounded-full bg-yellow-100/60 blur-3xl">
        </div>

        <div
            class="absolute bottom-0 left-1/3 h-80 w-80 rounded-full bg-slate-200/50 blur-3xl">
        </div>

    </div>


    {{-- ========================================================
            HERO
        ========================================================= --}}

    <section
        class="mx-auto max-w-7xl px-8 pb-24 pt-16 sm:px-10 sm:pt-20 lg:px-14 lg:pb-28 lg:pt-24 xl:px-16">

        <div
            class="grid items-center gap-16 lg:grid-cols-[1fr_0.9fr] lg:gap-20">

            {{-- Hero text --}}
            <div class="max-w-2xl">

                <div
                    class="mb-6 inline-flex items-center gap-2 rounded-full border border-amber-200 bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-700">

                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                    Sistem Informasi PKL

                </div>


                <h1
                    class="text-4xl font-bold leading-tight tracking-tight text-slate-900 sm:text-5xl lg:text-6xl">

                    Kelola PKL
                    <span class="text-amber-500">
                        lebih mudah.
                    </span>

                </h1>


                <p
                    class="mt-6 max-w-xl text-base leading-7 text-slate-500 sm:text-lg sm:leading-8">

                    SIMPEL adalah Sistem Manajemen PKL yang membantu
                    mengelola proses pengajuan, kelompok, hingga
                    penempatan Praktik Kerja Lapangan secara lebih
                    terstruktur.

                </p>


                {{-- CTA --}}
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">

                    @auth

                    <a
                        href="{{ route('dashboard') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-slate-800 hover:shadow-md">

                        Buka Dashboard

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />

                        </svg>

                    </a>

                    @else

                    <a
                        href="{{ route('login') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-slate-800 hover:shadow-md">

                        Masuk ke SIMPEL

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />

                        </svg>

                    </a>

                    @endauth


                    <a
                        href="#tentang"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:-translate-y-0.5 hover:border-slate-300 hover:bg-slate-50">

                        Pelajari SIMPEL

                    </a>

                </div>


                {{-- Small info --}}
                <div
                    class="mt-10 flex flex-wrap gap-x-7 gap-y-3 text-xs font-medium text-slate-400">

                    <span class="flex items-center gap-2">
                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                        Terstruktur
                    </span>

                    <span class="flex items-center gap-2">
                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                        Terintegrasi
                    </span>

                    <span class="flex items-center gap-2">
                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                        Berbasis Pengguna
                    </span>

                </div>

            </div>


            {{-- Dashboard preview --}}
            <div class="relative mx-auto w-full max-w-xl lg:max-w-none">

                <div
                    class="rounded-2xl border border-slate-200 bg-white p-3 shadow-2xl shadow-slate-200/70">

                    <div
                        class="rounded-xl border border-slate-100 bg-slate-50 p-5">

                        {{-- Browser header --}}
                        <div class="mb-6 flex items-center gap-1.5">

                            <span class="h-2.5 w-2.5 rounded-full bg-red-300"></span>
                            <span class="h-2.5 w-2.5 rounded-full bg-yellow-300"></span>
                            <span class="h-2.5 w-2.5 rounded-full bg-green-300"></span>

                            <div
                                class="ml-3 h-5 flex-1 rounded-md bg-white">
                            </div>

                        </div>


                        {{-- Fake dashboard --}}
                        <div class="grid gap-4 sm:grid-cols-3">

                            <div class="rounded-xl bg-white p-4 shadow-sm">
                                <p class="text-xs text-slate-400">
                                    Pengajuan
                                </p>

                                <p class="mt-2 text-2xl font-bold text-slate-900">
                                    24
                                </p>
                            </div>

                            <div class="rounded-xl bg-white p-4 shadow-sm">
                                <p class="text-xs text-slate-400">
                                    Kelompok
                                </p>

                                <p class="mt-2 text-2xl font-bold text-slate-900">
                                    12
                                </p>
                            </div>

                            <div class="rounded-xl bg-white p-4 shadow-sm">
                                <p class="text-xs text-slate-400">
                                    Selesai
                                </p>

                                <p class="mt-2 text-2xl font-bold text-slate-900">
                                    18
                                </p>
                            </div>

                        </div>


                        <div class="mt-4 rounded-xl bg-white p-5 shadow-sm">

                            <div class="flex items-center justify-between">

                                <div>
                                    <p class="text-sm font-semibold text-slate-800">
                                        Progress Pengajuan
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        Monitoring status PKL
                                    </p>
                                </div>

                                <span
                                    class="rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-600">

                                    75%

                                </span>

                            </div>


                            <div
                                class="mt-4 h-2 overflow-hidden rounded-full bg-slate-100">

                                <div
                                    class="h-full w-3/4 rounded-full bg-amber-500">
                                </div>

                            </div>

                        </div>


                        <div class="mt-4 rounded-xl bg-white p-5 shadow-sm">

                            <p class="text-sm font-semibold text-slate-800">
                                Aktivitas Terbaru
                            </p>

                            <div class="mt-4 space-y-3">

                                <div class="flex items-center gap-3">

                                    <span
                                        class="h-2 w-2 rounded-full bg-green-400">
                                    </span>

                                    <p class="text-xs text-slate-500">
                                        Pengajuan berhasil diperbarui
                                    </p>

                                </div>

                                <div class="flex items-center gap-3">

                                    <span
                                        class="h-2 w-2 rounded-full bg-amber-400">
                                    </span>

                                    <p class="text-xs text-slate-500">
                                        Kelompok baru ditambahkan
                                    </p>

                                </div>

                                <div class="flex items-center gap-3">

                                    <span
                                        class="h-2 w-2 rounded-full bg-blue-400">
                                    </span>

                                    <p class="text-xs text-slate-500">
                                        Status PKL diperbarui
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Floating status --}}
                <div
                    class="absolute -bottom-5 -left-5 hidden rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-xl sm:block">

                    <div class="flex items-center gap-3">

                        <span
                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-green-50 text-green-600">

                            <span class="h-2 w-2 rounded-full bg-green-500"></span>

                        </span>

                        <div>
                            <p class="text-xs font-semibold text-slate-800">
                                Sistem Aktif
                            </p>

                            <p class="text-[10px] text-slate-400">
                                SIMPEL berjalan normal
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- ========================================================
            ABOUT
        ========================================================= --}}

    <section
        id="tentang"
        class="border-y border-slate-200 bg-white">

        <div
            class="mx-auto max-w-7xl px-8 py-20 sm:px-10 sm:py-24 lg:px-14 xl:px-16">

            <div class="max-w-2xl">

                <p
                    class="text-xs font-bold uppercase tracking-[0.2em] text-amber-500">

                    Tentang SIMPEL

                </p>

                <h2
                    class="mt-3 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">

                    Satu sistem untuk proses PKL yang lebih teratur.

                </h2>

                <p class="mt-4 leading-7 text-slate-500">

                    SIMPEL dirancang untuk membantu siswa, Hubin,
                    dan perusahaan dalam mengelola proses Praktik
                    Kerja Lapangan secara terintegrasi.

                </p>

            </div>


            <div
                class="mt-12 grid gap-5 md:grid-cols-3">

                {{-- Card --}}
                <div
                    class="rounded-2xl border border-slate-200 bg-slate-50 p-6 transition hover:-translate-y-1 hover:border-amber-200 hover:shadow-lg hover:shadow-slate-200/50">

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-100 text-amber-600">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                        </svg>

                    </div>

                    <h3 class="mt-5 font-semibold text-slate-900">
                        Pengajuan PKL
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Mengelola pengajuan PKL secara lebih terstruktur
                        dan terdokumentasi.
                    </p>

                </div>


                {{-- Card --}}
                <div
                    class="rounded-2xl border border-slate-200 bg-slate-50 p-6 transition hover:-translate-y-1 hover:border-amber-200 hover:shadow-lg hover:shadow-slate-200/50">

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-100 text-amber-600">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />

                        </svg>

                    </div>

                    <h3 class="mt-5 font-semibold text-slate-900">
                        Manajemen Kelompok
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Memudahkan pengelolaan anggota kelompok PKL
                        sesuai kebutuhan.
                    </p>

                </div>


                {{-- Card --}}
                <div
                    class="rounded-2xl border border-slate-200 bg-slate-50 p-6 transition hover:-translate-y-1 hover:border-amber-200 hover:shadow-lg hover:shadow-slate-200/50">

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-100 text-amber-600">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9c0-.688-.057-1.36-.165-2.016z" />

                        </svg>

                    </div>

                    <h3 class="mt-5 font-semibold text-slate-900">
                        Monitoring Status
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Memantau perkembangan proses PKL dengan status
                        yang lebih jelas.
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- ========================================================
            MADE BY RPL
        ========================================================= --}}

    <section class="bg-slate-950">

        <div
            class="mx-auto max-w-7xl px-8 py-20 sm:px-10 lg:px-14 xl:px-16">

            <div
                class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">

                <div>

                    <p
                        class="text-xs font-bold uppercase tracking-[0.2em] text-amber-500">

                        SIMPEL

                    </p>

                    <h2
                        class="mt-3 text-2xl font-bold tracking-tight text-white sm:text-3xl">

                        Dibangun oleh siswa RPL.

                    </h2>

                    <p
                        class="mt-3 max-w-xl text-sm leading-6 text-slate-400">

                        Sebuah sistem yang dikembangkan sebagai bagian
                        dari pembelajaran dan praktik pengembangan
                        perangkat lunak.

                    </p>

                </div>


                <div
                    class="rounded-2xl border border-slate-800 bg-slate-900 px-6 py-5">

                    <p class="text-sm font-semibold text-white">
                        SMKS ICB Cinta Niaga
                    </p>

                    <p class="mt-1 text-xs text-slate-500">
                        Rekayasa Perangkat Lunak
                    </p>

                </div>

            </div>

        </div>

    </section>

</div>

@endsection