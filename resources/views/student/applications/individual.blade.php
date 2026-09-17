@extends('layouts.app')

@section('title', 'Pengajuan PKL Individu')

@section('content')

<div>

    {{-- Page Header --}}
    <div class="mb-8">

        <a
            href="{{ route('student.applications.index') }}"
            class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-amber-600">

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
                    d="M15.75 19.5 8.25 12l7.5-7.5" />

            </svg>

            Kembali ke Pengajuan

        </a>


        <p class="mt-6 text-sm font-medium text-amber-600">
            Student
        </p>

        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
            Pengajuan PKL Individu
        </h1>

        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
            Isi informasi pengajuan PKL Anda dengan lengkap dan benar.
        </p>

    </div>


    {{-- Application Form --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

        <form
            action="{{ route('student.applications.individual.store') }}"
            method="POST">

            @csrf

            {{-- Student Information --}}
            <div>

                <h2 class="text-base font-semibold text-slate-900">
                    Data Siswa
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Data berikut diambil dari akun Anda.
                </p>


                <div class="mt-5 grid gap-5 md:grid-cols-2">

                    {{-- Full Name --}}
                    <div>

                        <label
                            for="full_name"
                            class="block text-sm font-medium text-slate-700">

                            Nama Lengkap

                        </label>

                        <input
                            type="text"
                            id="full_name"
                            value="{{ auth()->user()->full_name }}"
                            readonly
                            class="mt-2 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600 outline-none">

                    </div>


                    {{-- NIS/NIP --}}
                    <div>

                        <label
                            for="nis_nip"
                            class="block text-sm font-medium text-slate-700">

                            NIS/NIP

                        </label>

                        <input
                            type="text"
                            id="nis_nip"
                            value="{{ auth()->user()->nis_nip }}"
                            readonly
                            class="mt-2 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600 outline-none">

                    </div>


                    {{-- Class --}}
                    <div>

                        <label
                            for="class"
                            class="block text-sm font-medium text-slate-700">

                            Kelas

                        </label>

                        <input
                            type="text"
                            id="class"
                            value="{{ auth()->user()->class }}"
                            readonly
                            class="mt-2 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600 outline-none">

                    </div>


                    {{-- Phone Number --}}
                    <div>

                        <label
                            for="phone_number"
                            class="block text-sm font-medium text-slate-700">

                            Nomor HP

                        </label>

                        <input
                            type="text"
                            id="phone_number"
                            value="{{ auth()->user()->phone_number }}"
                            readonly
                            class="mt-2 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600 outline-none">

                    </div>

                </div>

            </div>


            {{-- Divider --}}
            <div class="my-8 border-t border-slate-100"></div>


            {{-- PKL Information --}}
            <div>

                <h2 class="text-base font-semibold text-slate-900">
                    Data Pengajuan PKL
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Tentukan perusahaan dan periode pelaksanaan PKL.
                </p>


                <div class="mt-5 grid gap-5 md:grid-cols-2">

                    {{-- Company --}}
                    <div class="md:col-span-2">

                        <label
                            for="company_id"
                            class="block text-sm font-medium text-slate-700">

                            Perusahaan Mitra

                        </label>

                        <select
                            id="company_id"
                            name="company_id"
                            class="mt-2 block w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-amber-500 focus:ring-2 focus:ring-amber-100">

                            <option value="">
                                Pilih perusahaan
                            </option>

                            @foreach ($companies as $company)
                            <option value="{{ $company->id }}">
                                {{ $company->company_name }}
                                — {{ $company->available_quota }} kuota tersedia
                            </option>
                            @endforeach

                        </select>

                    </div>


                    {{-- Start Date --}}
                    <div>

                        <label
                            for="internship_start_date"
                            class="block text-sm font-medium text-slate-700">

                            Tanggal Mulai PKL

                        </label>

                        <input
                            type="date"
                            id="internship_start_date"
                            name="internship_start_date"
                            class="mt-2 block w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-amber-500 focus:ring-2 focus:ring-amber-100">

                    </div>


                    {{-- End Date --}}
                    <div>

                        <label
                            for="internship_end_date"
                            class="block text-sm font-medium text-slate-700">

                            Tanggal Selesai PKL

                        </label>

                        <input
                            type="date"
                            id="internship_end_date"
                            name="internship_end_date"
                            class="mt-2 block w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-amber-500 focus:ring-2 focus:ring-amber-100">

                    </div>

                </div>

            </div>


            {{-- Information --}}
            <div class="mt-8 rounded-xl border border-amber-200 bg-amber-50 p-4">

                <div class="flex gap-3">

                    <div class="mt-0.5 shrink-0 text-amber-600">

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
                                d="M12 9v3.75m0 3h.007v.008H12V15.75ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />

                        </svg>

                    </div>

                    <p class="text-sm leading-6 text-amber-800">
                        Pastikan perusahaan yang dipilih masih memiliki
                        kuota tersedia sebelum mengirim pengajuan.
                    </p>

                </div>

            </div>


            {{-- Actions --}}
            <div class="mt-8 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('student.applications.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">

                    Batal

                </a>


                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-amber-500 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-amber-600">

                    Ajukan PKL

                </button>

            </div>

        </form>

    </div>

</div>

@endsection