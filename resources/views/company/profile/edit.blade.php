@extends('layouts.app')

@section('title', 'Edit Informasi Perusahaan')

@section('content')

<div>

    {{-- Header --}}
    <div class="mb-8">

        <p class="text-sm font-medium text-amber-600">
            Profile
        </p>

        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
            Edit Informasi Perusahaan
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Perbarui informasi perusahaan yang terhubung dengan akun Anda.
        </p>

    </div>


    {{-- Validation Errors --}}
    @if ($errors->any())

    <div class="mb-6 max-w-3xl rounded-2xl border border-red-200 bg-red-50 p-4">

        <div class="flex gap-3">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.8"
                stroke="currentColor"
                class="mt-0.5 h-5 w-5 shrink-0 text-red-600">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 9v3.75m9-3.75a9 9 0 1 1-18 0Zm-9 6h.008V15Z" />

            </svg>

            <div>

                <p class="text-sm font-semibold text-red-800">
                    Data belum dapat disimpan.
                </p>

                <p class="mt-1 text-sm leading-6 text-red-700">
                    Periksa kembali data perusahaan yang Anda masukkan.
                </p>

            </div>

        </div>

    </div>

    @endif


    {{-- Company Form --}}
    <div class="max-w-3xl">

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

            <div class="mb-6">

                <h2 class="text-lg font-semibold text-slate-900">
                    Informasi Perusahaan
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Informasi berikut dapat diperbarui oleh akun perusahaan.
                </p>

            </div>


            <form
                action="{{ route('company.profile.update') }}"
                method="POST"
                class="space-y-6">

                @csrf
                @method('PUT')


                {{-- Company Name --}}
                <div>

                    <label
                        for="company_name"
                        class="block text-sm font-medium text-slate-700">

                        Nama Perusahaan

                    </label>

                    <input
                        type="text"
                        id="company_name"
                        name="company_name"
                        value="{{ old('company_name', $user->company->company_name) }}"
                        required
                        maxlength="255"
                        class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500">

                    @error('company_name')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                {{-- Full Address --}}
                <div>

                    <label
                        for="full_address"
                        class="block text-sm font-medium text-slate-700">

                        Alamat Lengkap

                    </label>

                    <textarea
                        id="full_address"
                        name="full_address"
                        rows="4"
                        required
                        maxlength="1000"
                        class="mt-2 block w-full resize-y rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500">{{ old('full_address', $user->company->full_address) }}</textarea>

                    @error('full_address')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                {{-- HR Contact --}}
                <div>

                    <label
                        for="hr_contact"
                        class="block text-sm font-medium text-slate-700">

                        Kontak HR

                    </label>

                    <input
                        type="text"
                        id="hr_contact"
                        name="hr_contact"
                        value="{{ old('hr_contact', $user->company->hr_contact) }}"
                        required
                        maxlength="255"
                        class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500">

                    <p class="mt-2 text-xs text-slate-400">
                        Masukkan nama atau informasi kontak HR yang dapat dihubungi.
                    </p>

                    @error('hr_contact')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                {{-- Available Quota --}}
                <div>

                    <label
                        for="available_quota"
                        class="block text-sm font-medium text-slate-700">

                        Kuota Tersedia

                    </label>

                    <input
                        type="number"
                        id="available_quota"
                        name="available_quota"
                        value="{{ old('available_quota', $user->company->available_quota) }}"
                        min="0"
                        step="1"
                        required
                        class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500">

                    <p class="mt-2 text-xs text-slate-400">
                        Masukkan jumlah siswa yang masih dapat diterima.
                    </p>

                    @error('available_quota')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                {{-- Partner Status --}}
                <div>

                    <label
                        for="partner_status"
                        class="block text-sm font-medium text-slate-700">

                        Status Mitra

                    </label>

                    <input
                        type="text"
                        id="partner_status"
                        value="{{ ucfirst($user->company->partner_status) }}"
                        disabled
                        class="mt-2 block w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-500 shadow-sm">

                    <p class="mt-2 text-xs text-slate-400">
                        Status mitra ditentukan oleh Hubin dan tidak dapat diubah oleh akun perusahaan.
                    </p>

                </div>


                {{-- Actions --}}
                <div class="flex items-center gap-3 border-t border-slate-100 pt-6">

                    <button
                        type="submit"
                        class="rounded-xl bg-amber-500 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-amber-600">

                        Simpan Perubahan

                    </button>

                    <a
                        href="{{ route('profile.show') }}"
                        class="rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">

                        Batal

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection