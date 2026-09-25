@extends('layouts.app')

@section('title', 'Buat Surat Pengantar')

@section('content')

<div>

    {{-- Header --}}
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

        <div>

            <p class="text-sm font-medium text-amber-600">
                Hubin
            </p>

            <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
                Buat Surat Pengantar
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                {{ $application->application_code }}
            </p>

        </div>


        <a
            href="{{ route('hubin.applications.show', $application) }}"
            class="inline-flex items-center justify-center rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">

            Kembali

        </a>

    </div>


    <div class="grid gap-6 lg:grid-cols-3">


        {{-- Application Summary --}}
        <div class="space-y-6 lg:col-span-2">


            {{-- Student --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <h2 class="mb-5 text-lg font-semibold text-slate-900">
                    Data Pengajuan
                </h2>

                <div class="grid gap-5 sm:grid-cols-2">

                    <div>

                        <p class="text-sm text-slate-500">
                            Kode Pengajuan
                        </p>

                        <p class="mt-1 font-semibold text-slate-900">
                            {{ $application->application_code }}
                        </p>

                    </div>


                    <div>

                        <p class="text-sm text-slate-500">
                            Status
                        </p>

                        <span class="mt-1 inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                            Disetujui
                        </span>

                    </div>


                    <div>

                        <p class="text-sm text-slate-500">
                            Ketua
                        </p>

                        <p class="mt-1 font-semibold text-slate-900">
                            {{ $application->leaderStudent->full_name ?? '-' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-sm text-slate-500">
                            Kelas
                        </p>

                        <p class="mt-1 font-medium text-slate-900">
                            {{ $application->leaderStudent->class ?? '-' }}
                        </p>

                    </div>


                    <div class="sm:col-span-2">

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

                </div>

            </div>


            {{-- Group --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <h2 class="mb-5 text-lg font-semibold text-slate-900">
                    Peserta PKL
                </h2>


                @if ($application->groupMembers->isNotEmpty())

                <div class="space-y-3">

                    <div class="rounded-xl border border-amber-200 bg-amber-50 p-4">

                        <p class="text-xs font-semibold uppercase tracking-wide text-amber-700">
                            Ketua Kelompok
                        </p>

                        <p class="mt-1 font-semibold text-slate-900">
                            {{ $application->leaderStudent->full_name ?? '-' }}
                        </p>

                    </div>


                    @foreach ($application->groupMembers as $member)

                    <div class="rounded-xl border border-slate-100 p-4">

                        <p class="font-medium text-slate-900">
                            {{ $member->student->full_name ?? '-' }}
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            {{ $member->student->class ?? '-' }}
                        </p>

                    </div>

                    @endforeach

                </div>

                @else

                <div class="rounded-xl border border-slate-100 p-4">

                    <p class="font-medium text-slate-900">
                        {{ $application->leaderStudent->full_name ?? '-' }}
                    </p>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $application->leaderStudent->class ?? '-' }}
                    </p>

                    <span class="mt-3 inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                        Individual
                    </span>

                </div>

                @endif

            </div>

        </div>


        {{-- Form --}}
        <div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <h2 class="mb-2 text-lg font-semibold text-slate-900">
                    Surat Pengantar
                </h2>

                <p class="mb-6 text-sm leading-6 text-slate-500">
                    Tentukan tanggal surat. Nomor surat akan dibuat secara otomatis.
                </p>


                <form
                    action="{{ route('hubin.introduction-letters.store', $application) }}"
                    method="POST">

                    @csrf


                    {{-- Letter Date --}}
                    <div>

                        <label
                            for="letter_date"
                            class="block text-sm font-medium text-slate-700">

                            Tanggal Surat

                        </label>

                        <input
                            type="date"
                            id="letter_date"
                            name="letter_date"
                            value="{{ old('letter_date', now()->format('Y-m-d')) }}"
                            required
                            class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500">

                        @error('letter_date')

                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>

                        @enderror

                    </div>


                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="mt-6 w-full rounded-xl bg-amber-500 px-4 py-3 text-sm font-semibold text-white transition hover:bg-amber-600"
                        onclick="return confirm('Buat surat pengantar untuk pengajuan ini?');">

                        Buat Surat Pengantar

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection