@extends('layouts.app')

@section('title', 'Buat Surat Pengantar')

@section('content')

<div class="mx-auto max-w-4xl">

    {{-- Header --}}
    <div class="mb-8">

        <a
            href="{{ route('hubin.applications.show', $application) }}"
            class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-amber-600">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
                class="h-4 w-4">

                <path
                    fill-rule="evenodd"
                    d="M17 10a.75.75 0 0 1-.75.75H5.56l3.22 3.22a.75.75 0 1 1-1.06 1.06l-4.5-4.5a.75.75 0 0 1 0-1.06l4.5-4.5a.75.75 0 0 1 1.06 1.06L5.56 9.25h10.69A.75.75 0 0 1 17 10Z"
                    clip-rule="evenodd" />

            </svg>

            Kembali ke Detail Pengajuan

        </a>

        <p class="mt-6 text-sm font-medium text-amber-600">
            Hubin
        </p>

        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
            Buat Surat Pengantar
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Buat dokumen surat pengantar untuk pengajuan PKL yang telah disetujui.
        </p>

    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())

    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5">

        <div class="flex gap-3">

            <div class="mt-0.5 shrink-0">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    class="h-5 w-5 text-red-500">

                    <path
                        fill-rule="evenodd"
                        d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 1 1.06 0L10 7.88l.66-.66a.75.75 0 1 1 1.06 1.06l-.66.66a.75.75 0 1 1-1.06 1.06L10 10l-.66.66a.75.75 0 1 1-1.06-1.06l.66-.66-.66-.66a.75.75 0 0 1 0-1.06Z"
                        clip-rule="evenodd" />

                </svg>

            </div>

            <div>

                <p class="text-sm font-semibold text-red-800">
                    Terdapat kesalahan pada formulir.
                </p>

                <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700">

                    @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                    @endforeach

                </ul>

            </div>

        </div>

    </div>

    @endif

    {{-- Application Information --}}
    <div class="mb-6 rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-6 py-5">

            <div class="flex items-center justify-between gap-4">

                <div>

                    <h2 class="text-lg font-semibold text-slate-900">
                        Informasi Pengajuan
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Data berikut berasal dari pengajuan PKL yang disetujui.
                    </p>

                </div>

                <span class="inline-flex shrink-0 rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                    Disetujui
                </span>

            </div>

        </div>

        <div class="grid gap-6 p-6">

            <div class="grid gap-6 md:grid-cols-2">

                {{-- Application Code --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Kode Pengajuan
                    </p>

                    <p class="mt-1 font-semibold text-slate-900">
                        {{ $application->application_code }}
                    </p>

                </div>

                {{-- Application Date --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Tanggal Pengajuan
                    </p>

                    <p class="mt-1 font-medium text-slate-700">
                        {{ \Carbon\Carbon::parse($application->application_date)->format('d/m/Y') }}
                    </p>

                </div>

                {{-- Student --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Ketua / Siswa
                    </p>

                    <p class="mt-1 font-semibold text-slate-900">
                        {{ $application->leaderStudent->full_name ?? '-' }}
                    </p>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $application->leaderStudent->class ?? '-' }}
                    </p>

                </div>

                {{-- Company --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Perusahaan
                    </p>

                    <p class="mt-1 font-semibold text-slate-900">
                        {{ $application->company->company_name ?? '-' }}
                    </p>

                </div>

                {{-- Internship Period --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Periode PKL
                    </p>

                    <p class="mt-1 font-medium text-slate-700">
                        {{ \Carbon\Carbon::parse($application->internship_start_date)->format('d/m/Y') }}
                        <span class="mx-1 text-slate-400">s/d</span>
                        {{ \Carbon\Carbon::parse($application->internship_end_date)->format('d/m/Y') }}
                    </p>

                </div>

                {{-- Group --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Peserta
                    </p>

                    @if ($application->groupMembers->isNotEmpty())

                    <p class="mt-1 font-medium text-slate-700">
                        Kelompok
                    </p>

                    <p class="mt-1 text-sm text-amber-600">
                        {{ $application->groupMembers->count() + 1 }} anggota
                    </p>

                    @else

                    <p class="mt-1 font-medium text-slate-700">
                        Individual
                    </p>

                    @endif

                </div>

            </div>

        </div>

        @if ($application->groupMembers->isNotEmpty())

        <div class="border-t border-slate-100 px-6 py-5">

            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                Anggota Kelompok
            </p>

            <div class="mt-3 grid gap-2 sm:grid-cols-2">

                {{-- Leader --}}
                @if ($application->leaderStudent)

                <div class="rounded-xl border border-amber-200 bg-amber-50 px-4 py-3">

                    <div class="flex items-center justify-between gap-3">

                        <div>

                            <p class="text-sm font-medium text-slate-800">
                                {{ $application->leaderStudent->full_name }}
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                {{ $application->leaderStudent->class ?? '-' }}
                            </p>

                        </div>

                        <span class="shrink-0 rounded-full bg-amber-100 px-2.5 py-1 text-xs font-semibold text-amber-700">
                            Ketua
                        </span>

                    </div>

                </div>

                @endif


                {{-- Other Members --}}
                @foreach ($application->groupMembers as $member)

                @if ($member->student_id !== $application->leader_student_id)

                <div class="rounded-xl bg-slate-50 px-4 py-3">

                    <p class="text-sm font-medium text-slate-800">
                        {{ $member->student->full_name ?? '-' }}
                    </p>

                    <p class="mt-1 text-xs text-slate-500">
                        {{ $member->student->class ?? '-' }}
                    </p>

                </div>

                @endif

                @endforeach

            </div>

        </div>

        @endif

    </div>

    {{-- Letter Form --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-6 py-5">

            <h2 class="text-lg font-semibold text-slate-900">
                Data Surat
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Nomor surat akan dibuat otomatis oleh sistem.
            </p>

        </div>

        <form
            action="{{ route('hubin.introduction-letters.store', $application) }}"
            method="POST">

            @csrf

            <div class="space-y-6 p-6">

                {{-- Automatic Letter Number --}}
                <div>

                    <p class="block text-sm font-medium text-slate-700">
                        Nomor Surat
                    </p>

                    <div class="mt-2 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">

                        <div class="flex items-center gap-3">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-amber-100">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    class="h-5 w-5 text-amber-600">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414A1 1 0 0 1 19 9.414V19a2 2 0 0 1-2 2Z" />

                                </svg>

                            </div>

                            <div>

                                <p class="text-sm font-semibold text-slate-800">
                                    Dibuat otomatis oleh sistem
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    Nomor akan diberikan saat surat dibuat dan mengikuti urutan administrasi tahunan.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- Letter Date --}}
                <div>

                    <label
                        for="letter_date"
                        class="block text-sm font-medium text-slate-700">

                        Tanggal Surat

                        <span class="text-red-500">*</span>

                    </label>

                    <input
                        type="date"
                        id="letter_date"
                        name="letter_date"
                        value="{{ old('letter_date', now()->format('Y-m-d')) }}"
                        required
                        class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500">

                    <p class="mt-2 text-xs text-slate-400">
                        Tanggal yang tercantum pada surat pengantar.
                    </p>

                    @error('letter_date')

                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>

                    @enderror

                </div>

            </div>

            {{-- Notice --}}
            <div class="border-t border-slate-100 bg-slate-50 px-6 py-5">

                <div class="flex gap-3">

                    <div class="mt-0.5 shrink-0">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            class="h-5 w-5 text-slate-400">

                            <path
                                fill-rule="evenodd"
                                d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0ZM9.25 8.5a.75.75 0 1 1 1.5 0v5a.75.75 0 0 1-1.5 0v-5ZM10 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"
                                clip-rule="evenodd" />

                        </svg>

                    </div>

                    <div>

                        <p class="text-sm font-medium text-slate-700">
                            Surat akan dibuat sebagai draft
                        </p>

                        <p class="mt-1 text-sm leading-6 text-slate-500">
                            Setelah data disimpan, surat belum dianggap diterbitkan.
                            Nomor surat akan langsung tercatat dan Hubin dapat
                            memeriksa data terlebih dahulu sebelum menerbitkannya.
                        </p>

                    </div>

                </div>

            </div>

            {{-- Actions --}}
            <div class="flex flex-col-reverse gap-3 border-t border-slate-100 px-6 py-5 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('hubin.applications.show', $application) }}"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">

                    Batal

                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-amber-500 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-amber-600">

                    Buat Surat

                </button>

            </div>

        </form>

    </div>

</div>

@endsection