@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')

<div>

    {{-- Header --}}
    <div class="mb-8">

        <p class="text-sm font-medium text-amber-600">
            Profile
        </p>

        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
            Edit Profile
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Perbarui informasi akun Anda.
        </p>

    </div>


    {{-- Notification --}}
    <div class="mb-6 rounded-2xl border border-amber-200 bg-amber-50 p-4">

        <div class="flex gap-3">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.8"
                stroke="currentColor"
                class="mt-0.5 h-5 w-5 shrink-0 text-amber-600">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 9v3.75m9-3.75a9 9 0 1 1-18 0Zm-9 6h.008V15Z" />

            </svg>

            <div>

                <p class="text-sm font-semibold text-amber-800">
                    Perhatian
                </p>

                <p class="mt-1 text-sm leading-6 text-amber-700">
                    Pastikan data yang Anda masukkan sudah sesuai.
                    Jika Anda lupa password atau menemukan data yang tidak sesuai,
                    hubungi Hubin atau pihak teknis sekolah.
                </p>

            </div>

        </div>

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

                <p class="mt-1 text-sm leading-6 text-red-700">
                    Periksa kembali data yang Anda masukkan.
                    Jika masalah berkaitan dengan password atau data akun,
                    hubungi Hubin atau pihak teknis sekolah.
                </p>

            </div>

        </div>

    </div>

    @endif


    <div class="max-w-3xl space-y-6">


        {{-- ============================================================ --}}
        {{-- INFORMASI PROFIL --}}
        {{-- ============================================================ --}}

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

            <div class="mb-6">

                <h2 class="text-lg font-semibold text-slate-900">
                    Informasi Profil
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Ubah informasi pribadi yang digunakan pada akun Anda.
                </p>

            </div>


            <form
                action="{{ route('profile.update') }}"
                method="POST"
                class="space-y-6">

                @csrf
                @method('PUT')


                {{-- NIS / NIP --}}
                <div>

                    <label
                        for="nis_nip"
                        class="block text-sm font-medium text-slate-700">

                        NIS / NIP

                    </label>

                    <input
                        type="text"
                        id="nis_nip"
                        value="{{ $user->nis_nip ?? '-' }}"
                        disabled
                        class="mt-2 block w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-500 shadow-sm">

                    <p class="mt-2 text-xs text-slate-400">
                        Data identitas sekolah tidak dapat diubah melalui halaman ini.
                    </p>

                </div>


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
                        name="full_name"
                        value="{{ old('full_name', $user->full_name) }}"
                        class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500">

                    @error('full_name')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                {{-- Class - Student Only --}}
                @if ($user->role === 'student')

                <div>

                    <label
                        for="class"
                        class="block text-sm font-medium text-slate-700">

                        Kelas

                    </label>

                    <input
                        type="text"
                        id="class"
                        name="class"
                        value="{{ old('class', $user->class) }}"
                        class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500">

                    @error('class')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                @endif


                {{-- Email --}}
                <div>

                    <label
                        for="email"
                        class="block text-sm font-medium text-slate-700">

                        Email

                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500">

                    @error('email')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                {{-- Phone Number --}}
                <div>

                    <label
                        for="phone_number"
                        class="block text-sm font-medium text-slate-700">

                        Nomor Telepon

                    </label>

                    <input
                        type="text"
                        id="phone_number"
                        name="phone_number"
                        value="{{ old('phone_number', $user->phone_number) }}"
                        class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500">

                    @error('phone_number')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                {{-- Login ID --}}
                <div>

                    <label
                        for="login_id"
                        class="block text-sm font-medium text-slate-700">

                        Login ID

                    </label>

                    <input
                        type="text"
                        id="login_id"
                        value="{{ $user->login_id }}"
                        disabled
                        class="mt-2 block w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-500 shadow-sm">

                    <p class="mt-2 text-xs text-slate-400">
                        Login ID ditetapkan oleh sekolah dan tidak dapat diubah.
                    </p>

                </div>


                {{-- Role --}}
                <div>

                    <label
                        for="role"
                        class="block text-sm font-medium text-slate-700">

                        Role

                    </label>

                    <input
                        type="text"
                        id="role"
                        value="{{ ucfirst($user->role) }}"
                        disabled
                        class="mt-2 block w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-500 shadow-sm">

                    <p class="mt-2 text-xs text-slate-400">
                        Role akun ditentukan oleh sistem sekolah dan tidak dapat diubah.
                    </p>

                </div>


                {{-- Profile Actions --}}
                <div class="flex items-center gap-3 border-t border-slate-100 pt-6">

                    <button
                        type="submit"
                        class="rounded-xl bg-amber-500 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-amber-600">

                        Simpan Informasi

                    </button>

                    <a
                        href="{{ route('profile.show') }}"
                        class="rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">

                        Batal

                    </a>

                </div>

            </form>

        </div>



        {{-- ============================================================ --}}
        {{-- PASSWORD --}}
        {{-- ============================================================ --}}

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

            <div class="mb-6">

                <h2 class="text-lg font-semibold text-slate-900">
                    Ubah Password
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Gunakan bagian ini hanya jika Anda ingin mengganti password akun.
                </p>

            </div>


            <form
                action="{{ route('profile.password.update') }}"
                method="POST"
                class="space-y-6">

                @csrf
                @method('PUT')


                {{-- Current Password --}}
                <div>

                    <label
                        for="current_password"
                        class="block text-sm font-medium text-slate-700">

                        Password Lama

                    </label>

                    <input
                        type="password"
                        id="current_password"
                        name="current_password"
                        required
                        autocomplete="current-password"
                        class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500">

                    @error('current_password')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                {{-- New Password --}}
                <div>

                    <label
                        for="new_password"
                        class="block text-sm font-medium text-slate-700">

                        Password Baru

                    </label>

                    <input
                        type="password"
                        id="new_password"
                        name="new_password"
                        required
                        minlength="8"
                        autocomplete="new-password"
                        class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500">

                    <p class="mt-2 text-xs text-slate-400">
                        Password baru minimal 8 karakter.
                    </p>

                    @error('new_password')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                {{-- Confirm New Password --}}
                <div>

                    <label
                        for="new_password_confirmation"
                        class="block text-sm font-medium text-slate-700">

                        Konfirmasi Password Baru

                    </label>

                    <input
                        type="password"
                        id="new_password_confirmation"
                        name="new_password_confirmation"
                        required
                        minlength="8"
                        autocomplete="new-password"
                        class="mt-2 block w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-amber-500 focus:ring-amber-500">

                    @error('new_password_confirmation')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                {{-- Password Actions --}}
                <div class="flex items-center gap-3 border-t border-slate-100 pt-6">

                    <button
                        type="submit"
                        class="rounded-xl bg-amber-500 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-amber-600">

                        Ubah Password

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