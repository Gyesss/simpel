@extends('layouts.app')

@section('title', 'Status Pengajuan')

@section('content')

<div>

    {{-- Page Header --}}
    <div class="mb-8">

        <p class="text-sm font-medium text-amber-600">
            Student
        </p>

        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
            Status Pengajuan
        </h1>

        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
            Pantau perkembangan pengajuan Praktik Kerja Lapangan (PKL)
            yang telah Anda kirim.
        </p>

    </div>


    {{-- Success Message --}}
    @if (session('success'))

    <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 p-4">

        <div class="flex gap-3">

            <div class="mt-0.5 shrink-0 text-emerald-600">

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
                        d="m4.5 12.75 4.5 4.5 10.5-10.5" />

                </svg>

            </div>

            <p class="text-sm leading-6 text-emerald-800">
                {{ session('success') }}
            </p>

        </div>

    </div>

    @endif


    {{-- Applications --}}
    @if ($applications->isNotEmpty())

    <div class="space-y-5">

        @foreach ($applications as $application)

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

            {{-- Application Header --}}
            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Kode Pengajuan
                    </p>

                    <h2 class="mt-1 text-lg font-bold text-slate-900">
                        {{ $application->application_code }}
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Diajukan pada
                        {{ \Carbon\Carbon::parse($application->application_date)->translatedFormat('d F Y') }}
                    </p>

                </div>


                <div class="flex flex-wrap items-center gap-2">

                    {{-- Status Badge --}}
                    @if ($application->status === 'submitted')

                    <span class="inline-flex w-fit rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
                        Menunggu Validasi Hubin
                    </span>

                    @elseif ($application->status === 'approved')

                    <span class="inline-flex w-fit rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                        Disetujui Hubin
                    </span>

                    @elseif ($application->status === 'rejected')

                    <span class="inline-flex w-fit rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">
                        Ditolak Hubin
                    </span>

                    @endif


                    {{-- Leader Actions --}}
                    @if (
                    $application->status === 'submitted' &&
                    $application->leader_student_id === auth()->id()
                    )

                    @if ($application->groupMembers->isNotEmpty())

                    <a
                        href="{{ route('student.applications.group.edit', $application) }}"
                        class="inline-flex items-center gap-1.5 rounded-lg border border-amber-500 bg-white px-3 py-1.5 text-xs font-semibold text-amber-600 transition hover:bg-amber-50">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="h-4 w-4">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13l-2.685.895.895-2.685a4.5 4.5 0 0 1 1.13-1.897l8.837-9.026Z" />

                        </svg>

                        Sunting

                    </a>

                    @else

                    <a
                        href="{{ route('student.applications.individual.edit', $application) }}"
                        class="inline-flex items-center gap-1.5 rounded-lg border border-amber-500 bg-white px-3 py-1.5 text-xs font-semibold text-amber-600 transition hover:bg-amber-50">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="h-4 w-4">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13l-2.685.895.895-2.685a4.5 4.5 0 0 1 1.13-1.897l8.837-9.026Z" />

                        </svg>

                        Sunting

                    </a>

                    @endif


                    <form
                        action="{{ route('student.applications.cancel', $application) }}"
                        method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pengajuan ini? Data pengajuan akan dihapus dan tidak dapat dikembalikan.');">

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="inline-flex items-center gap-1.5 rounded-lg border border-red-200 bg-white px-3 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-50">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.8"
                                stroke="currentColor"
                                class="h-4 w-4">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 18 18 6M6 6l12 12" />

                            </svg>

                            Batalkan

                        </button>

                    </form>

                    @endif

                </div>

            </div>


            {{-- Company --}}
            <div class="mt-6 rounded-xl bg-slate-50 p-4">

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Perusahaan Mitra
                </p>

                <p class="mt-1 text-sm font-semibold text-slate-800">
                    {{ $application->company->company_name }}
                </p>

                <p class="mt-1 text-sm text-slate-500">
                    {{ $application->company->full_address }}
                </p>

            </div>


            {{-- Group Members --}}
            @if ($application->groupMembers->isNotEmpty())

            <div class="mt-5 rounded-xl border border-slate-200 bg-white p-4">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Kelompok PKL
                        </p>

                        <p class="mt-1 text-sm font-semibold text-slate-800">
                            Daftar Peserta
                        </p>

                    </div>

                    <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
                        {{ $application->groupMembers->count() + 1 }} siswa
                    </span>

                </div>


                {{-- Leader --}}
                <div class="mt-4 rounded-xl border border-amber-200 bg-amber-50 p-4">

                    <div class="flex items-start gap-3">

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-amber-100 text-amber-600">

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
                                    d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0" />

                            </svg>

                        </div>

                        <div class="min-w-0">

                            <div class="flex flex-wrap items-center gap-2">

                                <p class="text-sm font-semibold text-slate-800">
                                    {{ $application->leaderStudent->full_name }}
                                </p>

                                <span class="rounded-full bg-amber-200 px-2 py-0.5 text-xs font-semibold text-amber-800">
                                    Ketua
                                </span>

                            </div>

                            <p class="mt-1 text-xs text-slate-500">
                                NIS/NIP:
                                <span class="font-medium text-slate-700">
                                    {{ $application->leaderStudent->nis_nip }}
                                </span>
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Members --}}
                <div class="mt-3 space-y-2">

                    @foreach ($application->groupMembers as $member)

                    <div class="flex items-center gap-3 rounded-xl border border-slate-100 bg-slate-50 p-3">

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-white text-slate-400">

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
                                    d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0 3.75 3.75 0 0 1 0 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0" />

                            </svg>

                        </div>

                        <div class="min-w-0">

                            <p class="text-sm font-medium text-slate-800">
                                {{ $member->student->full_name }}
                            </p>

                            <p class="mt-0.5 text-xs text-slate-500">
                                NIS/NIP:
                                <span class="font-medium text-slate-700">
                                    {{ $member->student->nis_nip }}
                                </span>
                            </p>

                        </div>

                    </div>

                    @endforeach

                </div>

            </div>

            @endif


            {{-- Internship Period --}}
            <div class="mt-5 grid gap-4 sm:grid-cols-2">

                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Mulai PKL
                    </p>

                    <p class="mt-1 text-sm font-medium text-slate-700">
                        {{ \Carbon\Carbon::parse($application->internship_start_date)->translatedFormat('d F Y') }}
                    </p>

                </div>


                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Selesai PKL
                    </p>

                    <p class="mt-1 text-sm font-medium text-slate-700">
                        {{ \Carbon\Carbon::parse($application->internship_end_date)->translatedFormat('d F Y') }}
                    </p>

                </div>

            </div>


            {{-- Status Timeline --}}
            <div class="mt-6 border-t border-slate-100 pt-6">

                <p class="text-sm font-semibold text-slate-800">
                    Tahapan Pengajuan
                </p>

                <div class="mt-5 space-y-5">

                    {{-- Submitted --}}
                    <div class="flex gap-3">

                        <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-amber-100 text-amber-600">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="h-4 w-4">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m5 12 4 4L19 6" />

                            </svg>

                        </div>

                        <div>

                            <p class="text-sm font-medium text-slate-800">
                                Pengajuan Dikirim
                            </p>

                            <p class="mt-0.5 text-xs text-slate-500">
                                Pengajuan telah diterima oleh sistem.
                            </p>

                        </div>

                    </div>


                    {{-- Hubin Approval --}}
                    <div class="flex gap-3">

                        <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full
                                    {{ $application->status === 'approved'
                                        ? 'bg-emerald-100 text-emerald-600'
                                        : ($application->status === 'rejected'
                                            ? 'bg-red-100 text-red-600'
                                            : 'bg-slate-100 text-slate-400') }}">

                            @if ($application->status === 'approved')

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="h-4 w-4">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m5 12 4 4L19 6" />

                            </svg>

                            @else

                            <span class="text-xs font-bold">
                                2
                            </span>

                            @endif

                        </div>

                        <div>

                            <p class="text-sm font-medium text-slate-800">
                                Validasi Hubin
                            </p>

                            <p class="mt-0.5 text-xs text-slate-500">

                                @if ($application->status === 'approved')

                                Pengajuan telah disetujui Hubin.

                                @elseif ($application->status === 'rejected')

                                Pengajuan ditolak oleh Hubin.

                                @else

                                Pengajuan sedang menunggu validasi Hubin.

                                @endif

                            </p>

                        </div>

                    </div>


                    {{-- Response Letter --}}
                    <div class="flex gap-3">

                        <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-slate-100 text-slate-400">

                            <span class="text-xs font-bold">
                                3
                            </span>

                        </div>

                        <div>

                            <p class="text-sm font-medium text-slate-800">
                                Surat Balasan Industri
                            </p>

                            <p class="mt-0.5 text-xs text-slate-500">
                                Upload surat balasan setelah mendapatkan
                                konfirmasi dari perusahaan.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

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
                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />

            </svg>

        </div>

        <h2 class="mt-4 text-base font-semibold text-slate-800">
            Belum ada pengajuan
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Anda belum memiliki pengajuan PKL.
        </p>

        <a
            href="{{ route('student.applications.index') }}"
            class="mt-5 inline-flex items-center justify-center rounded-xl bg-amber-500 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-amber-600">

            Buat Pengajuan

        </a>

    </div>

    @endif

</div>

@endsection