@extends('layouts.app')

@section('title', 'Katalog Perusahaan')

@section('content')

<div>

    {{-- Page Header --}}
    <div class="mb-8">

        <p class="text-sm font-medium text-amber-600">
            Student
        </p>

        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
            Katalog Perusahaan
        </h1>

        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
            Lihat daftar perusahaan mitra yang tersedia
            untuk kegiatan Praktik Kerja Lapangan (PKL).
        </p>

    </div>


    {{-- Search --}}
    <div class="mb-6">

        <div class="relative max-w-xl">

            {{-- Search Icon --}}
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="h-5 w-5 text-slate-400">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" />

                </svg>

            </div>


            {{-- Search Input --}}
            <input
                type="search"
                id="company-search"
                placeholder="Cari nama perusahaan..."
                autocomplete="off"
                class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-11 text-sm text-slate-700 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-amber-400 focus:ring-2 focus:ring-amber-100">


            {{-- Clear Button --}}
            <button
                type="button"
                id="clear-search"
                class="absolute inset-y-0 right-0 hidden items-center pr-4 text-slate-400 transition hover:text-slate-600"
                aria-label="Hapus pencarian">

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
                        d="M6 18 18 6M6 6l12 12" />

                </svg>

            </button>

        </div>

    </div>


    {{-- Company List --}}
    @if ($companies->isNotEmpty())

    <div
        id="company-grid"
        class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">

        @foreach ($companies as $company)

        <div
            class="company-card rounded-2xl border p-6 shadow-sm transition
        {{ $company->partner_status === 'active'
            ? 'border-slate-200 bg-white'
            : 'border-slate-200 bg-slate-100 opacity-55 grayscale' }}"
            data-company-name="{{ $company->company_name }}"
            data-status="{{ $company->partner_status }}">

            {{-- Company Icon --}}
            <div class="flex items-center justify-between">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">

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

                </div>


                {{-- Partner Status --}}
                @if ($company->partner_status === 'active')

                <span class="rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700">
                    Aktif
                </span>

                @else

                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-500">
                    Tidak Aktif
                </span>

                @endif

            </div>


            {{-- Company Name --}}
            <h2 class="company-name mt-5 text-lg font-semibold text-slate-900">
                {{ $company->company_name }}
            </h2>


            {{-- Address --}}
            <p class="mt-2 text-sm leading-6 text-slate-500">
                {{ $company->full_address }}
            </p>


            {{-- HR Contact --}}
            <div class="mt-5 border-t border-slate-100 pt-4">

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Kontak HRD
                </p>

                <p class="mt-1 text-sm font-medium text-slate-700">
                    {{ $company->hr_contact }}
                </p>

            </div>


            {{-- Quota --}}
            <div class="mt-4 flex items-center justify-between">

                <span class="text-sm text-slate-500">
                    Kuota tersedia
                </span>

                @if ($company->partner_status === 'active')

                <span class="rounded-full bg-amber-50 px-3 py-1 text-sm font-semibold text-amber-700">
                    {{ $company->available_quota }} siswa
                </span>

                @else

                <span class="rounded-full bg-slate-100 px-3 py-1 text-sm font-semibold text-slate-400">
                    Tidak tersedia
                </span>

                @endif

            </div>


            {{-- Application Buttons --}}
            @if ($company->partner_status === 'active')

            @if ($company->available_quota > 0)

            <div class="mt-5 grid grid-cols-2 gap-3">

                {{-- Individual Application --}}
                <a
                    href="{{ route('student.applications.individual', ['company_id' => $company->id]) }}"
                    class="flex items-center justify-center rounded-xl bg-amber-500 px-4 py-2.5 text-center text-sm font-semibold text-white transition hover:bg-amber-600">

                    Individu

                </a>


                {{-- Group Application --}}
                <a
                    href="{{ route('student.applications.group', ['company_id' => $company->id]) }}"
                    class="flex items-center justify-center rounded-xl border border-amber-500 bg-white px-4 py-2.5 text-center text-sm font-semibold text-amber-600 transition hover:bg-amber-50">

                    Kelompok

                </a>

            </div>

            @else

            <button
                type="button"
                disabled
                class="mt-5 w-full cursor-not-allowed rounded-xl bg-slate-100 px-4 py-2.5 text-sm font-semibold text-slate-400">

                Kuota Penuh

            </button>

            @endif

            @else

            {{-- Inactive Company --}}
            <div class="mt-5">

                <button
                    type="button"
                    disabled
                    class="w-full cursor-not-allowed rounded-xl bg-slate-100 px-4 py-2.5 text-sm font-semibold text-slate-400">

                    Tidak Dapat Diajukan

                </button>

            </div>

            @endif

        </div>

        @endforeach

    </div>


    {{-- Search Empty State --}}
    <div
        id="search-empty"
        class="mt-6 hidden rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center">

        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.8"
                stroke="currentColor"
                class="h-6 w-6">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" />

            </svg>

        </div>


        <h2 class="mt-4 text-base font-semibold text-slate-800">
            Perusahaan tidak ditemukan
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Tidak ada perusahaan yang sesuai dengan kata pencarian Anda.
        </p>

    </div>

    @else

    {{-- Empty State --}}
    <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center">

        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-amber-50 text-amber-500">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.8"
                stroke="currentColor"
                class="h-6 w-6">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3.75 21h16.5M4.5 18.75h15M5.25 18.75V9.75L12 4.5l6.75 5.25v9" />

            </svg>

        </div>


        <h2 class="mt-4 text-base font-semibold text-slate-800">
            Belum ada perusahaan
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Data perusahaan mitra akan ditampilkan di sini.
        </p>

    </div>

    @endif

