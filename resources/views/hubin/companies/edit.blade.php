@extends('layouts.app')

@section('title', 'Edit Perusahaan')

@section('content')

<div>

    {{-- Header --}}
    <div class="mb-8">

        <p class="text-sm font-medium text-amber-600">
            Hubin
        </p>

        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
            Edit Perusahaan
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Perbarui informasi perusahaan mitra PKL.
        </p>

    </div>


    {{-- Validation Errors --}}
    @if ($errors->any())

    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4">

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

                <ul class="mt-1 list-disc pl-5 text-sm text-red-700">

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


    <div class="max-w-3xl">

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

            <form
                action="{{ route('hubin.companies.update', $company) }}"
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
                        value="{{ old('company_name', $company->company_name) }}"
                        required
                        maxlength="255"
                        autofocus
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
                        class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500">{{ old('full_address', $company->full_address) }}</textarea>

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
                        value="{{ old('hr_contact', $company->hr_contact) }}"
                        required
                        maxlength="255"
                        class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500">

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

                        Kuota PKL

                    </label>

                    <input
                        type="number"
                        id="available_quota"
                        name="available_quota"
                        value="{{ old('available_quota', $company->available_quota) }}"
                        required
                        min="0"
                        step="1"
                        inputmode="numeric"
                        class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500">

                    <p class="mt-2 text-xs text-slate-400">
                        Jumlah siswa yang dapat diterima perusahaan.
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

                    <select
                        id="partner_status"
                        name="partner_status"
                        required
                        class="mt-2 block w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500">

                        <option
                            value="active"
                            @selected(old('partner_status', $company->partner_status) === 'active')>

                            Aktif

                        </option>

                        <option
                            value="inactive"
                            @selected(old('partner_status', $company->partner_status) === 'inactive')>

                            Tidak Aktif

                        </option>

                    </select>

                    @error('partner_status')

                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>

                    @enderror

                </div>


                {{-- Actions --}}
                <div class="flex items-center gap-3 border-t border-slate-100 pt-6">

                    <button
                        type="submit"
                        class="rounded-xl bg-amber-500 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-amber-600">

                        Simpan Perubahan

                    </button>

                    <a
                        href="{{ route('hubin.companies.index') }}"
                        class="rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">

                        Batal

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection