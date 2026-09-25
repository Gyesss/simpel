@extends('layouts.app')

@section('title', 'Profile')

@section('content')

<div>

    {{-- Header --}}
    <div class="mb-8">

        <p class="text-sm font-medium text-amber-600">
            Profile
        </p>

        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
            Informasi Pengguna
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Kelola informasi akun Anda.
        </p>

    </div>


    <div class="grid gap-6 lg:grid-cols-3">

        {{-- Account Card --}}
        <div class="lg:col-span-1">

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="flex flex-col items-center">

                    <div class="flex h-20 w-20 items-center justify-center rounded-full bg-amber-100 text-3xl font-bold text-amber-700">
                        {{ strtoupper(substr($user->full_name, 0, 1)) }}
                    </div>

                    <h2 class="mt-4 text-xl font-bold text-slate-900">
                        {{ $user->full_name }}
                    </h2>

                    <p class="capitalize text-slate-500">
                        {{ $user->role }}
                    </p>

                </div>


                {{-- Edit Profile --}}
                <a
                    href="{{ route('profile.edit') }}"
                    class="mt-6 flex w-full items-center justify-center gap-2 rounded-xl bg-amber-500 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-amber-600">

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
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z" />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19.5 7.125 16.875 4.5" />

                    </svg>

                    Edit Profile

                </a>


                {{-- Edit Company --}}
                @if ($user->role === 'company' && $user->company)

                <a
                    href="{{ route('company.profile.edit') }}"
                    class="mt-3 flex w-full items-center justify-center gap-2 rounded-xl border border-amber-200 bg-amber-50 px-4 py-2.5 text-sm font-semibold text-amber-700 transition hover:bg-amber-100">

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
                            d="M3.75 21h16.5M5.25 21V5.25A2.25 2.25 0 0 1 7.5 3h9a2.25 2.25 0 0 1 2.25 2.25V21M8.25 7.5h1.5m-1.5 3h1.5m4.5-3h1.5m-1.5 3h1.5M8.25 21v-3.75A2.25 2.25 0 0 1 10.5 15h3a2.25 2.25 0 0 1 2.25 2.25V21" />

                    </svg>

                    Edit Perusahaan

                </a>

                @endif

            </div>

        </div>


        {{-- Detail --}}
        <div class="lg:col-span-2">

            {{-- Account Information --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <h2 class="mb-6 text-lg font-semibold text-slate-900">
                    Data Akun
                </h2>

                <div class="grid gap-4 md:grid-cols-2">

                    {{-- NIS / NIP --}}
                    <div>
                        <p class="text-sm text-slate-500">
                            NIS / NIP
                        </p>

                        <p class="font-medium text-slate-900">
                            {{ $user->nis_nip ?? '-' }}
                        </p>
                    </div>


                    {{-- Full Name --}}
                    <div>
                        <p class="text-sm text-slate-500">
                            Nama Lengkap
                        </p>

                        <p class="font-medium text-slate-900">
                            {{ $user->full_name }}
                        </p>
                    </div>


                    {{-- Class --}}
                    @if ($user->role === 'student')

                    <div>
                        <p class="text-sm text-slate-500">
                            Kelas
                        </p>

                        <p class="font-medium text-slate-900">
                            {{ $user->class ?? '-' }}
                        </p>
                    </div>

                    @endif


                    {{-- Email --}}
                    <div>
                        <p class="text-sm text-slate-500">
                            Email
                        </p>

                        <p class="font-medium text-slate-900">
                            {{ $user->email ?? '-' }}
                        </p>
                    </div>


                    {{-- Phone Number --}}
                    <div>
                        <p class="text-sm text-slate-500">
                            Nomor Telepon
                        </p>

                        <p class="font-medium text-slate-900">
                            {{ $user->phone_number ?? '-' }}
                        </p>
                    </div>


                    {{-- Login ID --}}
                    <div>
                        <p class="text-sm text-slate-500">
                            Login ID
                        </p>

                        <p class="font-medium text-slate-900">
                            {{ $user->login_id }}
                        </p>
                    </div>


                    {{-- Role --}}
                    <div>
                        <p class="text-sm text-slate-500">
                            Role
                        </p>

                        <p class="font-medium capitalize text-slate-900">
                            {{ $user->role }}
                        </p>
                    </div>

                </div>

            </div>


            {{-- Company Information --}}
            @if ($user->role === 'company')

            <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <h2 class="mb-6 text-lg font-semibold text-slate-900">
                    Informasi Perusahaan
                </h2>

                @if ($user->company)

                <div class="grid gap-4 md:grid-cols-2">

                    {{-- Company Name --}}
                    <div>
                        <p class="text-sm text-slate-500">
                            Nama Perusahaan
                        </p>

                        <p class="font-medium text-slate-900">
                            {{ $user->company->company_name }}
                        </p>
                    </div>


                    {{-- Available Quota --}}
                    <div>
                        <p class="text-sm text-slate-500">
                            Kuota
                        </p>

                        <p class="font-medium text-slate-900">
                            {{ $user->company->available_quota }}
                        </p>
                    </div>


                    {{-- Full Address --}}
                    <div class="md:col-span-2">
                        <p class="text-sm text-slate-500">
                            Alamat
                        </p>

                        <p class="font-medium text-slate-900">
                            {{ $user->company->full_address }}
                        </p>
                    </div>


                    {{-- HR Contact --}}
                    <div>
                        <p class="text-sm text-slate-500">
                            Kontak HR
                        </p>

                        <p class="font-medium text-slate-900">
                            {{ $user->company->hr_contact }}
                        </p>
                    </div>


                    {{-- Partner Status --}}
                    <div>
                        <p class="text-sm text-slate-500">
                            Status Mitra
                        </p>

                        <p class="font-medium capitalize text-slate-900">
                            {{ $user->company->partner_status }}
                        </p>
                    </div>

                </div>

                @else

                <p class="text-sm text-slate-500">
                    Akun perusahaan ini belum terhubung dengan data perusahaan.
                </p>

                @endif

            </div>

            @endif

        </div>

    </div>

</div>

@endsection