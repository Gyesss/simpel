@extends('layouts.app')

@section('title', 'Pengajuan PKL')

@section('content')

<div>

    {{-- Header --}}
    <div class="mb-8">

        <p class="text-sm font-medium text-amber-600">
            Hubin
        </p>

        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
            Pengajuan PKL
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Tinjau dan proses pengajuan PKL siswa.
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
            action="{{ route('hubin.applications.index') }}"
            method="GET"
            class="grid gap-4 md:grid-cols-3">

            {{-- Search --}}
            <div class="md:col-span-2">

                <label
                    for="search"
                    class="block text-sm font-medium text-slate-700">

                    Cari Pengajuan

                </label>

                <input
                    type="text"
                    id="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Kode pengajuan, nama siswa, atau perusahaan"
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
                        value="submitted"
                        @selected(request('status')==='submitted' )>

                        Menunggu Proses

                    </option>

                    <option
                        value="approved"
                        @selected(request('status')==='approved' )>

                        Disetujui

                    </option>

                    <option
                        value="rejected"
                        @selected(request('status')==='rejected' )>

                        Ditolak

                    </option>

                </select>

            </div>


            {{-- Actions --}}
            <div class="flex gap-3 md:col-span-3">

                <button
                    type="submit"
                    class="rounded-xl bg-amber-500 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-amber-600">

                    Filter

                </button>

                <a
                    href="{{ route('hubin.applications.index') }}"
                    class="rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">

                    Reset

                </a>

            </div>

        </form>

    </div>


    {{-- Applications --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-6 py-5">

            <h2 class="text-lg font-semibold text-slate-900">
                Daftar Pengajuan
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                {{ $applications->count() }} pengajuan ditemukan.
            </p>

        </div>


        @if ($applications->isNotEmpty())

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-slate-100">

                <thead class="bg-slate-50">

                    <tr>

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
                            Periode
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

                    @foreach ($applications as $application)

                    @php
                    $isGroup = $application->groupMembers->isNotEmpty();
                    $memberCount = $application->groupMembers->count();
                    @endphp

                    <tr class="transition hover:bg-slate-50">


                        {{-- Application --}}
                        <td class="px-6 py-4">

                            <div class="flex flex-col items-start gap-2">

                                <p class="font-semibold text-slate-900">
                                    {{ $application->application_code }}
                                </p>


                                {{-- Application Type --}}
                                @if ($isGroup)

                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                        class="h-3.5 w-3.5">

                                        <path
                                            d="M7 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM13 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM2.5 16.5A4.5 4.5 0 0 1 7 12h0a4.5 4.5 0 0 1 4.5 4.5v.5h-9v-.5ZM11.5 12.17A4.49 4.49 0 0 1 13 12h0a4.5 4.5 0 0 1 4.5 4.5v.5h-5v-.5a5.48 5.48 0 0 0-1-3.17v-1.16Z" />

                                    </svg>

                                    Kelompok · {{ $memberCount }} anggota

                                </span>

                                @else

                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                        class="h-3.5 w-3.5">

                                        <path
                                            d="M10 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM4 16.5A6 6 0 0 1 10 10.5a6 6 0 0 1 6 6v.5H4v-.5Z" />

                                    </svg>

                                    Individual

                                </span>

                                @endif


                                <p class="text-xs text-slate-400">
                                    {{ \Carbon\Carbon::parse($application->application_date)->format('d/m/Y') }}
                                </p>

                            </div>

                        </td>


                        {{-- Student --}}
                        <td class="px-6 py-4">

                            <p class="font-medium text-slate-900">
                                {{ $application->leaderStudent->full_name ?? '-' }}
                            </p>

                            <p class="mt-1 text-sm text-slate-500">
                                {{ $application->leaderStudent->class ?? '-' }}
                            </p>

                            @if ($isGroup)

                            <p class="mt-1 text-xs text-amber-600">
                                Ketua Kelompok
                            </p>

                            @endif

                        </td>


                        {{-- Company --}}
                        <td class="px-6 py-4">

                            <p class="font-medium text-slate-900">
                                {{ $application->company->company_name ?? '-' }}
                            </p>

                        </td>


                        {{-- Period --}}
                        <td class="px-6 py-4 text-center">

                            <p class="text-sm text-slate-700">
                                {{ \Carbon\Carbon::parse($application->internship_start_date)->format('d/m/Y') }}
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                s/d
                            </p>

                            <p class="text-sm text-slate-700">
                                {{ \Carbon\Carbon::parse($application->internship_end_date)->format('d/m/Y') }}
                            </p>

                        </td>


                        {{-- Status --}}
                        <td class="px-6 py-4 text-center">

                            @if ($application->status === 'submitted')

                            <span class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                                Menunggu
                            </span>

                            @elseif ($application->status === 'approved')

                            <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                Disetujui
                            </span>

                            @else

                            <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                Ditolak
                            </span>

                            @endif

                        </td>


                        {{-- Action --}}
                        <td class="px-6 py-4 text-right">

                            <a
                                href="{{ route('hubin.applications.show', $application) }}"
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
                Tidak ada pengajuan
            </h3>

            <p class="mt-1 text-sm text-slate-500">
                Belum ada pengajuan PKL yang sesuai dengan filter.
            </p>

        </div>

        @endif

    </div>

</div>

@endsection