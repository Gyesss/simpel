@extends('layouts.app')

@section('title', 'Sunting Pengajuan Kelompok')

@section('content')

<div>

    {{-- Page Header --}}
    <div class="mb-8">

        <p class="text-sm font-medium text-amber-600">
            Student
        </p>

        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
            Sunting Pengajuan Kelompok
        </h1>

        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
            Perbarui informasi perusahaan, periode PKL, dan anggota kelompok
            sebelum pengajuan divalidasi oleh Hubin.
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
                    Pengajuan tidak dapat diperbarui.
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


    {{-- Application Information --}}
    <div class="mb-5 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                    Kode Pengajuan
                </p>

                <p class="mt-1 text-lg font-bold text-slate-900">
                    {{ $application->application_code }}
                </p>

            </div>

            <span class="w-fit rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
                Menunggu Validasi Hubin
            </span>

        </div>

    </div>


    {{-- Edit Form --}}
    <form
        action="{{ route('student.applications.group.update', $application) }}"
        method="POST">

        @csrf
        @method('PUT')


        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

            {{-- Company --}}
            <div>

                <label
                    for="company_id"
                    class="text-sm font-semibold text-slate-800">

                    Perusahaan Mitra

                </label>

                <p class="mt-1 text-xs leading-5 text-slate-500">
                    Pilih perusahaan mitra yang masih aktif dan memiliki kuota.
                </p>

                <select
                    id="company_id"
                    name="company_id"
                    required
                    class="mt-3 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-amber-400 focus:ring-2 focus:ring-amber-100">

                    <option value="">
                        Pilih perusahaan
                    </option>

                    @foreach ($companies as $company)

                    <option
                        value="{{ $company->id }}"
                        @selected(
                        old( 'company_id' ,
                        $application->company_id
                        ) == $company->id
                        )>

                        {{ $company->company_name }}

                        @if ($company->id === $application->company_id)

                        — Perusahaan Saat Ini

                        @else

                        — {{ $company->available_quota }} kuota tersedia

                        @endif

                    </option>

                    @endforeach

                </select>

            </div>


            {{-- Internship Period --}}
            <div class="mt-6">

                <p class="text-sm font-semibold text-slate-800">
                    Periode PKL
                </p>

                <p class="mt-1 text-xs leading-5 text-slate-500">
                    Tentukan tanggal mulai dan selesai kegiatan PKL.
                </p>

                <div class="mt-3 grid gap-4 sm:grid-cols-2">

                    {{-- Start Date --}}
                    <div>

                        <label
                            for="internship_start_date"
                            class="text-sm font-medium text-slate-700">

                            Tanggal Mulai

                        </label>

                        <input
                            type="date"
                            id="internship_start_date"
                            name="internship_start_date"
                            value="{{ old(
                                'internship_start_date',
                                $application->internship_start_date
                            ) }}"
                            required
                            class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-amber-400 focus:ring-2 focus:ring-amber-100">

                    </div>


                    {{-- End Date --}}
                    <div>

                        <label
                            for="internship_end_date"
                            class="text-sm font-medium text-slate-700">

                            Tanggal Selesai

                        </label>

                        <input
                            type="date"
                            id="internship_end_date"
                            name="internship_end_date"
                            value="{{ old(
                                'internship_end_date',
                                $application->internship_end_date
                            ) }}"
                            required
                            class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-amber-400 focus:ring-2 focus:ring-amber-100">

                    </div>

                </div>

            </div>


            {{-- Group Members --}}
            <div class="mt-8">

                <div>

                    <p class="text-sm font-semibold text-slate-800">
                        Anggota Kelompok
                    </p>

                    <p class="mt-1 text-xs leading-5 text-slate-500">
                        Tambahkan siswa berdasarkan NIS/NIP. Jumlah anggota
                        kelompok tidak dibatasi.
                    </p>

                </div>


                {{-- Current Members --}}
                <div
                    id="member-list"
                    class="mt-4 space-y-3">

                    @foreach ($application->groupMembers as $member)

                    <div
                        class="member-item flex items-center justify-between gap-4 rounded-xl border border-slate-200 bg-slate-50 p-4"
                        data-student-id="{{ $member->student->id }}">

                        <div class="min-w-0">

                            <p class="truncate text-sm font-semibold text-slate-800">
                                {{ $member->student->full_name }}
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                {{ $member->student->nis_nip }}
                                @if ($member->student->class)
                                · {{ $member->student->class }}
                                @endif
                            </p>

                        </div>


<button
    type="button"
    data-student-id="{{ $member->student->id }}"
    onclick="removeMember(this.dataset.studentId)"
    class="shrink-0 rounded-lg px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-50">

    Hapus

