<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>
        Surat Pengantar PKL - {{ $introductionLetter->letter_number }}
    </title>

    <style>
        @page {
            margin: 2.2cm 2.2cm 2cm 2.5cm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            color: #111827;
            font-family: DejaVu Sans, sans-serif;
            font-size: 11pt;
            line-height: 1.6;
        }

        .header {
            width: 100%;
            border-bottom: 3px solid #111827;
            padding-bottom: 10px;
            margin-bottom: 24px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            vertical-align: middle;
        }

        .logo {
            width: 80px;
            height: 80px;
            border: 1px solid #9ca3af;
            text-align: center;
            vertical-align: middle;
            color: #6b7280;
            font-size: 9pt;
        }

        .school-name {
            text-align: center;
            font-size: 16pt;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .school-subtitle {
            margin-top: 2px;
            text-align: center;
            font-size: 11pt;
            font-weight: bold;
        }

        .school-address {
            margin-top: 4px;
            text-align: center;
            font-size: 8.5pt;
            color: #374151;
        }

        .letter-title {
            text-align: center;
            font-weight: bold;
            font-size: 12pt;
            text-decoration: underline;
            margin-top: 18px;
        }

        .letter-number {
            text-align: center;
            font-size: 10pt;
            margin-top: 2px;
        }

        .metadata {
            width: 100%;
            border-collapse: collapse;
            margin-top: 24px;
            margin-bottom: 18px;
        }

        .metadata td {
            padding: 2px 0;
            vertical-align: top;
        }

        .metadata .label {
            width: 80px;
        }

        .metadata .colon {
            width: 12px;
        }

        .content {
            text-align: justify;
        }

        .content p {
            margin-top: 0;
            margin-bottom: 12px;
        }

        .student-table {
            width: 100%;
            border-collapse: collapse;
            margin: 14px 0 16px;
            font-size: 9.5pt;
        }

        .student-table th,
        .student-table td {
            border: 1px solid #374151;
            padding: 6px 7px;
        }

        .student-table th {
            text-align: center;
            font-weight: bold;
            background: #f3f4f6;
        }

        .student-table .number {
            width: 35px;
            text-align: center;
        }

        .student-table .nis {
            width: 90px;
        }

        .student-table .class {
            width: 75px;
            text-align: center;
        }

        .signature {
            width: 100%;
            margin-top: 40px;
        }

        .signature-table {
            width: 100%;
            border-collapse: collapse;
        }

        .signature-table td {
            vertical-align: top;
        }

        .signature-left {
            width: 55%;
        }

        .signature-right {
            width: 45%;
            text-align: left;
        }

        .signature-space {
            height: 85px;
        }

        .principal-name {
            font-weight: bold;
            text-decoration: underline;
        }

        .footer-note {
            margin-top: 35px;
            padding-top: 8px;
            border-top: 1px solid #d1d5db;
            font-size: 8pt;
            color: #6b7280;
            text-align: center;
        }
    </style>

</head>

<body>

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div class="header">

        <table class="header-table">

            <tr>

                <td style="width: 90px;">

                    <div class="logo">
                        LOGO<br>
                        SEKOLAH
                    </div>

                </td>

                <td>

                    <div class="school-name">
                        SMK ICB CINTA NIAGA
                    </div>

                    <div class="school-subtitle">
                        BANDUNG
                    </div>

                    <div class="school-address">
                        [Alamat Sekolah]
                        &nbsp; | &nbsp;
                        Telp. [Nomor Telepon]
                        &nbsp; | &nbsp;
                        Email: [Email Sekolah]
                    </div>

                </td>

            </tr>

        </table>

    </div>

    {{-- ========================================================= --}}
    {{-- TITLE --}}
    {{-- ========================================================= --}}

    <div class="letter-title">
        SURAT PENGANTAR PRAKTIK KERJA LAPANGAN
    </div>

    <div class="letter-number">
        Nomor: {{ $introductionLetter->letter_number }}
    </div>

    {{-- ========================================================= --}}
    {{-- RECIPIENT --}}
    {{-- ========================================================= --}}

    <table class="metadata">

        <tr>

            <td class="label">
                Lampiran
            </td>

            <td class="colon">
                :
            </td>

            <td>
                1 (satu) berkas
            </td>

        </tr>

        <tr>

            <td class="label">
                Perihal
            </td>

            <td class="colon">
                :
            </td>

            <td>
                Pengantar Praktik Kerja Lapangan (PKL)
            </td>

        </tr>

    </table>

    <div class="content">

        <p>
            Yth. Pimpinan
            <strong>
                {{ $introductionLetter->internshipApplication->company->company_name ?? '-' }}
            </strong>
            <br>
            di tempat
        </p>

        <p>
            Dengan hormat,
        </p>

        <p>
            Dalam rangka pelaksanaan kegiatan Praktik Kerja Lapangan (PKL)
            bagi peserta didik SMK ICB Cinta Niaga Bandung, dengan ini kami
            menerangkan dan mengantarkan peserta didik berikut untuk dapat
            melaksanakan kegiatan Praktik Kerja Lapangan pada instansi/
            perusahaan yang Bapak/Ibu pimpin.
        </p>

        {{-- ===================================================== --}}
        {{-- STUDENTS --}}
        {{-- ===================================================== --}}

        <table class="student-table">

            <thead>

                <tr>

                    <th class="number">
                        No.
                    </th>

                    <th class="nis">
                        NIS/NIP
                    </th>

                    <th>
                        Nama Peserta Didik
                    </th>

                    <th class="class">
                        Kelas
                    </th>

                </tr>

            </thead>

            <tbody>

                @php
                $students = collect();

                if ($introductionLetter->internshipApplication->leaderStudent) {
                $students->push(
                $introductionLetter->internshipApplication->leaderStudent
                );
                }

                foreach (
                $introductionLetter->internshipApplication->groupMembers
                as $member
                ) {
                if (
                $member->student &&
                ! $students->contains('id', $member->student->id)
                ) {
                $students->push($member->student);
                }
                }
                @endphp

                @foreach ($students as $student)

                <tr>

                    <td class="number">
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $student->nis_nip ?? '-' }}
                    </td>

                    <td>
                        {{ $student->full_name ?? '-' }}
                    </td>

                    <td class="class">
                        {{ $student->class ?? '-' }}
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

        {{-- ===================================================== --}}
        {{-- INTERNSHIP INFORMATION --}}
        {{-- ===================================================== --}}

        <p>
            Peserta didik tersebut akan melaksanakan Praktik Kerja Lapangan
            selama periode
            <strong>
                {{ \Carbon\Carbon::parse(
                    $introductionLetter->internshipApplication->internship_start_date
                )->translatedFormat('d F Y') }}
            </strong>
            sampai dengan
            <strong>
                {{ \Carbon\Carbon::parse(
                    $introductionLetter->internshipApplication->internship_end_date
                )->translatedFormat('d F Y') }}
            </strong>.
        </p>

        <p>
            Kami mengharapkan bantuan dan kerja sama dari pihak perusahaan
            dalam memberikan bimbingan, pengarahan, serta pengalaman kerja
            yang relevan kepada peserta didik selama pelaksanaan kegiatan
            tersebut.
        </p>

        <p>
            Demikian surat pengantar ini kami sampaikan. Atas perhatian,
            kerja sama, dan kesempatan yang diberikan, kami mengucapkan
            terima kasih.
        </p>

    </div>

    {{-- ========================================================= --}}
    {{-- SIGNATURE --}}
    {{-- ========================================================= --}}

    <div class="signature">

        <table class="signature-table">

            <tr>

                <td class="signature-left">
                </td>

                <td class="signature-right">

                    Bandung,
                    {{ \Carbon\Carbon::parse(
                        $introductionLetter->letter_date
                    )->translatedFormat('d F Y') }}

                    <br>

                    Kepala SMK ICB Cinta Niaga

                    <div class="signature-space">
                    </div>

                    <div class="principal-name">
                        [Nama Kepala Sekolah]
                    </div>

                    <div>
                        NIP. [NIP Kepala Sekolah]
                    </div>

                </td>

            </tr>

        </table>

    </div>

    <div class="footer-note">
        Dokumen ini dibuat melalui Sistem Manajemen PKL (SIMPEL).
    </div>

</body>

</html>