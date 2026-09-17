<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - SIMPEL</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100">

    <div class="max-w-4xl mx-auto p-8">

        <h1 class="text-2xl font-bold text-gray-800">
            Dashboard
        </h1>

        <p class="mt-2 text-gray-600">
            Welcome, {{ auth()->user()->full_name }}.
        </p>

        <p class="mt-1 text-gray-600">
            Role: {{ auth()->user()->role }}
        </p>

        <form
            action="{{ route('logout') }}"
            method="POST"
            class="mt-6">
            @csrf

            <button
                type="submit"
                class="rounded-md bg-red-600 px-4 py-2 text-white hover:bg-red-700">
                Logout
            </button>
        </form>

    </div>

</body>

</html>