</button>


                        <input
                            type="hidden"
                            name="member_ids[]"
                            value="{{ $member->student->id }}">

                    </div>

                    @endforeach

                </div>


                {{-- Search Member --}}
                <div class="mt-5 rounded-xl border border-slate-200 bg-slate-50 p-4">

                    <label
                        for="member_nis_nip"
                        class="text-sm font-medium text-slate-700">

                        Tambah Anggota

                    </label>

                    <p class="mt-1 text-xs leading-5 text-slate-500">
                        Masukkan NIS/NIP siswa yang ingin ditambahkan.
                    </p>


                    <div class="mt-3 flex flex-col gap-3 sm:flex-row">

                        <input
                            type="text"
                            id="member_nis_nip"
                            placeholder="Contoh: 1234567890"
                            class="min-w-0 flex-1 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-amber-400 focus:ring-2 focus:ring-amber-100">


                        <button
                            type="button"
                            onclick="searchMember()"
                            class="rounded-xl bg-slate-800 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-900">

                            Cari Siswa

                        </button>

                    </div>


                    {{-- Search Result --}}
                    <div
                        id="member-result"
                        class="mt-3 hidden rounded-xl border border-slate-200 bg-white p-4">

                    </div>

                </div>

            </div>


            {{-- Notice --}}
            <div class="mt-6 rounded-xl border border-amber-200 bg-amber-50 p-4">

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
                                d="M12 9v3.75m0 3.75h.007v.007H12v-.007ZM10.5 4.5h3L19.5 19.5h-15L10.5 4.5Z" />

                        </svg>

                    </div>

                    <div>

                        <p class="text-sm font-semibold text-amber-800">
                            Perhatikan sebelum menyimpan
                        </p>

                        <p class="mt-1 text-sm leading-6 text-amber-700">
                            Perubahan hanya dapat dilakukan selama pengajuan
                            masih menunggu validasi Hubin.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Actions --}}
            <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('student.application-status') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">

                    Batal

                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-amber-500 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-amber-600">

                    Simpan Perubahan

                </button>

            </div>

        </div>

    </form>

</div>


<script>
    function getCurrentMemberIds() {

        return Array.from(
            document.querySelectorAll(
                '#member-list input[name="member_ids[]"]'
            )
        ).map(input => Number(input.value));

    }


    function searchMember() {

        const input = document.getElementById('member_nis_nip');
        const result = document.getElementById('member-result');

        const nisNip = input.value.trim();

        if (!nisNip) {

            result.classList.remove('hidden');

            result.innerHTML = `
                <p class="text-sm text-red-600">
                    Masukkan NIS/NIP terlebih dahulu.
                </p>
            `;

            return;
        }


        result.classList.remove('hidden');

        result.innerHTML = `
            <p class="text-sm text-slate-500">
                Mencari data siswa...
            </p>
        `;


        fetch(
                `{{ route('student.students.search') }}?nis_nip=${encodeURIComponent(nisNip)}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                }
            )
            .then(async response => {

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(
                        data.message || 'Siswa tidak ditemukan.'
                    );
                }

                return data;

            })
            .then(student => {

                const currentMemberIds = getCurrentMemberIds();

                if (currentMemberIds.includes(Number(student.id))) {

                    result.innerHTML = `
                        <p class="text-sm text-amber-700">
                            Siswa tersebut sudah menjadi anggota kelompok.
                        </p>
                    `;

                    return;
                }


                result.innerHTML = `
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <p class="text-sm font-semibold text-slate-800">
                                ${escapeHtml(student.full_name)}
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                ${escapeHtml(student.nis_nip)}
                                ${
                                    student.class
                                        ? ` · ${escapeHtml(student.class)}`
                                        : ''
                                }
                            </p>

                        </div>

                        <button
                            type="button"
                            onclick='addMember(${JSON.stringify(student)})'
                            class="rounded-xl bg-amber-500 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-amber-600">

                            Tambahkan

                        </button>

                    </div>
                `;

            })
            .catch(error => {

                result.innerHTML = `
                    <p class="text-sm text-red-600">
                        ${escapeHtml(error.message)}
                    </p>
                `;

            });

    }


    function addMember(student) {

        const memberList = document.getElementById('member-list');

        const currentMemberIds = getCurrentMemberIds();

        if (currentMemberIds.includes(Number(student.id))) {

            return;

        }


        const item = document.createElement('div');

        item.className =
            'member-item flex items-center justify-between gap-4 rounded-xl border border-slate-200 bg-slate-50 p-4';

        item.dataset.studentId = student.id;


        item.innerHTML = `

            <div class="min-w-0">

                <p class="truncate text-sm font-semibold text-slate-800">
                    ${escapeHtml(student.full_name)}
                </p>

                <p class="mt-1 text-xs text-slate-500">
                    ${escapeHtml(student.nis_nip)}
                    ${
                        student.class
                            ? ` · ${escapeHtml(student.class)}`
                            : ''
                    }
                </p>

            </div>


            <button
                type="button"
                onclick="removeMember(${student.id})"
                class="shrink-0 rounded-lg px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-50">

                Hapus

            </button>


            <input
                type="hidden"
                name="member_ids[]"
                value="${student.id}">

        `;


        memberList.appendChild(item);


        document.getElementById('member_nis_nip').value = '';

        const result = document.getElementById('member-result');

        result.classList.add('hidden');

        result.innerHTML = '';

    }


    function removeMember(studentId) {

        const item = document.querySelector(
            `.member-item[data-student-id="${studentId}"]`
        );

        if (item) {
            item.remove();
        }

    }


    function escapeHtml(value) {

        const div = document.createElement('div');

        div.textContent = value;

        return div.innerHTML;

    }


    document
        .getElementById('member_nis_nip')
        .addEventListener('keydown', function(event) {

            if (event.key === 'Enter') {

                event.preventDefault();

                searchMember();

            }

        });
</script>

@endsection