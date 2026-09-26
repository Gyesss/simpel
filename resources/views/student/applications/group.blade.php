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

    {{-- Validation Errors --}}
    @if ($errors->any())

    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4">

        <div class="flex gap-3">

            <div class="mt-0.5 shrink-0 text-red-600">

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
                        d="M12 9v3.75m0 3.75h.007v.007H12v-.007ZM3.75 19.5h16.5L12 4.5 3.75 19.5Z" />

                </svg>

            </div>

            <div>

                <p class="text-sm font-semibold text-red-800">
                    Pengajuan tidak dapat dibuat.
                </p>

                <ul class="mt-2 space-y-1 text-sm text-red-700">

                    @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                    @endforeach

                </ul>

            </div>

        </div>

    </div>

    @endif

    {{-- Application Form --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

        <form
            method="POST"
            action="{{ route('student.applications.group.store') }}">

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
                            Jumlah anggota tidak dibatasi oleh sistem.
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
                            required
                            class="mt-2 block w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-amber-500 focus:ring-2 focus:ring-amber-100">

                            <option value="">
                                Pilih perusahaan
                            </option>

                            @foreach ($companies as $company)

                            <option
                                value="{{ $company->id }}"
                                data-quota="{{ $company->available_quota }}"
                                @selected(
                                old('company_id')==$company->id
                                )>

                                {{ $company->company_name }}
                                — {{ $company->available_quota }} kuota tersedia

                            </option>

                            @endforeach

                        </select>


                        {{-- Quota Warning --}}
                        <div
                            id="quota-warning"
                            class="mt-3 hidden rounded-xl border border-amber-200 bg-amber-50 p-4">

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
                                            d="M12 9v3.75m0 3.75h.007v.007H12v-.007ZM10.34 3.94 2.82 17.25a1.875 1.875 0 0 0 1.63 2.813h15.1a1.875 1.875 0 0 0 1.63-2.813L13.66 3.94a1.875 1.875 0 0 0-3.32 0Z" />

                                    </svg>

                                </div>

                                <div>

                                    <p class="text-sm font-semibold text-amber-800">
                                        Kuota perusahaan tidak mencukupi
                                    </p>

                                    <p
                                        id="quota-warning-text"
                                        class="mt-1 text-sm leading-6 text-amber-700">
                                    </p>

                                </div>

                            </div>

                        </div>

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
                            value="{{ old('internship_start_date') }}"
                            required
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
                            value="{{ old('internship_end_date') }}"
                            required
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

                    <div>

                        <p class="text-sm font-semibold text-amber-900">
                            Perhatikan sebelum mengajukan
                        </p>

                        <p class="mt-1 text-sm leading-6 text-amber-800">
                            Pastikan seluruh anggota kelompok sudah menyetujui
                            perusahaan dan periode PKL yang dipilih.
                            Jumlah anggota kelompok tidak dibatasi oleh sistem.
                            Jika jumlah peserta melebihi kuota perusahaan,
                            pengajuan tetap dapat dikirim dan akan menjadi
                            bahan pertimbangan dalam proses validasi Hubin
                            dan perusahaan.
                        </p>

                    </div>

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

    const companySelect =
        document.getElementById('company_id');

    const quotaWarning =
        document.getElementById('quota-warning');

    const quotaWarningText =
        document.getElementById('quota-warning-text');

    const leaderNisNip =
        "{{ auth()->user()->nis_nip }}";

    let memberIndex = 0;


    function updateEmptyState() {

        if (membersContainer.children.length === 0) {

            emptyMembers.classList.remove('hidden');

        } else {

            emptyMembers.classList.add('hidden');

        }

    }


    function updateQuotaWarning() {

        const selectedOption =
            companySelect.options[
                companySelect.selectedIndex
            ];


        if (
            !selectedOption ||
            !selectedOption.value
        ) {

            quotaWarning.classList.add('hidden');

            quotaWarningText.textContent = '';

            return;

        }


        const quota =
            Number(
                selectedOption.dataset.quota
            );


        /*
         * Total students consists of:
         * 1 leader + all added members.
         */

        const totalStudents =
            1 + membersContainer.children.length;


        if (totalStudents > quota) {

            quotaWarning.classList.remove('hidden');

            quotaWarningText.textContent =
                `Kelompok ini berjumlah ${totalStudents} siswa, sedangkan perusahaan memiliki ${quota} kuota tersedia. Pengajuan tetap dapat dikirim, tetapi penerimaan dan penempatan tetap bergantung pada keputusan Hubin dan perusahaan.`;

        } else {

            quotaWarning.classList.add('hidden');

            quotaWarningText.textContent = '';

        }

    }


    function isMemberAlreadyAdded(
        studentId,
        currentWrapper
    ) {

        const memberIds =
            Array.from(
                membersContainer.querySelectorAll('.member-id')
            )
            .filter(input =>
                input.closest('.member-row') !== currentWrapper
            )
            .map(input => input.value)
            .filter(value => value);


        return memberIds.includes(
            String(studentId)
        );

    }


    function createMemberRow() {

        const memberId =
            memberIndex++;

        const wrapper =
            document.createElement('div');


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
                        required
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


        removeButton.addEventListener(
            'click',
            function() {

                wrapper.remove();

                updateEmptyState();
                updateQuotaWarning();

            }
        );


        nisInput.addEventListener(
            'input',
            function() {

                memberIdInput.value = '';

                result.classList.add('hidden');

                error.classList.add('hidden');

            }
        );


        searchButton.addEventListener(
            'click',
            async function() {

                const nisNip =
                    nisInput.value.trim();


                error.classList.add('hidden');

                result.classList.add('hidden');


                if (!nisNip) {

                    error.textContent =
                        'Masukkan NIS/NIP terlebih dahulu.';

                    error.classList.remove('hidden');

                    nisInput.focus();

                    return;

                }


                if (
                    leaderNisNip &&
                    nisNip === leaderNisNip
                ) {

                    error.textContent =
                        'Anda tidak dapat menambahkan diri sendiri sebagai anggota kelompok.';

                    error.classList.remove('hidden');

                    return;

                }


                searchButton.disabled = true;

                searchButton.textContent =
                    'Mencari...';


                try {

                    const response =
                        await fetch(
                            `{{ route('student.students.search') }}?nis_nip=${encodeURIComponent(nisNip)}`
                        );


                    const data =
                        await response.json();


                    if (!response.ok) {

                        throw new Error(
                            data.message ??
                            'Siswa tidak ditemukan.'
                        );

                    }


                    if (data.role !== 'student') {

                        throw new Error(
                            'User tersebut bukan siswa dan tidak dapat ditambahkan sebagai anggota kelompok.'
                        );

                    }


                    if (
                        isMemberAlreadyAdded(
                            data.id,
                            wrapper
                        )
                    ) {

                        throw new Error(
                            'Siswa tersebut sudah ditambahkan sebagai anggota kelompok.'
                        );

                    }


                    memberIdInput.value =
                        data.id;

                    wrapper.querySelector(
                            '.member-name'
                        ).textContent =
                        data.full_name;

                    wrapper.querySelector(
                            '.member-nis'
                        ).textContent =
                        data.nis_nip;

                    wrapper.querySelector(
                            '.member-class'
                        ).textContent =
                        data.class ?? '-';

                    wrapper.querySelector(
                            '.member-phone'
                        ).textContent =
                        data.phone_number ?? '-';


                    result.classList.remove(
                        'hidden'
                    );

                } catch (exception) {

                    memberIdInput.value = '';

                    error.textContent =
                        exception.message;

                    error.classList.remove(
                        'hidden'
                    );

                } finally {

                    searchButton.disabled = false;

                    searchButton.textContent =
                        'Cari Siswa';

                }

            }
        );


        updateEmptyState();
        updateQuotaWarning();

    }


    addMemberButton.addEventListener(
        'click',
        function() {

            createMemberRow();

            updateQuotaWarning();

        }
    );


    companySelect.addEventListener(
        'change',
        updateQuotaWarning
    );


    updateEmptyState();
    updateQuotaWarning();
</script>

@endsection