<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - SIMPEL</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-dvh overflow-hidden">

    <div class="grid h-dvh w-full md:grid-cols-2">

        {{-- Left Side --}}
        <div class="relative hidden overflow-hidden bg-amber-500 p-10 md:flex md:flex-col md:justify-between lg:p-16">

            {{-- Decorative circles --}}
            <div class="absolute -right-24 -top-24 h-80 w-80 rounded-full bg-amber-400 opacity-50"></div>

            <div class="absolute -bottom-28 -left-28 h-96 w-96 rounded-full bg-amber-600 opacity-40"></div>

            <div class="relative z-10">

                {{-- Logo --}}
                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white text-amber-600 shadow-sm">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="h-6 w-6">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.23-4.41 60.438 60.438 0 0 0-.491-6.347m-15.48 0a50.12 50.12 0 0 1 15.48 0m-15.48 0A50.119 50.119 0 0 1 12 5.25c3.327 0 6.47.647 9.23 1.81m-15.48 0A50.12 50.12 0 0 0 12 10.5c3.327 0 6.47-.647 9.23-1.81" />
                        </svg>

                    </div>

                    <span class="text-xl font-bold tracking-tight text-white">
                        SIMPEL
                    </span>

                </div>


                {{-- Hero Text --}}
                <div class="mt-24 max-w-lg">

                    <p class="mb-4 text-sm font-semibold uppercase tracking-[0.2em] text-amber-100">
                        Sistem Manajemen PKL
                    </p>

                    <h1 class="text-4xl font-bold leading-tight text-white lg:text-5xl">
                        Kelola perjalanan PKL dengan lebih sederhana.
                    </h1>

                    <p class="mt-6 max-w-md text-base leading-7 text-amber-50 lg:text-lg">
                        Satu portal untuk pengajuan, pencocokan perusahaan,
                        persetujuan, dan pemantauan kegiatan PKL.
                    </p>

                </div>

            </div>


            {{-- School Name --}}
            <div class="relative z-10">

                <div class="flex items-center gap-2 text-sm text-amber-50">

                    <span class="h-2 w-2 rounded-full bg-white"></span>

                    <span>
                        SMK ICB Cinta Niaga Bandung
                    </span>

                </div>

            </div>

        </div>


        {{-- Right Side --}}
        <div class="flex h-full min-h-0 flex-col justify-center overflow-hidden bg-white px-6 py-8 sm:px-10 md:px-12 lg:px-20 xl:px-28">

            <div class="mx-auto w-full max-w-md">

                {{-- Mobile Logo --}}
                <div class="mb-8 flex items-center gap-3 md:hidden">

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

                    <span class="text-xl font-bold text-slate-900">
                        SIMPEL
                    </span>

                </div>


                {{-- Login Content --}}
                <div>

                    <div class="mb-8">

                        <h2 class="text-3xl font-bold tracking-tight text-slate-900">
                            Selamat datang
                        </h2>

                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Masuk ke akun SIMPEL untuk melanjutkan.
                        </p>

                    </div>


                    {{-- Error Message --}}
                    @if ($errors->any())

                    <div class="mb-5 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="mt-0.5 h-5 w-5 shrink-0">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 9v3.75m0 3.75h.007v.008H12v-.008ZM10.343 3.94 2.69 17.25A1.875 1.875 0 0 0 4.314 20h15.372a1.875 1.875 0 0 0 1.624-2.75L13.657 3.94a1.875 1.875 0 0 0-3.314 0Z" />
                        </svg>

                        <span>
                            {{ $errors->first() }}
                        </span>

                    </div>

                    @endif


                    <form
                        action="{{ route('login.process') }}"
                        method="POST">

                        @csrf


                        {{-- Login Method --}}
                        <div class="mb-5">

                            <label class="mb-3 block text-sm font-semibold text-slate-700">
                                Login menggunakan
                            </label>


                            <div class="grid grid-cols-3 gap-2 rounded-2xl bg-slate-100 p-1.5">

                                <button
                                    type="button"
                                    data-login-type="login_id"
                                    class="login-method rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-300">
                                    Login ID
                                </button>

                                <button
                                    type="button"
                                    data-login-type="nis_nip"
                                    class="login-method rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-300">
                                    NIS / NIP
                                </button>

                                <button
                                    type="button"
                                    data-login-type="email"
                                    class="login-method rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-300">
                                    Email
                                </button>

                            </div>


                            <input
                                type="hidden"
                                name="login_type"
                                id="login_type"
                                value="{{ old('login_type', 'login_id') }}">

                        </div>


                        {{-- Identifier --}}
                        <div
                            id="identifier-wrapper"
                            class="mb-5 transition-all duration-300">

                            <label
                                for="identifier"
                                id="identifier-label"
                                class="mb-2 block text-sm font-semibold text-slate-700">
                                Login ID
                            </label>


                            <div class="relative">

                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">

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

                                </div>


                                <input
                                    type="text"
                                    id="identifier"
                                    name="identifier"
                                    value="{{ old('identifier') }}"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    placeholder="Masukkan Login ID"
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm text-slate-900 outline-none transition-all duration-300 placeholder:text-slate-400 focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-500/10">

                            </div>


                            <p
                                id="identifier-help"
                                class="mt-2 text-xs text-slate-400">
                                Gunakan Login ID yang diberikan oleh sekolah.
                            </p>

                        </div>


                        {{-- Password --}}
                        <div class="mb-6">

                            <label
                                for="password"
                                class="mb-2 block text-sm font-semibold text-slate-700">
                                Password
                            </label>


                            <div class="relative">

                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">

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
                                            d="M16.5 10.5V6.75a4.5 4.5 0 0 0-9 0v3.75m-.75 0h10.5A2.25 2.25 0 0 1 19.5 12.75v5.25A2.25 2.25 0 0 1 17.25 20.25H6.75A2.25 2.25 0 0 1 4.5 18v-5.25a2.25 2.25 0 0 1 2.25-2.25Z" />
                                    </svg>

                                </div>


                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Masukkan password"
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm text-slate-900 outline-none transition-all duration-300 placeholder:text-slate-400 focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-500/10">

                            </div>

                        </div>


                        {{-- Submit --}}
                        <button
                            type="submit"
                            class="group flex w-full items-center justify-center gap-2 rounded-xl bg-amber-500 px-4 py-3.5 text-sm font-semibold text-white shadow-lg shadow-amber-500/20 transition-all duration-300 hover:-translate-y-0.5 hover:bg-amber-600 hover:shadow-xl hover:shadow-amber-500/25 active:translate-y-0">

                            <span>
                                Login
                            </span>

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>

                        </button>

                    </form>


                    {{-- Footer --}}
                    <div class="mt-6 border-t border-slate-100 pt-5 text-center">

                        <p class="text-xs leading-5 text-slate-400">
                            Akun dikelola oleh pihak sekolah atau Hubin.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <script>
        const loginMethods = document.querySelectorAll('.login-method');

        const loginTypeInput = document.getElementById('login_type');

        const identifierInput = document.getElementById('identifier');
        const identifierLabel = document.getElementById('identifier-label');
        const identifierHelp = document.getElementById('identifier-help');
        const identifierWrapper = document.getElementById('identifier-wrapper');

        const initialLoginType = loginTypeInput.value || 'login_id';


        const loginOptions = {

            login_id: {
                label: 'Login ID',
                placeholder: 'Masukkan Login ID',
                help: 'Gunakan Login ID yang diberikan oleh sekolah.',
                type: 'text',
                autocomplete: 'username',
            },

            nis_nip: {
                label: 'NIS / NIP',
                placeholder: 'Masukkan NIS atau NIP',
                help: 'Gunakan NIS sebagai siswa atau NIP sebagai petugas Hubin.',
                type: 'text',
                autocomplete: 'username',
            },

            email: {
                label: 'Email',
                placeholder: 'Masukkan alamat email',
                help: 'Gunakan alamat email yang terdaftar pada akun.',
                type: 'email',
                autocomplete: 'email',
            }

        };


        function setLoginMethod(type, animate = true) {

            const option = loginOptions[type];

            if (!option) {
                return;
            }


            loginTypeInput.value = type;


            loginMethods.forEach(button => {

                const isActive = button.dataset.loginType === type;


                if (isActive) {

                    button.classList.remove(
                        'text-slate-500',
                        'hover:text-slate-700'
                    );

                    button.classList.add(
                        'bg-white',
                        'text-amber-600',
                        'shadow-sm'
                    );

                } else {

                    button.classList.remove(
                        'bg-white',
                        'text-amber-600',
                        'shadow-sm'
                    );

                    button.classList.add(
                        'text-slate-500',
                        'hover:text-slate-700'
                    );

                }

            });


            if (animate) {

                identifierWrapper.classList.add(
                    'opacity-0',
                    'translate-y-2'
                );


                setTimeout(() => {

                    identifierLabel.textContent = option.label;

                    identifierInput.type = option.type;
                    identifierInput.placeholder = option.placeholder;
                    identifierInput.autocomplete = option.autocomplete;

                    identifierHelp.textContent = option.help;


                    identifierWrapper.classList.remove(
                        'opacity-0',
                        'translate-y-2'
                    );

                }, 150);

            } else {

                identifierLabel.textContent = option.label;

                identifierInput.type = option.type;
                identifierInput.placeholder = option.placeholder;
                identifierInput.autocomplete = option.autocomplete;

                identifierHelp.textContent = option.help;

            }

        }


        loginMethods.forEach(button => {

            button.addEventListener('click', () => {

                setLoginMethod(
                    button.dataset.loginType
                );

            });

        });


        setLoginMethod(initialLoginType, false);
    </script>

</body>

</html>