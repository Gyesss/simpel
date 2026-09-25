<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Dashboard') - SIMPEL
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside class="hidden w-64 shrink-0 border-r border-slate-200 bg-white lg:flex lg:flex-col">

            {{-- Logo --}}
            <div class="flex h-20 items-center border-b border-slate-100 px-6">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-500 text-white shadow-sm">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="h-5 w-5">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.23-4.41 60.438 60.438 0 0 0-.491-6.347m-15.48 0a50.12 50.12 0 0 1 15.48 0m-15.48 0A50.119 50.119 0 0 1 12 5.25c3.327 0 6.47.647 9.23 1.81m-15.48 0A50.12 50.12 0 0 0 12 10.5c3.327 0 6.47-.647 9.23-1.81" />

                        </svg>

                    </div>

                    <div>

                        <p class="text-lg font-bold tracking-tight">
                            SIMPEL
                        </p>

                        <p class="text-[10px] font-medium uppercase tracking-wider text-slate-400">
                            Sistem Manajemen PKL
                        </p>

                    </div>

                </div>

            </div>


            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto px-4 py-6">

                <p class="mb-3 px-3 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
                    Menu
                </p>


                {{-- ========================= --}}
                {{-- STUDENT NAVIGATION --}}
                {{-- ========================= --}}

                @if (auth()->user()->role === 'student')

                {{-- Dashboard --}}
                <a
                    href="{{ route('student.dashboard') }}"
                    class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition
                        {{ request()->routeIs('student.dashboard')
                            ? 'bg-amber-50 font-semibold text-amber-600'
                            : 'font-medium text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">

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
                            d="M3 13.125 12 4l9 9.125M5.25 11.25V20h5.25v-5.25h3V20h5.25v-8.75" />

                    </svg>

                    <span>
                        Dashboard
                    </span>

                </a>


                {{-- Company Catalog --}}
                <a
                    href="{{ route('student.companies.index') }}"
                    class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition
                        {{ request()->routeIs('student.companies.*')
                            ? 'bg-amber-50 font-semibold text-amber-600'
                            : 'font-medium text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">

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
                            d="M3.75 21h16.5M4.5 18.75h15M5.25 18.75V9.75L12 4.5l6.75 5.25v9" />

                    </svg>

                    <span>
                        Katalog Perusahaan
                    </span>

                </a>


                {{-- Application --}}
                <a
                    href="{{ route('student.applications.index') }}"
                    class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition
                        {{ request()->routeIs('student.applications.*')
                            ? 'bg-amber-50 font-semibold text-amber-600'
                            : 'font-medium text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">

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
                            d="M9 12h6m-6 4h6m2.25-13.5h-10.5A2.25 2.25 0 0 0 4.5 4.75v14.5a2.25 2.25 0 0 0 2.25 2.25h10.5A2.25 2.25 0 0 0 19.5 19.25V4.75a2.25 2.25 0 0 0-2.25-2.25Z" />

                    </svg>

                    <span>
                        Pengajuan PKL
                    </span>

                </a>


                {{-- Application Status --}}
                <a
                    href="{{ route('student.application-status') }}"
                    class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition
                        {{ request()->routeIs('student.application-status')
                            ? 'bg-amber-50 font-semibold text-amber-600'
                            : 'font-medium text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">

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
                            d="M12 6v6l4 2m5-2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />

                    </svg>

                    <span>
                        Status Pengajuan
                    </span>

                </a>


                {{-- Response Letter --}}
                <a
                    href="{{ route('student.response-letter') }}"
                    class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition
                        {{ request()->routeIs('student.response-letter')
                            ? 'bg-amber-50 font-semibold text-amber-600'
                            : 'font-medium text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">

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
                            d="M19.5 14.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-10.5A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25h7.5m2.25-5.25 2.25 2.25m0 0 3.75-3.75m-3.75 3.75V12" />

                    </svg>

                    <span>
                        Surat Balasan
                    </span>

                </a>

                @endif


                {{-- ========================= --}}
                {{-- HUBIN NAVIGATION --}}
                {{-- ========================= --}}

                @if (auth()->user()->role === 'hubin')

                {{-- Dashboard --}}
                <a
                    href="{{ route('hubin.dashboard') }}"
                    class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition
                        {{ request()->routeIs('hubin.dashboard')
                            ? 'bg-amber-50 font-semibold text-amber-600'
                            : 'font-medium text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">

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
                            d="M3 13.125 12 4l9 9.125M5.25 11.25V20h5.25v-5.25h3V20h5.25v-8.75" />

                    </svg>

                    <span>
                        Dashboard
                    </span>

                </a>


                {{-- Companies --}}
                <a
                    href="{{ route('hubin.companies.index') }}"
                    class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition
                        {{ request()->routeIs('hubin.companies.*')
                            ? 'bg-amber-50 font-semibold text-amber-600'
                            : 'font-medium text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">

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
                            d="M3.75 21h16.5M4.5 18.75h15M5.25 18.75V9.75L12 4.5l6.75 5.25v9" />

                    </svg>

                    <span>
                        Data Perusahaan
                    </span>

                </a>


                {{-- Applications --}}
                <a
                    href="{{ route('hubin.applications.index') }}"
                    class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition
                        {{ request()->routeIs('hubin.applications.*')
                            ? 'bg-amber-50 font-semibold text-amber-600'
                            : 'font-medium text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">

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
                            d="M9 12h6m-6 4h6m2.25-13.5h-10.5A2.25 2.25 0 0 0 19.5 4.75v14.5a2.25 2.25 0 0 0-2.25-2.25Z" />

                    </svg>

                    <span>
                        Pengajuan PKL
                    </span>

                </a>


                {{-- Introduction Letters --}}
                <a
                    href="{{ route('hubin.introduction-letters.index') }}"
                    class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition
                        {{ request()->routeIs('hubin.introduction-letters.*')
                            ? 'bg-amber-50 font-semibold text-amber-600'
                            : 'font-medium text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">

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
                            d="M9 12h6m-6 4h4m-7.25 4.25h10.5A2.25 2.25 0 0 0 14.5 18V6.75A2.25 2.25 0 0 0 12.25 4.5h-6A2.25 2.25 0 0 0 4 6.75v11.5a2.25 2.25 0 0 0 2.25 2.25Z" />

                    </svg>

                    <span>
                        Surat Pengantar
                    </span>

                </a>


                {{-- Supervisors --}}
                <a
                    href="{{ route('hubin.supervisors.index') }}"
                    class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition
                        {{ request()->routeIs('hubin.supervisors.*')
                            ? 'bg-amber-50 font-semibold text-amber-600'
                            : 'font-medium text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">

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
                            d="M15.75 5.25a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75a17.933 17.933 0 0 1-7.499-1.632Z" />

                    </svg>

                    <span>
                        Pembimbing
                    </span>

                </a>

                @endif


                {{-- ========================= --}}
                {{-- COMPANY NAVIGATION --}}
                {{-- ========================= --}}

                @if (auth()->user()->role === 'company')

                {{-- Dashboard --}}
                <a
                    href="{{ route('company.dashboard') }}"
                    class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition
                        {{ request()->routeIs('company.dashboard')
                            ? 'bg-amber-50 font-semibold text-amber-600'
                            : 'font-medium text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">

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
                            d="M3 13.125 12 4l9 9.125M5.25 11.25V20h5.25v-5.25h3V20h5.25v-8.75" />

                    </svg>

                    <span>
                        Dashboard
                    </span>

                </a>


                {{-- Applications --}}
                <a
                    href="{{ route('company.applications.index') }}"
                    class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition
                        {{ request()->routeIs('company.applications.*')
                            ? 'bg-amber-50 font-semibold text-amber-600'
                            : 'font-medium text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">

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
                            d="M9 12h6m-6 4h6m2.25-13.5h-10.5A2.25 2.25 0 0 0 19.5 4.75v14.5a2.25 2.25 0 0 0-2.25-2.25Z" />

                    </svg>

                    <span>
                        Lamaran Siswa
                    </span>

                </a>


                {{-- Accepted Students --}}
                <a
                    href="{{ route('company.accepted-students.index') }}"
                    class="mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm transition
                        {{ request()->routeIs('company.accepted-students.*')
                            ? 'bg-amber-50 font-semibold text-amber-600'
                            : 'font-medium text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">

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
                            d="m9 12 2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />

                    </svg>

                    <span>
                        Siswa Diterima
                    </span>

                </a>

                @endif

            </nav>


            {{-- User --}}
            <div class="border-t border-slate-100 p-4">

                <div class="flex items-center gap-3 rounded-xl bg-slate-50 p-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-amber-100 text-sm font-bold text-amber-700">

                        {{ strtoupper(substr(auth()->user()->full_name, 0, 1)) }}

                    </div>


                    <div class="min-w-0 flex-1">

                        <p class="truncate text-sm font-semibold text-slate-800">
                            {{ auth()->user()->full_name }}
                        </p>

                        <p class="text-xs capitalize text-slate-400">
                            {{ auth()->user()->role }}
                        </p>

                    </div>

                </div>

                <a
                    href="{{ route('profile.show') }}"
                    class="mt-2 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition
        {{ request()->routeIs('profile.*')
            ? 'bg-amber-50 font-semibold text-amber-600'
            : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">

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
                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />

                    </svg>

                    <span>
                        Profile
                    </span>

                </a>

                <form
                    action="{{ route('logout') }}"
                    method="POST"
                    class="mt-2">

                    @csrf

                    <button
                        type="submit"
                        class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-500 transition hover:bg-red-50 hover:text-red-600">

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
                                d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3-3H9.75m7.5 0-3-3m3 3-3 3" />

                        </svg>

                        <span>
                            Logout
                        </span>

                    </button>

                </form>

            </div>

        </aside>


        {{-- Main Area --}}
        <div class="flex min-w-0 flex-1 flex-col">

            {{-- Mobile Header --}}
            <header class="flex h-16 shrink-0 items-center justify-between border-b border-slate-200 bg-white px-5 lg:hidden">

                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-amber-500 text-white">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="h-5 w-5">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.23-4.41 60.438 60.438 0 0 0-.491-6.347m-15.48 0a50.12 50.12 0 0 1 15.48 0m-15.48 0A50.119 50.119 0 0 1 12 5.25c3.327 0 6.47-.647 9.23-1.81m-15.48 0A50.12 50.12 0 0 0 12 10.5c3.327 0 6.47-.647 9.23-1.81" />

                        </svg>

                    </div>

                    <span class="font-bold tracking-tight">
                        SIMPEL
                    </span>

                </div>


                <form
                    action="{{ route('logout') }}"
                    method="POST">

                    @csrf

                    <button
                        type="submit"
                        class="rounded-lg p-2 text-slate-400 transition hover:bg-red-50 hover:text-red-600">

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
                                d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3-3H9.75m7.5 0-3-3m3 3-3 3" />

                        </svg>

                    </button>

                </form>

            </header>


            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto">

                <div class="mx-auto w-full max-w-7xl p-5 sm:p-6 lg:p-8">

                    @yield('content')

                </div>

            </main>

        </div>

    </div>

</body>

</html>