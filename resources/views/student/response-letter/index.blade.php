@extends('layouts.app')

@section('title', 'Surat Balasan')

@section('content')

<div>

    {{-- Page Header --}}
    <div class="mb-8">

        <p class="text-sm font-medium text-amber-600">
            Student
        </p>

        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
            Surat Balasan
        </h1>

        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
            Lihat surat pengantar PKL dan respons perusahaan
            terhadap pengajuan yang telah Anda kirim.
        </p>

    </div>


    {{-- Applications --}}
    @if ($applications->isNotEmpty())

    <div class="space-y-5">

        @foreach ($applications as $application)

        @php
        $introductionLetter = $application->introductionLetter;
        $companyResponse = $application->companyResponse;

        $isGroup = $application->groupMembers->isNotEmpty();

        $totalStudents = $isGroup
        ? $application->groupMembers->count() + 1
        : 1;
        @endphp

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

                    <div class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-1 text-sm text-slate-500">

                        <span>
                            {{ $application->company->company_name }}
                        </span>

                        @if ($isGroup)

                        <span>
                            {{ $totalStudents }} siswa
                        </span>

                        @else

                        <span>
                            Pengajuan Individu
                        </span>

                        @endif

                    </div>

                </div>


                {{-- Application Status --}}
                @if ($application->status === 'approved')

                <span class="inline-flex w-fit rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                    Disetujui Hubin
                </span>

                @elseif ($application->status === 'rejected')

                <span class="inline-flex w-fit rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">
                    Ditolak Hubin
                </span>

                @else

                <span class="inline-flex w-fit rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
                    Menunggu Validasi Hubin
                </span>

                @endif

            </div>


            {{-- Introduction Letter --}}
            <div class="mt-6 rounded-xl border border-slate-200 bg-slate-50 p-5">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                    <div class="flex gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-amber-100 text-amber-600">

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
                                    d="M19.5 14.25v-8.625a2.25 2.25 0 0 0-2.25-2.25h-10.5a2.25 2.25 0 0 0-2.25 2.25v13.5a2.25 2.25 0 0 0 2.25 2.25h7.5m5.25-7.125-3.75 3.75m0 0-1.5-1.5m1.5 1.5 1.5 1.5" />

                            </svg>

                        </div>

                        <div>

                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                Surat Pengantar PKL
                            </p>

                            @if ($introductionLetter)

                            <p class="mt-1 text-sm font-semibold text-slate-800">
                                Surat Pengantar
                            </p>

                            @else

                            <p class="mt-1 text-sm font-semibold text-slate-800">
                                Belum tersedia
                            </p>

                            @endif

                        </div>

                    </div>


                    {{-- Letter Status --}}
                    @if ($introductionLetter?->status === 'issued')

                    <span class="inline-flex w-fit rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                        Diterbitkan
                    </span>

                    @elseif ($introductionLetter?->status === 'draft')

                    <span class="inline-flex w-fit rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
                        Draft
                    </span>

                    @elseif ($introductionLetter?->status === 'suspended')

                    <span class="inline-flex w-fit rounded-full bg-orange-50 px-3 py-1 text-xs font-semibold text-orange-700">
                        Ditangguhkan
                    </span>

                    @elseif ($introductionLetter?->status === 'cancelled')

                    <span class="inline-flex w-fit rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">
                        Dibatalkan
                    </span>

                    @else

                    <span class="inline-flex w-fit rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-500">
                        Belum Dibuat
                    </span>

                    @endif

                </div>


                @if ($introductionLetter)

                <div class="mt-4 grid gap-4 sm:grid-cols-2">

                    <div>

                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Nomor Surat
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-700">
                            {{ $introductionLetter->letter_number }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Tanggal Surat
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-700">
                            {{ $introductionLetter->letter_date
                                ? $introductionLetter->letter_date->translatedFormat('d F Y')
                                : '-' }}
                        </p>

                    </div>

                </div>


                @if ($introductionLetter->status === 'issued')

                <div class="mt-4">

                    <a
                        href="{{ route('hubin.introduction-letters.pdf', $introductionLetter) }}"
                        target="_blank"
                        class="inline-flex items-center gap-2 rounded-lg border border-blue-200 bg-white px-3 py-2 text-xs font-semibold text-blue-700 transition hover:bg-blue-50">

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
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707L19 19a2 2 0 0 1-2 2Z" />

                        </svg>

                        Lihat Surat Pengantar

                    </a>

                </div>

                @endif

                @else

                <p class="mt-4 text-sm leading-6 text-slate-500">
                    Surat pengantar belum dibuat oleh Hubin.
                </p>

                @endif

            </div>


            {{-- Company Response --}}
            <div class="mt-5 rounded-xl border border-slate-200 bg-white p-5">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                    <div class="flex gap-3">

                        @php
                        $responseIconClass = 'bg-slate-100 text-slate-400';

                        if ($companyResponse?->status === 'accepted') {
                        $responseIconClass = 'bg-emerald-100 text-emerald-600';
                        }

                        if ($companyResponse?->status === 'rejected') {
                        $responseIconClass = 'bg-red-100 text-red-600';
                        }

                        if ($companyResponse?->status === 'withdrawn') {
                        $responseIconClass = 'bg-slate-100 text-slate-500';
                        }

                        if (
                        $application->status === 'approved' &&
                        ! $companyResponse
                        ) {
                        $responseIconClass = 'bg-amber-100 text-amber-600';
                        }
                        @endphp

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full {{ $responseIconClass }}">

                            @if ($companyResponse?->status === 'accepted')

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
                                    d="m5 12 4 4L19 6" />

                            </svg>

                            @elseif (
                            $companyResponse?->status === 'rejected' ||
                            $companyResponse?->status === 'withdrawn'
                            )

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
                                    d="M6 18 18 6M6 6l12 12" />

                            </svg>

                            @else

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
                                    d="M12 6v6l4 2" />

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="9" />

                            </svg>

                            @endif

                        </div>

                        <div>

                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                Respons Perusahaan
                            </p>

                            <p class="mt-1 text-sm font-semibold text-slate-800">
                                {{ $application->company->company_name }}
                            </p>

                        </div>

                    </div>


                    {{-- Response Badge --}}
                    @if ($companyResponse?->status === 'accepted')

                    <span class="inline-flex w-fit rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                        Diterima
                    </span>

                    @elseif ($companyResponse?->status === 'rejected')

                    <span class="inline-flex w-fit rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">
                        Ditolak
                    </span>

                    @elseif ($companyResponse?->status === 'withdrawn')

                    <span class="inline-flex w-fit rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                        Respons Dibatalkan
                    </span>

                    @elseif ($companyResponse?->status === 'pending')

                    <span class="inline-flex w-fit rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
                        Menunggu Respons
                    </span>

                    @elseif ($application->status === 'approved')

                    <span class="inline-flex w-fit rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
                        Menunggu Respons
                    </span>

                    @else

                    <span class="inline-flex w-fit rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-500">
                        Belum Dapat Diproses
                    </span>

                    @endif

                </div>


                <div class="mt-4">

                    @if ($application->status !== 'approved')

                    <p class="text-sm leading-6 text-slate-500">
                        Respons perusahaan belum dapat diberikan
                        sebelum pengajuan disetujui Hubin.
                    </p>

                    @elseif (! $companyResponse)

                    <p class="text-sm leading-6 text-slate-500">
                        Pengajuan telah disetujui Hubin dan
                        sedang menunggu respons perusahaan.
                    </p>

                    @elseif ($companyResponse->status === 'pending')

                    <p class="text-sm leading-6 text-slate-500">
                        Perusahaan belum memberikan keputusan
                        terhadap pengajuan PKL.
                    </p>

                    @elseif ($companyResponse->status === 'accepted')

                    <p class="text-sm leading-6 text-emerald-700">
                        Pengajuan PKL telah diterima oleh perusahaan.
                    </p>

                    @elseif ($companyResponse->status === 'rejected')

                    <p class="text-sm leading-6 text-red-700">
                        Pengajuan PKL ditolak oleh perusahaan.
                    </p>

                    @elseif ($companyResponse->status === 'withdrawn')

                    <p class="text-sm leading-6 text-slate-500">
                        Respons perusahaan sebelumnya telah dibatalkan.
                    </p>

                    @endif

                </div>


                @if (
                $companyResponse &&
                $companyResponse->responded_at
                )

                <div class="mt-4 border-t border-slate-100 pt-4">

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Tanggal Respons
                    </p>

                    <p class="mt-1 text-sm font-medium text-slate-700">
                        {{ $companyResponse->responded_at->translatedFormat('d F Y, H:i') }}
                    </p>

                </div>

                @endif

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
            Anda belum memiliki pengajuan PKL yang dapat ditampilkan.
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