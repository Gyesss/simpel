<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Company Dashboard - SIMPEL</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

    <div class="mx-auto max-w-7xl p-8">

        <h1 class="text-3xl font-bold text-slate-900">
            Company Dashboard
        </h1>

        <p class="mt-2 text-slate-500">
            Welcome, {{ auth()->user()->full_name }}.
        </p>

        <p class="mt-1 text-sm text-slate-400">
            Role: {{ auth()->user()->role }}
        </p>


        <form
            action="{{ route('logout') }}"
            method="POST"
            class="mt-8">

            @csrf

            <button
                type="submit"
                class="rounded-xl bg-red-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-red-600">
                Logout
            </button>

        </form>

    </div>

</body>

</html>