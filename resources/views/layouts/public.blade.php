<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'SIMPEL') - Sistem Manajemen PKL
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>


<body class="min-h-screen bg-slate-50 text-slate-900">

    {{-- ============================================================
        PUBLIC NAVBAR
    ============================================================= --}}

    <header
        class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/90 backdrop-blur">

        <div
            class="mx-auto flex h-16 max-w-7xl items-center justify-between px-8 sm:px-10 lg:px-14 xl:px-16">

            {{-- Logo --}}
            <a
                href="{{ route('home') }}"
                class="flex items-center gap-3 rounded-xl focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-500 focus-visible:ring-offset-2">

                <div
                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-500 text-white shadow-sm">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253" />

                    </svg>

                </div>

                <div>
                    <p class="text-lg font-bold tracking-tight">
                        SIMPEL
                    </p>

                    <p
                        class="hidden text-[10px] font-medium uppercase tracking-wider text-slate-400 sm:block">
                        Sistem Manajemen PKL
                    </p>
                </div>

            </a>


            {{-- Navigation --}}
            <nav class="flex items-center gap-3">

                <a
                    href="#tentang"
                    class="hidden rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-500 sm:inline-flex">

                    Tentang

                </a>


                @auth

                <a
                    href="{{ route('dashboard') }}"
                    class="inline-flex items-center gap-2 rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-slate-900 focus-visible:ring-offset-2">

                    Dashboard

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M13 7l5 5m0 0l-5 5m5-5H6" />

                    </svg>

                </a>

                @else

                <a
                    href="{{ route('login') }}"
                    class="inline-flex items-center gap-2 rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-slate-900 focus-visible:ring-offset-2">

                    Masuk

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M13 7l5 5m0 0l-5 5m5-5H6" />

                    </svg>

                </a>

                @endauth

            </nav>

        </div>

    </header>


    {{-- ============================================================
        MAIN CONTENT
    ============================================================= --}}

    <main class="min-h-[calc(100svh-4rem)]">

        @yield('content')

    </main>


    {{-- ============================================================
        FOOTER
    ============================================================= --}}

    <footer class="border-t border-slate-200 bg-white">

        <div
            class="mx-auto flex max-w-7xl flex-col gap-2 px-8 py-7 text-center text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between sm:px-10 sm:text-left lg:px-14 xl:px-16">

            <p>
                © {{ date('Y') }} SIMPEL · SMKS ICB Cinta Niaga
            </p>

            <p>
                Sistem Manajemen PKL
            </p>

        </div>

    </footer>

</body>

</html>