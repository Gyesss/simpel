@extends('layouts.app')

@section('title', 'Surat Pengantar PKL')

@section('content')

<div>

    {{-- Header --}}
    <div class="mb-8">

        <p class="text-sm font-medium text-amber-600">
            Hubin
        </p>

        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
            Surat Pengantar PKL
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Kelola surat pengantar untuk pengajuan PKL yang telah disetujui.
        </p>

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


    {{-- Letters --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-6 py-5">

            <h2 class="text-lg font-semibold text-slate-900">
                Daftar Surat
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                {{ $letters->count() }} surat pengantar ditemukan.
            </p>

        </div>


        @if ($letters->isNotEmpty())

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-slate-100">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Nomor Surat
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Pengajuan
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Siswa
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Perusahaan
                        </th>

                        <th class="px-6 py-3 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Tanggal
                        </th>

                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @foreach ($letters as $letter)

                    @php
                    $application = $letter->internshipApplication;
                    $isGroup = $application->groupMembers->isNotEmpty();
                    @endphp

                    <tr class="transition hover:bg-slate-50">


                        {{-- Letter Number --}}
                        <td class="px-6 py-4">

                            <p class="font-semibold text-slate-900">
                                {{ $letter->letter_number }}
                            </p>

                        </td>


                        {{-- Application --}}
                        <td class="px-6 py-4">

                            <p class="font-medium text-slate-900">
                                {{ $application->application_code }}
                            </p>

                            @if ($isGroup)

                            <span class="mt-2 inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                                Kelompok
                            </span>

                            @else

                            <span class="mt-2 inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                Individual
                            </span>

                            @endif

                        </td>


                        {{-- Student --}}
                        <td class="px-6 py-4">

                            <p class="font-medium text-slate-900">
                                {{ $application->leaderStudent->full_name ?? '-' }}
                            </p>

                            <p class="mt-1 text-sm text-slate-500">
                                {{ $application->leaderStudent->class ?? '-' }}
                            </p>

                        </td>


                        {{-- Company --}}
                        <td class="px-6 py-4">

                            <p class="font-medium text-slate-900">
                                {{ $application->company->company_name ?? '-' }}
                            </p>

                        </td>


                        {{-- Letter Date --}}
                        <td class="px-6 py-4 text-center">

                            <p class="text-sm text-slate-700">
                                {{ $letter->letter_date->format('d/m/Y') }}
                            </p>

                        </td>


                        {{-- Action --}}
                        <td class="px-6 py-4 text-right">

                            <a
                                href="{{ route('hubin.introduction-letters.show', $letter) }}"
                                class="inline-flex rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50">

                                Detail

                            </a>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        @else

        <div class="px-6 py-12 text-center">

            <h3 class="text-sm font-semibold text-slate-900">
                Belum ada surat pengantar
            </h3>

            <p class="mt-1 text-sm text-slate-500">
                Surat pengantar akan muncul setelah dibuat dari pengajuan yang telah disetujui.
            </p>

        </div>

        @endif

    </div>

</div>

@endsection