@extends('layouts.app')

@section('title', 'Detail Pengajuan PKL')

@section('content')

<div>

    {{-- Header --}}
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

        <div>

            <p class="text-sm font-medium text-amber-600">
                Hubin
            </p>

            <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
                Detail Pengajuan PKL
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                {{ $application->application_code }}
            </p>

        </div>


        <a
            href="{{ route('hubin.applications.index') }}"
            class="inline-flex items-center justify-center rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">

            Kembali

        </a>

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


    <div class="grid gap-6 lg:grid-cols-3">


        {{-- Main Information --}}
        <div class="space-y-6 lg:col-span-2">


            {{-- Application Information --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <h2 class="mb-6 text-lg font-semibold text-slate-900">
                    Informasi Pengajuan
                </h2>

                <div class="grid gap-5 md:grid-cols-2">


                    {{-- Application Code --}}
                    <div>

                        <p class="text-sm text-slate-500">
                            Kode Pengajuan
                        </p>

                        <p class="mt-1 font-semibold text-slate-900">
                            {{ $application->application_code }}
                        </p>

                    </div>


                    {{-- Application Date --}}
                    <div>

                        <p class="text-sm text-slate-500">
                            Tanggal Pengajuan
                        </p>

                        <p class="mt-1 font-medium text-slate-900">
                            {{ \Carbon\Carbon::parse($application->application_date)->format('d F Y') }}
                        </p>

                    </div>


                    {{-- Company --}}
                    <div class="md:col-span-2">

                        <p class="text-sm text-slate-500">
                            Perusahaan Tujuan
                        </p>

                        <p class="mt-1 font-semibold text-slate-900">
                            {{ $application->company->company_name ?? '-' }}
                        </p>

                        @if ($application->company)

                        <p class="mt-1 text-sm text-slate-500">
                            {{ $application->company->full_address }}
                        </p>

                        @endif

                    </div>


                    {{-- Start Date --}}
                    <div>

                        <p class="text-sm text-slate-500">
                            Mulai PKL
                        </p>

                        <p class="mt-1 font-medium text-slate-900">
                            {{ \Carbon\Carbon::parse($application->internship_start_date)->format('d F Y') }}
                        </p>

                    </div>


                    {{-- End Date --}}
                    <div>

                        <p class="text-sm text-slate-500">
                            Selesai PKL
                        </p>

                        <p class="mt-1 font-medium text-slate-900">
                            {{ \Carbon\Carbon::parse($application->internship_end_date)->format('d F Y') }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- Leader --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <h2 class="mb-6 text-lg font-semibold text-slate-900">
                    Ketua Pengajuan
                </h2>

                @if ($application->leaderStudent)

                <div class="rounded-xl border border-slate-100 p-4">

                    <p class="font-semibold text-slate-900">
                        {{ $application->leaderStudent->full_name }}
                    </p>

                    <div class="mt-2 grid gap-2 sm:grid-cols-2">

                        <p class="text-sm text-slate-500">
                            NIS/NIP:
                            <span class="text-slate-700">
                                {{ $application->leaderStudent->nis_nip ?? '-' }}
                            </span>
                        </p>

                        <p class="text-sm text-slate-500">
                            Kelas:
                            <span class="text-slate-700">
                                {{ $application->leaderStudent->class ?? '-' }}
                            </span>
                        </p>

                    </div>

                </div>

                @else

                <p class="text-sm text-slate-500">
                    Data ketua tidak ditemukan.
                </p>

                @endif

            </div>


            {{-- Group Members --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="mb-6">

                    <h2 class="text-lg font-semibold text-slate-900">
                        Anggota Kelompok
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $application->groupMembers->count() }} anggota terdaftar.
                    </p>

                </div>


                @if ($application->groupMembers->isNotEmpty())

                <div class="space-y-3">

                    @foreach ($application->groupMembers as $member)

                    <div class="flex items-center justify-between gap-4 rounded-xl border border-slate-100 p-4">

                        <div>

                            <p class="font-medium text-slate-900">
                                {{ $member->student->full_name ?? '-' }}
                            </p>

                            <p class="mt-1 text-sm text-slate-500">
                                Kelas:
                                {{ $member->student->class ?? '-' }}
                            </p>

                        </div>


                        @if ($member->student_id === $application->leader_student_id)

                        <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                            Ketua
                        </span>

                        @endif

                    </div>

                    @endforeach

                </div>

                @else

                <p class="text-sm text-slate-500">
                    Pengajuan ini tidak memiliki anggota kelompok tambahan.
                </p>

                @endif

            </div>

        </div>


        {{-- Sidebar --}}
        <div class="space-y-6">


            {{-- Status --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <h2 class="mb-5 text-lg font-semibold text-slate-900">
                    Status Pengajuan
                </h2>


                {{-- Submitted --}}
                @if ($application->status === 'submitted')

                <div class="rounded-xl bg-amber-50 p-4">

                    <p class="text-sm font-semibold text-amber-800">
                        Menunggu Proses
                    </p>

                    <p class="mt-1 text-sm text-amber-700">
                        Pengajuan ini belum diproses oleh Hubin.
                    </p>

                </div>


                {{-- Approve --}}
                <form
                    action="{{ route('hubin.applications.approve', $application) }}"
                    method="POST"
                    class="mt-4"
                    onsubmit="return confirm('Yakin ingin menyetujui pengajuan ini?');">

                    @csrf
                    @method('PATCH')

                    <button
                        type="submit"
                        class="w-full rounded-xl bg-green-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-green-700">

                        Setujui Pengajuan

                    </button>

                </form>


                {{-- Reject --}}
                <form
                    action="{{ route('hubin.applications.reject', $application) }}"
                    method="POST"
                    class="mt-3"
                    onsubmit="return confirm('Yakin ingin menolak pengajuan ini?');">

                    @csrf
                    @method('PATCH')

                    <button
                        type="submit"
                        class="w-full rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-600 transition hover:bg-red-100">

                        Tolak Pengajuan

                    </button>

                </form>


                {{-- Approved --}}
                @elseif ($application->status === 'approved')

                <div class="rounded-xl bg-green-50 p-4">

                    <p class="text-sm font-semibold text-green-800">
                        Pengajuan Disetujui
                    </p>

                    <p class="mt-1 text-sm text-green-700">
                        Pengajuan ini telah disetujui oleh Hubin.
                    </p>

                </div>


                {{-- Introduction Letter --}}
                @if ($application->introductionLetter)

                <a
                    href="{{ route('hubin.introduction-letters.show', $application->introductionLetter) }}"
                    class="mt-4 flex w-full items-center justify-center gap-2 rounded-xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        class="h-4 w-4">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414A1 1 0 0 1 19 9.414V19a2 2 0 0 1-2 2Z" />

                    </svg>

                    Lihat Surat Pengantar

                </a>

                @else

                <a
                    href="{{ route('hubin.introduction-letters.create', $application) }}"
                    class="mt-4 flex w-full items-center justify-center gap-2 rounded-xl bg-amber-500 px-4 py-3 text-sm font-semibold text-white transition hover:bg-amber-600">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        class="h-4 w-4">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 4v16m8-8H4" />

                    </svg>

                    Buat Surat Pengantar

                </a>

                @endif


                {{-- Reset Approved --}}
                <form
                    action="{{ route('hubin.applications.reset-status', $application) }}"
                    method="POST"
                    class="mt-3"
                    onsubmit="return confirm('Kembalikan pengajuan ini ke status Menunggu Proses?');">

                    @csrf
                    @method('PATCH')

                    <button
                        type="submit"
                        class="w-full rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm font-semibold text-amber-700 transition hover:bg-amber-100">

                        Kembalikan ke Menunggu

                    </button>

                </form>


                {{-- Rejected --}}
                @else

                <div class="rounded-xl bg-red-50 p-4">

                    <p class="text-sm font-semibold text-red-800">
                        Pengajuan Ditolak
                    </p>

                    <p class="mt-1 text-sm text-red-700">
                        Pengajuan ini telah ditolak oleh Hubin.
                    </p>

                </div>


                {{-- Reset Rejected --}}
                <form
                    action="{{ route('hubin.applications.reset-status', $application) }}"
                    method="POST"
                    class="mt-4"
                    onsubmit="return confirm('Kembalikan pengajuan ini ke status Menunggu Proses?');">

                    @csrf
                    @method('PATCH')

                    <button
                        type="submit"
                        class="w-full rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm font-semibold text-amber-700 transition hover:bg-amber-100">

                        Kembalikan ke Menunggu

                    </button>

                </form>

                @endif

            </div>


            {{-- Company Summary --}}
            @if ($application->company)

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <h2 class="mb-5 text-lg font-semibold text-slate-900">
                    Perusahaan
                </h2>

                <p class="font-semibold text-slate-900">
                    {{ $application->company->company_name }}
                </p>

                <p class="mt-2 text-sm leading-6 text-slate-500">
                    {{ $application->company->full_address }}
                </p>

                <div class="mt-4 border-t border-slate-100 pt-4">

                    <p class="text-sm text-slate-500">
                        Kontak HR
                    </p>

                    <p class="mt-1 text-sm font-medium text-slate-900">
                        {{ $application->company->hr_contact }}
                    </p>

                </div>

            </div>

            @endif

        </div>

    </div>

</div>

@endsection