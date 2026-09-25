@extends('layouts.app')

@section('title', 'Data Perusahaan')

@section('content')

<div>

    {{-- Header --}}
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

        <div>

            <p class="text-sm font-medium text-amber-600">
                Hubin
            </p>

            <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
                Data Perusahaan
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Kelola data perusahaan yang menjadi mitra PKL sekolah.
            </p>

        </div>


        <a
            href="{{ route('hubin.companies.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-amber-500 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-amber-600">

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
                    d="M12 4.5v15m7.5-7.5h-15" />

            </svg>

            Tambah Perusahaan

        </a>

    </div>


    {{-- Success Notification --}}
    @if (session('success'))

    <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 p-4">

        <div class="flex gap-3">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.8"
                stroke="currentColor"
                class="mt-0.5 h-5 w-5 shrink-0 text-green-600">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="m4.5 12.75 6 6 9-13.5" />

            </svg>

            <p class="text-sm font-medium text-green-700">
                {{ session('success') }}
            </p>

        </div>

    </div>

    @endif


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
                    Data belum dapat diproses.
                </p>

                <p class="mt-1 text-sm text-red-700">
                    Periksa kembali data perusahaan yang dimasukkan.
                </p>

            </div>

        </div>

    </div>

    @endif


    {{-- Company List --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-6 py-5">

            <div class="flex items-center justify-between gap-4">

                <div>

                    <h2 class="text-lg font-semibold text-slate-900">
                        Daftar Perusahaan
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $companies->count() }} perusahaan terdaftar.
                    </p>

                </div>

            </div>

        </div>


        @if ($companies->isNotEmpty())

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-slate-100">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Perusahaan
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Kontak HR
                        </th>

                        <th class="px-6 py-3 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Kuota
                        </th>

                        <th class="px-6 py-3 text-center text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Status
                        </th>

                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100 bg-white">

                    @foreach ($companies as $company)

                    <tr class="transition hover:bg-slate-50">

                        {{-- Company --}}
                        <td class="px-6 py-4">

                            <div>

                                <p class="font-semibold text-slate-900">
                                    {{ $company->company_name }}
                                </p>

                                <p class="mt-1 max-w-md truncate text-sm text-slate-500">
                                    {{ $company->full_address }}
                                </p>

                            </div>

                        </td>


                        {{-- HR Contact --}}
                        <td class="px-6 py-4">

                            <p class="text-sm text-slate-700">
                                {{ $company->hr_contact }}
                            </p>

                        </td>


                        {{-- Quota --}}
                        <td class="px-6 py-4 text-center">

                            <span class="font-semibold text-slate-900">
                                {{ $company->available_quota }}
                            </span>

                        </td>


                        {{-- Status --}}
                        <td class="px-6 py-4 text-center">

                            @if ($company->partner_status === 'active')

                            <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                Aktif
                            </span>

                            @else

                            <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                Tidak Aktif
                            </span>

                            @endif

                        </td>


                        {{-- Actions --}}
                        <td class="px-6 py-4">

                            <div class="flex justify-end gap-2">

                                <a
                                    href="{{ route('hubin.companies.edit', $company) }}"
                                    class="rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50">

                                    Edit

                                </a>


                                <form
                                    action="{{ route('hubin.companies.destroy', $company) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus perusahaan ini?');">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-50">

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        @else

        <div class="px-6 py-12 text-center">

            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-slate-100">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="h-7 w-7 text-slate-400">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3.75 21h16.5M5.25 21V5.25A2.25 2.25 0 0 1 7.5 3h9a2.25 2.25 0 0 1 2.25 2.25V21M8.25 7.5h1.5m-1.5 3h1.5m4.5-3h1.5m-1.5 3h1.5" />

                </svg>

            </div>

            <h3 class="mt-4 text-sm font-semibold text-slate-900">
                Belum ada perusahaan
            </h3>

            <p class="mt-1 text-sm text-slate-500">
                Tambahkan perusahaan mitra PKL untuk mulai mengelola data.
            </p>

            <a
                href="{{ route('hubin.companies.create') }}"
                class="mt-5 inline-flex rounded-xl bg-amber-500 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-amber-600">

                Tambah Perusahaan

            </a>

        </div>

        @endif

    </div>

</div>

@endsection