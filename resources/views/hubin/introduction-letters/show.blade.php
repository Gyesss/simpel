@extends('layouts.app')

@section('title', 'Detail Surat Pengantar')

@section('content')

<div class="mx-auto max-w-5xl">

    {{-- Header --}}
    <div class="mb-8">

        <a
            href="{{ route('hubin.introduction-letters.index') }}"
            class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-amber-600">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
                class="h-4 w-4">

                <path
                    fill-rule="evenodd"
                    d="M17 10a.75.75 0 0 1-.75.75H5.56l3.22 3.22a.75.75 0 1 1-1.06 1.06l-4.5-4.5a.75.75 0 0 1 0-1.06l4.5-4.5a.75.75 0 1 1 1.06 1.06L5.56 9.25h10.69A.75.75 0 0 1 17 10Z"
                    clip-rule="evenodd" />

            </svg>

            Kembali ke Daftar Surat

        </a>

        <div class="mt-6 flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

            <div>

                <p class="text-sm font-medium text-amber-600">
                    Hubin
                </p>

                <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
                    Detail Surat Pengantar
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Informasi dan pengelolaan status surat pengantar PKL.
                </p>

            </div>

            {{-- Status --}}
            <div class="shrink-0">

                @if ($introductionLetter->status === 'draft')

                <span class="inline-flex rounded-full bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-600">
                    Draft
                </span>

                @elseif ($introductionLetter->status === 'issued')

                <span class="inline-flex rounded-full bg-green-100 px-4 py-2 text-sm font-semibold text-green-700">
                    Diterbitkan
                </span>

                @elseif ($introductionLetter->status === 'suspended')

                <span class="inline-flex rounded-full bg-amber-100 px-4 py-2 text-sm font-semibold text-amber-700">
                    Ditangguhkan
                </span>

                @elseif ($introductionLetter->status === 'cancelled')

                <span class="inline-flex rounded-full bg-red-100 px-4 py-2 text-sm font-semibold text-red-700">
                    Dibatalkan
                </span>

                @endif

            </div>

        </div>

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

    {{-- Letter Information --}}
    <div class="mb-6 rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-6 py-5">

            <h2 class="text-lg font-semibold text-slate-900">
                Informasi Surat
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Data administrasi surat pengantar.
            </p>

        </div>

        <div class="grid gap-6 p-6 md:grid-cols-2">

            {{-- Letter Number --}}
            <div>

                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Nomor Surat
                </p>

                <p class="mt-1 font-semibold text-slate-900">
                    {{ $introductionLetter->letter_number }}
                </p>

            </div>

            {{-- Letter Date --}}
            <div>

                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Tanggal Surat
                </p>

                <p class="mt-1 font-medium text-slate-700">
                    {{ $introductionLetter->letter_date?->format('d/m/Y') ?? '-' }}
                </p>

            </div>

            {{-- Created --}}
            <div>

                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Dibuat
                </p>

                <p class="mt-1 font-medium text-slate-700">
                    {{ $introductionLetter->created_at?->format('d/m/Y H:i') ?? '-' }}
                </p>

            </div>

            {{-- Updated --}}
            <div>

                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Terakhir Diperbarui
                </p>

                <p class="mt-1 font-medium text-slate-700">
                    {{ $introductionLetter->updated_at?->format('d/m/Y H:i') ?? '-' }}
                </p>

            </div>

        </div>

    </div>

    {{-- Application Information --}}
    @if ($introductionLetter->internshipApplication)

    @php
    $application = $introductionLetter->internshipApplication;
    @endphp

    <div class="mb-6 rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="flex flex-col gap-3 border-b border-slate-100 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <h2 class="text-lg font-semibold text-slate-900">
                    Pengajuan PKL
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Pengajuan yang menjadi dasar surat ini.
                </p>

            </div>

            <a
                href="{{ route('hubin.applications.show', $application) }}"
                class="inline-flex items-center justify-center rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">

                Lihat Pengajuan

            </a>

        </div>

        <div class="grid gap-6 p-6 md:grid-cols-2">

            {{-- Application Code --}}
            <div>

                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Kode Pengajuan
                </p>

                <p class="mt-1 font-semibold text-slate-900">
                    {{ $application->application_code }}
                </p>

            </div>

            {{-- Application Status --}}
            <div>

                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Status Pengajuan
                </p>

                @if ($application->status === 'approved')

                <span class="mt-1 inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                    Disetujui
                </span>

                @elseif ($application->status === 'submitted')

                <span class="mt-1 inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                    Menunggu Proses
                </span>

                @else

                <span class="mt-1 inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                    Ditolak
                </span>

                @endif

            </div>

            {{-- Student --}}
            <div>

                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Ketua Kelompok / Siswa
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

            {{-- Group Type --}}
            <div>

                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Jenis Peserta
                </p>

                @if ($application->groupMembers->isNotEmpty())

                <p class="mt-1 font-medium text-slate-700">
                    Kelompok
                </p>

                <p class="mt-1 text-sm text-amber-600">
                    {{ $application->groupMembers->count() }} anggota
                </p>

                @else

                <p class="mt-1 font-medium text-slate-700">
                    Individual
                </p>

                @endif

            </div>

        </div>

        {{-- Group Members --}}
        @if ($application->groupMembers->isNotEmpty())

        <div class="border-t border-slate-100 px-6 py-5">

            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                Anggota Kelompok
            </p>

            <div class="mt-3 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">

                @foreach ($application->groupMembers as $member)

                <div class="rounded-xl border border-slate-100 bg-slate-50 px-4 py-3">

                    <p class="text-sm font-medium text-slate-800">
                        {{ $member->student->full_name ?? '-' }}
                    </p>

                    <p class="mt-1 text-xs text-slate-500">
                        {{ $member->student->class ?? '-' }}
                    </p>

                </div>

                @endforeach

            </div>

        </div>

        @endif

    </div>

    @endif

    {{-- Withdrawal Information --}}
    @if (
    in_array(
    $introductionLetter->status,
    ['suspended', 'cancelled']
    )
    )

    <div class="mb-6 rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-6 py-5">

            <h2 class="text-lg font-semibold text-slate-900">
                Informasi Penarikan
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Informasi mengenai penangguhan atau pembatalan surat.
            </p>

        </div>

        <div class="space-y-5 p-6">

            {{-- Reason --}}
            <div>

                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Alasan
                </p>

                <div class="mt-2 rounded-xl bg-slate-50 p-4">

                    <p class="whitespace-pre-line text-sm leading-6 text-slate-700">
                        {{ $introductionLetter->withdrawal_reason ?? '-' }}
                    </p>

                </div>

            </div>

            {{-- Withdrawal Metadata --}}
            <div class="grid gap-5 sm:grid-cols-2">

                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Waktu Penarikan
                    </p>

                    <p class="mt-1 text-sm font-medium text-slate-700">
                        {{ $introductionLetter->withdrawn_at?->format('d/m/Y H:i') ?? '-' }}
                    </p>

                </div>

                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Dilakukan Oleh
                    </p>

                    <p class="mt-1 text-sm font-medium text-slate-700">
                        {{ $introductionLetter->withdrawnBy->full_name ?? '-' }}
                    </p>

                </div>

            </div>

        </div>

    </div>

    @endif

    {{-- Document Preview Placeholder --}}
    <div class="mb-6 rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-6 py-5">

            <h2 class="text-lg font-semibold text-slate-900">
                Dokumen Surat
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Preview dan cetak PDF akan tersedia setelah format surat sekolah ditentukan.
            </p>

        </div>

        <div class="p-6">

            <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-6 py-10 text-center">

                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-white shadow-sm">

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

                <p class="mt-4 text-sm font-semibold text-slate-700">
                    Dokumen PDF belum tersedia
                </p>

                <p class="mx-auto mt-1 max-w-md text-sm leading-6 text-slate-500">
                    Struktur dan format surat sekolah akan ditentukan terlebih dahulu.
                    Setelah itu fitur preview dan cetak PDF dapat ditambahkan.
                </p>

            </div>

        </div>

    </div>

    {{-- Actions --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-6 py-5">

            <h2 class="text-lg font-semibold text-slate-900">
                Tindakan
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Tindakan yang tersedia untuk status surat saat ini.
            </p>

        </div>

        <div class="flex flex-col gap-3 p-6 sm:flex-row sm:flex-wrap">

            {{-- Issue --}}
            @if ($introductionLetter->status === 'draft')

            <form
                action="{{ route('hubin.introduction-letters.issue', $introductionLetter) }}"
                method="POST">

                @csrf
                @method('PATCH')

                <button
                    type="submit"
                    onclick="return confirm('Terbitkan surat pengantar ini?')"
                    class="inline-flex w-full items-center justify-center rounded-xl bg-green-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-green-700 sm:w-auto">

                    Terbitkan Surat

                </button>

            </form>

            {{-- Cancel Draft --}}
            <button
                type="button"
                onclick="document.getElementById('cancel-letter-form').classList.toggle('hidden')"
                class="inline-flex w-full items-center justify-center rounded-xl border border-red-200 px-5 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-50 sm:w-auto">

                Batalkan Surat

            </button>

            @endif

            {{-- Issued Actions --}}
            @if ($introductionLetter->status === 'issued')

            {{-- Preview --}}
            <button
                type="button"
                disabled
                class="inline-flex w-full cursor-not-allowed items-center justify-center rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-400 sm:w-auto">

                Preview PDF

            </button>

            {{-- Print --}}
            <button
                type="button"
                disabled
                class="inline-flex w-full cursor-not-allowed items-center justify-center rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-400 sm:w-auto">

                Cetak PDF

            </button>

            {{-- Suspend --}}
            <button
                type="button"
                onclick="document.getElementById('suspend-letter-form').classList.toggle('hidden')"
                class="inline-flex w-full items-center justify-center rounded-xl border border-amber-200 px-5 py-2.5 text-sm font-semibold text-amber-700 transition hover:bg-amber-50 sm:w-auto">

                Tangguhkan Surat

            </button>

            {{-- Cancel --}}
            <button
                type="button"
                onclick="document.getElementById('cancel-letter-form').classList.toggle('hidden')"
                class="inline-flex w-full items-center justify-center rounded-xl border border-red-200 px-5 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-50 sm:w-auto">

                Batalkan Surat

            </button>

            @endif

            {{-- Suspended --}}
            @if ($introductionLetter->status === 'suspended')

            <form
                action="{{ route('hubin.introduction-letters.restore', $introductionLetter) }}"
                method="POST">

                @csrf
                @method('PATCH')

                <button
                    type="submit"
                    onclick="return confirm('Aktifkan kembali surat ini?')"
                    class="inline-flex w-full items-center justify-center rounded-xl bg-green-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-green-700 sm:w-auto">

                    Aktifkan Kembali

                </button>

            </form>

            @endif

            {{-- Cancelled --}}
            @if ($introductionLetter->status === 'cancelled')

            <div class="rounded-xl bg-red-50 px-4 py-3">

                <p class="text-sm font-medium text-red-700">
                    Surat ini sudah dibatalkan dan tidak dapat diterbitkan kembali.
                </p>

            </div>

            @endif

            {{-- Back --}}
            <a
                href="{{ route('hubin.introduction-letters.index') }}"
                class="inline-flex w-full items-center justify-center rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 sm:w-auto">

                Kembali

            </a>

        </div>

    </div>

    {{-- Suspend Form --}}
    @if ($introductionLetter->status === 'issued')

    <div
        id="suspend-letter-form"
        class="mt-6 hidden rounded-2xl border border-amber-200 bg-amber-50 shadow-sm">

        <div class="border-b border-amber-200 px-6 py-5">

            <h2 class="text-lg font-semibold text-amber-900">
                Tangguhkan Surat
            </h2>

            <p class="mt-1 text-sm text-amber-700">
                Surat akan berubah menjadi status Ditangguhkan dan tidak dianggap sebagai surat aktif.
            </p>

        </div>

        <form
            action="{{ route('hubin.introduction-letters.suspend', $introductionLetter) }}"
            method="POST">

            @csrf
            @method('PATCH')

            <div class="p-6">

                <label
                    for="suspend_withdrawal_reason"
                    class="block text-sm font-medium text-amber-900">

                    Alasan Penangguhan

                    <span class="text-red-500">*</span>

                </label>

                <textarea
                    id="suspend_withdrawal_reason"
                    name="withdrawal_reason"
                    rows="4"
                    required
                    placeholder="Masukkan alasan penangguhan surat..."
                    class="mt-2 block w-full rounded-xl border-amber-200 bg-white px-4 py-3 text-sm shadow-sm placeholder:text-slate-400 focus:border-amber-500 focus:ring-amber-500">{{ old('withdrawal_reason') }}</textarea>

                @error('withdrawal_reason')

                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>

                @enderror

            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-amber-200 px-6 py-5 sm:flex-row sm:justify-end">

                <button
                    type="button"
                    onclick="document.getElementById('suspend-letter-form').classList.add('hidden')"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">

                    Batal

                </button>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-amber-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-amber-700">

                    Tangguhkan Surat

                </button>

            </div>

        </form>

    </div>

    @endif

    {{-- Cancel Form --}}
    @if (in_array($introductionLetter->status, ['draft', 'issued']))

    <div
        id="cancel-letter-form"
        class="mt-6 hidden rounded-2xl border border-red-200 bg-red-50 shadow-sm">

        <div class="border-b border-red-200 px-6 py-5">

            <h2 class="text-lg font-semibold text-red-900">
                Batalkan Surat
            </h2>

            <p class="mt-1 text-sm text-red-700">
                Pembatalan bersifat final. Surat yang dibatalkan tidak dapat diterbitkan kembali.
            </p>

        </div>

        <form
            action="{{ route('hubin.introduction-letters.cancel', $introductionLetter) }}"
            method="POST">

            @csrf
            @method('PATCH')

            <div class="p-6">

                <label
                    for="cancel_withdrawal_reason"
                    class="block text-sm font-medium text-red-900">

                    Alasan Pembatalan

                    <span class="text-red-500">*</span>

                </label>

                <textarea
                    id="cancel_withdrawal_reason"
                    name="withdrawal_reason"
                    rows="4"
                    required
                    placeholder="Masukkan alasan pembatalan surat..."
                    class="mt-2 block w-full rounded-xl border-red-200 bg-white px-4 py-3 text-sm shadow-sm placeholder:text-slate-400 focus:border-red-500 focus:ring-red-500">{{ old('withdrawal_reason') }}</textarea>

                @error('withdrawal_reason')

                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>

                @enderror

            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-red-200 px-6 py-5 sm:flex-row sm:justify-end">

                <button
                    type="button"
                    onclick="document.getElementById('cancel-letter-form').classList.add('hidden')"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">

                    Batal

                </button>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-red-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-red-700">

                    Batalkan Surat

                </button>

            </div>

        </form>

    </div>

    @endif

</div>

@endsection