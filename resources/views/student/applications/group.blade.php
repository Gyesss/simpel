@extends('layouts.app')

@section('title', 'Pengajuan PKL Kelompok')

@section('content')

<div>

    {{-- Page Header --}}
    <div class="mb-8">

        <a
            href="{{ route('student.applications.index') }}"
            class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-amber-600">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.8"
                stroke="currentColor"
                class="h-4 w-4">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15.75 19.5 8.25 12l7.5-7.5" />

            </svg>

            Kembali ke Pengajuan

        </a>


        <p class="mt-6 text-sm font-medium text-amber-600">
            Student
        </p>

        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
            Pengajuan PKL Kelompok
        </h1>

        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
            Ajukan Praktik Kerja Lapangan bersama anggota kelompok.
        </p>

    </div>


    {{-- Application Form --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

        <form method="POST">

            @csrf


            {{-- Leader Information --}}
            <div>

                <h2 class="text-base font-semibold text-slate-900">
                    Ketua Kelompok
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Anda akan menjadi ketua dari pengajuan kelompok ini.
                </p>


                <div class="mt-5 grid gap-5 md:grid-cols-2">

                    <div>
                        <label
                            for="leader_full_name"
                            class="block text-sm font-medium text-slate-700">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            id="leader_full_name"
                            value="{{ auth()->user()->full_name }}"
                            readonly
                            class="mt-2 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600 outline-none">
                    </div>


                    <div>
                        <label
                            for="leader_nis_nip"
                            class="block text-sm font-medium text-slate-700">
                            NIS/NIP
                        </label>

                        <input
                            type="text"
                            id="leader_nis_nip"
                            value="{{ auth()->user()->nis_nip }}"
                            readonly
                            class="mt-2 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600 outline-none">
                    </div>


                    <div>
                        <label
                            for="leader_class"
                            class="block text-sm font-medium text-slate-700">
                            Kelas
                        </label>

                        <input
                            type="text"
                            id="leader_class"
                            value="{{ auth()->user()->class }}"
                            readonly
                            class="mt-2 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600 outline-none">
                    </div>


                    <div>
                        <label
                            for="leader_phone_number"
                            class="block text-sm font-medium text-slate-700">
                            Nomor HP
                        </label>

                        <input
                            type="text"
                            id="leader_phone_number"
                            value="{{ auth()->user()->phone_number }}"
                            readonly
                            class="mt-2 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600 outline-none">
                    </div>

                </div>

            </div>


            <div class="my-8 border-t border-slate-100"></div>


            {{-- Group Members --}}
            <div>

                <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">

                    <div>

                        <h2 class="text-base font-semibold text-slate-900">
                            Anggota Kelompok
                        </h2>

                        <p class="mt-1 text-sm leading-6 text-slate-500">
                            Masukkan NIS/NIP siswa untuk menambahkan anggota kelompok.
                        </p>

                    </div>


                    <button
                        type="button"
                        id="add-member-button"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-amber-500 bg-white px-4 py-2.5 text-sm font-semibold text-amber-600 transition hover:bg-amber-50">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="h-4 w-4">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 5.25v13.5M5.25 12h13.5" />

                        </svg>

                        Tambah Anggota

                    </button>

                </div>


                <div
                    id="members-container"
                    class="mt-5 space-y-4">

                    {{-- Member rows will be inserted here by JavaScript --}}

                </div>


                <div
                    id="empty-members"
                    class="mt-5 rounded-xl border border-dashed border-slate-300 bg-slate-50 p-6 text-center">

                    <p class="text-sm font-medium text-slate-600">
                        Belum ada anggota
                    </p>

                    <p class="mt-1 text-sm text-slate-500">
                        Klik "Tambah Anggota" untuk menambahkan siswa.
                    </p>

                </div>

            </div>


            <div class="my-8 border-t border-slate-100"></div>


            {{-- Internship Information --}}
            <div>

                <h2 class="text-base font-semibold text-slate-900">
                    Data Pengajuan PKL
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Tentukan perusahaan dan periode pelaksanaan PKL.
                </p>


                <div class="mt-5 grid gap-5 md:grid-cols-2">

                    <div class="md:col-span-2">

                        <label
                            for="company_id"
                            class="block text-sm font-medium text-slate-700">
                            Perusahaan Mitra
                        </label>

                        <select
                            id="company_id"
                            name="company_id"
                            class="mt-2 block w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-amber-500 focus:ring-2 focus:ring-amber-100">

                            <option value="">
                                Pilih perusahaan
                            </option>

                            @foreach ($companies as $company)

                            <option value="{{ $company->id }}">
                                {{ $company->company_name }}
                                — {{ $company->available_quota }} kuota tersedia
                            </option>

                            @endforeach

                        </select>

                    </div>


                    <div>

                        <label
                            for="internship_start_date"
                            class="block text-sm font-medium text-slate-700">
                            Tanggal Mulai PKL
                        </label>

                        <input
                            type="date"
                            id="internship_start_date"
                            name="internship_start_date"
                            class="mt-2 block w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-amber-500 focus:ring-2 focus:ring-amber-100">

                    </div>


                    <div>

                        <label
                            for="internship_end_date"
                            class="block text-sm font-medium text-slate-700">
                            Tanggal Selesai PKL
                        </label>

                        <input
                            type="date"
                            id="internship_end_date"
                            name="internship_end_date"
                            class="mt-2 block w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-amber-500 focus:ring-2 focus:ring-amber-100">

                    </div>

                </div>

            </div>


            {{-- Information --}}
            <div class="mt-8 rounded-xl border border-amber-200 bg-amber-50 p-4">

                <div class="flex gap-3">

                    <div class="mt-0.5 shrink-0 text-amber-600">

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
                                d="M12 9v3.75m0 3h.007v.008H12V15.75ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />

                        </svg>

                    </div>

                    <p class="text-sm leading-6 text-amber-800">
                        Pastikan seluruh anggota kelompok sudah menyetujui
                        perusahaan dan periode PKL yang dipilih.
                    </p>

                </div>

            </div>


            {{-- Actions --}}
            <div class="mt-8 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('student.applications.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                    Batal
                </a>


                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-amber-500 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-amber-600">
                    Ajukan PKL
                </button>

            </div>

        </form>

    </div>

</div>


<script>
    const addMemberButton =
        document.getElementById('add-member-button');

    const membersContainer =
        document.getElementById('members-container');

    const emptyMembers =
        document.getElementById('empty-members');

    const leaderNisNip = "{{ auth()->user()->nis_nip }}";

    let memberIndex = 0;


    function updateEmptyState() {
        if (membersContainer.children.length === 0) {

            emptyMembers.classList.remove('hidden');

        } else {

            emptyMembers.classList.add('hidden');

        }
    }


    function isMemberAlreadyAdded(studentId, currentWrapper) {

        const memberIds = Array.from(
                membersContainer.querySelectorAll('.member-id')
            )
            .filter(input =>
                input.closest('.member-row') !== currentWrapper
            )
            .map(input => input.value)
            .filter(value => value);


        return memberIds.includes(String(studentId));
    }


    function createMemberRow() {
        const memberId = memberIndex++;

        const wrapper = document.createElement('div');

        wrapper.className =
            'member-row rounded-xl border border-slate-200 bg-white p-5';


        wrapper.innerHTML = `
            <div class="flex items-start justify-between gap-4">

                <div>

                    <p class="text-sm font-semibold text-slate-900">
                        Anggota ${memberId + 1}
                    </p>

                    <p class="mt-1 text-xs text-slate-500">
                        Masukkan NIS/NIP siswa.
                    </p>

                </div>


                <button
                    type="button"
                    class="remove-member shrink-0 text-sm font-medium text-slate-400 transition hover:text-red-500">

                    Hapus

                </button>

            </div>


            <div class="mt-4">

                <label
                    class="block text-sm font-medium text-slate-700">

                    NIS/NIP

                </label>


                <div class="mt-2 flex flex-col gap-2 sm:flex-row">

                    <input
                        type="text"
                        class="member-nis-nip block w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-amber-500 focus:ring-2 focus:ring-amber-100"
                        placeholder="Contoh: 1234567891">


                    <button
                        type="button"
                        class="search-member inline-flex shrink-0 items-center justify-center rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800">

                        Cari Siswa

                    </button>

                </div>

            </div>


            <div class="member-result mt-4 hidden rounded-xl border border-slate-200 bg-slate-50 p-4">

                <div class="grid gap-4 sm:grid-cols-2">

                    <div>

                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Nama Lengkap
                        </p>

                        <p class="member-name mt-1 text-sm font-semibold text-slate-800"></p>

                    </div>


                    <div>

                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            NIS/NIP
                        </p>

                        <p class="member-nis mt-1 text-sm font-medium text-slate-700"></p>

                    </div>


                    <div>

                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Kelas
                        </p>

                        <p class="member-class mt-1 text-sm font-medium text-slate-700"></p>

                    </div>


                    <div>

                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                            Nomor HP
                        </p>

                        <p class="member-phone mt-1 text-sm font-medium text-slate-700"></p>

                    </div>

                </div>


                <input
                    type="hidden"
                    name="member_ids[]"
                    class="member-id">

            </div>


            <p class="member-error mt-3 hidden text-sm text-red-500"></p>
        `;


        membersContainer.appendChild(wrapper);


        const removeButton =
            wrapper.querySelector('.remove-member');

        const searchButton =
            wrapper.querySelector('.search-member');

        const nisInput =
            wrapper.querySelector('.member-nis-nip');

        const result =
            wrapper.querySelector('.member-result');

        const error =
            wrapper.querySelector('.member-error');

        const memberIdInput =
            wrapper.querySelector('.member-id');


        removeButton.addEventListener('click', function() {

            wrapper.remove();

            updateEmptyState();

        });


        /*
         * Jika NIS/NIP diubah setelah siswa ditemukan,
         * hasil siswa sebelumnya tidak lagi dianggap valid.
         */
        nisInput.addEventListener('input', function() {

            memberIdInput.value = '';

            result.classList.add('hidden');

            error.classList.add('hidden');

        });


        searchButton.addEventListener('click', async function() {

            const nisNip =
                nisInput.value.trim();


            error.classList.add('hidden');
            result.classList.add('hidden');


            if (!nisNip) {

                error.textContent =
                    'Masukkan NIS/NIP terlebih dahulu.';

                error.classList.remove('hidden');

                return;

            }


            if (nisNip === leaderNisNip) {

                error.textContent =
                    'Anda tidak dapat menambahkan diri sendiri sebagai anggota kelompok.';

                error.classList.remove('hidden');

                return;

            }


            searchButton.disabled = true;
            searchButton.textContent = 'Mencari...';


            try {

                const response = await fetch(
                    `{{ route('student.students.search') }}?nis_nip=${encodeURIComponent(nisNip)}`
                );


                const data = await response.json();


                if (!response.ok) {

                    throw new Error(
                        data.message ?? 'Siswa tidak ditemukan.'
                    );

                }


                /*
                 * Pastikan data yang dikembalikan benar-benar
                 * berasal dari user dengan role student.
                 */
                if (data.role !== 'student') {

                    throw new Error(
                        'User tersebut bukan siswa dan tidak dapat ditambahkan sebagai anggota kelompok.'
                    );

                }


                /*
                 * Cegah siswa yang sama ditambahkan
                 * pada row yang berbeda.
                 */
                if (isMemberAlreadyAdded(data.id, wrapper)) {

                    throw new Error(
                        'Siswa tersebut sudah ditambahkan sebagai anggota kelompok.'
                    );

                }


                memberIdInput.value =
                    data.id;

                wrapper.querySelector('.member-name').textContent =
                    data.full_name;

                wrapper.querySelector('.member-nis').textContent =
                    data.nis_nip;

                wrapper.querySelector('.member-class').textContent =
                    data.class ?? '-';

                wrapper.querySelector('.member-phone').textContent =
                    data.phone_number ?? '-';


                result.classList.remove('hidden');

            } catch (exception) {

                memberIdInput.value = '';

                error.textContent =
                    exception.message;

                error.classList.remove('hidden');

            } finally {

                searchButton.disabled = false;
                searchButton.textContent = 'Cari Siswa';

            }

        });


        updateEmptyState();
    }


    addMemberButton.addEventListener('click', function() {

        createMemberRow();

    });


    updateEmptyState();
</script>

@endsection