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
            Kelola dokumen surat pengantar PKL siswa.
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

    {{-- Filters --}}
    <div class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

        <form
            action="{{ route('hubin.introduction-letters.index') }}"
            method="GET"
            class="grid gap-4 md:grid-cols-3">

            {{-- Search --}}
            <div class="md:col-span-2">

                <label
                    for="search"
                    class="block text-sm font-medium text-slate-700">
                    Cari Surat
                </label>

                <input
                    type="text"
                    id="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Nomor surat, kode pengajuan, nama siswa, atau perusahaan"
                    class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500">

            </div>

            {{-- Status --}}
            <div>

                <label
                    for="status"
                    class="block text-sm font-medium text-slate-700">
                    Status
                </label>

                <select
                    id="status"
                    name="status"
                    class="mt-2 block w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500">

                    <option value="">
                        Semua Status
                    </option>

                    <option
                        value="draft"
                        @selected(request('status')==='draft' )>
                        Draft
                    </option>

                    <option
                        value="issued"
                        @selected(request('status')==='issued' )>
                        Diterbitkan
                    </option>

                    <option
                        value="suspended"
                        @selected(request('status')==='suspended' )>
                        Ditangguhkan
                    </option>

                    <option
                        value="cancelled"
                        @selected(request('status')==='cancelled' )>
                        Dibatalkan
                    </option>

                </select>

            </div>

            {{-- Buttons --}}
            <div class="flex gap-3 md:col-span-3">

                <button
                    type="submit"
                    class="rounded-xl bg-amber-500 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-amber-600">
                    Filter
                </button>

                <a
                    href="{{ route('hubin.introduction-letters.index') }}"
                    class="rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                    Reset
                </a>

            </div>

        </form>

    </div>

    {{-- Introduction Letters --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- Table Header --}}
        <div class="border-b border-slate-100 px-6 py-5">

            <h2 class="text-lg font-semibold text-slate-900">
                Daftar Surat
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                {{ $introductionLetters->count() }} surat ditemukan.
            </p>

        </div>

        @if ($introductionLetters->isNotEmpty())

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-slate-100">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Surat
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
                            Status
                        </th>

                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-100">

                    @foreach ($introductionLetters as $introductionLetter)

                    @php
                    $application = $introductionLetter->internshipApplication;
                    @endphp

                    <tr class="transition hover:bg-slate-50">

                        {{-- Letter --}}
                        <td class="px-6 py-4">

                            <div>

                                <p class="font-semibold text-slate-900">
                                    {{ $introductionLetter->letter_number }}
                                </p>

                                <p class="mt-1 text-xs text-slate-400">
                                    {{ $introductionLetter->letter_date?->format('d/m/Y') ?? '-' }}
                                </p>

                            </div>

                        </td>

                        {{-- Application --}}
                        <td class="px-6 py-4">

                            @if ($application)

                            <a
                                href="{{ route('hubin.applications.show', $application) }}"
                                class="font-medium text-slate-900 transition hover:text-amber-600">
                                {{ $application->application_code }}
                            </a>

                            <p class="mt-1 text-xs text-slate-400">
                                Pengajuan PKL
                            </p>

                            @else

                            <span class="text-sm text-slate-400">
                                -
                            </span>

                            @endif

                        </td>

                        {{-- Student --}}
                        <td class="px-6 py-4">

                            @if ($application?->leaderStudent)

                            <p class="font-medium text-slate-900">
                                {{ $application->leaderStudent->full_name }}
                            </p>

                            <p class="mt-1 text-sm text-slate-500">
                                {{ $application->leaderStudent->class ?? '-' }}
                            </p>

                            @if ($application->groupMembers->isNotEmpty())

                            <p class="mt-1 text-xs text-amber-600">
                                Ketua Kelompok ·
                                {{ $application->groupMembers->count() + 1 }} anggota
                            </p>

                            @endif

                            @else

                            <span class="text-sm text-slate-400">
                                -
                            </span>

                            @endif

                        </td>

                        {{-- Company --}}
                        <td class="px-6 py-4">

                            @if ($application?->company)

                            <p class="font-medium text-slate-900">
                                {{ $application->company->company_name }}
                            </p>

                            @else

                            <span class="text-sm text-slate-400">
                                -
                            </span>

                            @endif

                        </td>

                        {{-- Status --}}
                        <td class="px-6 py-4 text-center">

                            @if ($introductionLetter->status === 'draft')

                            <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                Draft
                            </span>

                            @elseif ($introductionLetter->status === 'issued')

                            <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                Diterbitkan
                            </span>

                            @elseif ($introductionLetter->status === 'suspended')

                            <span class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                                Ditangguhkan
                            </span>

                            @elseif ($introductionLetter->status === 'cancelled')

                            <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                Dibatalkan
                            </span>

                            @endif

                            @if (
                            in_array(
                            $introductionLetter->status,
                            ['suspended', 'cancelled']
                            )
                            && $introductionLetter->withdrawn_at
                            )

                            <p class="mt-2 text-xs text-slate-400">
                                {{ $introductionLetter->withdrawn_at->format('d/m/Y H:i') }}
                            </p>

                            @endif

                        </td>

                        {{-- Action --}}
                        <td class="px-6 py-4 text-right">

                            <a
                                href="{{ route('hubin.introduction-letters.show', $introductionLetter) }}"
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

        {{-- Empty State --}}
        <div class="px-6 py-12 text-center">

            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-100">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    class="h-6 w-6 text-slate-400">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19.5 14.25v-8.25A2.25 2.25 0 0 0 17.25 3.75h-10.5A2.25 2.25 0 0 0 4.5 6v12a2.25 2.25 0 0 0 2.25 2.25h10.5A2.25 2.25 0 0 0 19.5 18v-3.75" />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M8.25 8.25h7.5M8.25 12h5.25" />

                </svg>

            </div>

            <h3 class="mt-4 text-sm font-semibold text-slate-900">
                Tidak ada surat
            </h3>

            <p class="mt-1 text-sm text-slate-500">
                Belum ada surat pengantar yang sesuai dengan filter.
            </p>

        </div>

        @endif

    </div>

</div>

@endsection