</div>


{{-- Search Script --}}
<script>
    const searchInput = document.getElementById('company-search');
    const clearButton = document.getElementById('clear-search');
    const companyCards = document.querySelectorAll('.company-card');
    const searchEmpty = document.getElementById('search-empty');

    function escapeHtml(value) {
        return value
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }


    function highlightKeyword(text, keyword) {

        if (!keyword) {
            return escapeHtml(text);
        }

        const escapedKeyword = keyword.replace(
            /[.*+?^${}()|[\]\\]/g,
            '\\$&'
        );

        const regex = new RegExp(
            `(${escapedKeyword})`,
            'gi'
        );

        return escapeHtml(text).replace(
            regex,
            '<mark class="rounded bg-amber-200 px-0.5 text-amber-900">$1</mark>'
        );
    }


    function performSearch() {

        const keyword = searchInput.value.trim();
        const normalizedKeyword = keyword.toLowerCase();

        let visibleCount = 0;


        companyCards.forEach(card => {

            const companyName =
                card.dataset.companyName;

            const normalizedName =
                companyName.toLowerCase();

            const nameElement =
                card.querySelector('.company-name');


            if (
                !normalizedKeyword ||
                normalizedName.includes(normalizedKeyword)
            ) {

                card.classList.remove('hidden');

                nameElement.innerHTML =
                    highlightKeyword(
                        companyName,
                        keyword
                    );

                visibleCount++;

            } else {

                card.classList.add('hidden');

            }

        });


        if (keyword) {

            clearButton.classList.remove('hidden');
            clearButton.classList.add('flex');

        } else {

            clearButton.classList.add('hidden');
            clearButton.classList.remove('flex');

        }


        if (visibleCount === 0 && keyword) {

            searchEmpty.classList.remove('hidden');

        } else {

            searchEmpty.classList.add('hidden');

        }

    }


    searchInput.addEventListener(
        'input',
        performSearch
    );


    clearButton.addEventListener(
        'click',
        function() {

            searchInput.value = '';

            performSearch();

            searchInput.focus();

        }
    );
</script>

@endsection