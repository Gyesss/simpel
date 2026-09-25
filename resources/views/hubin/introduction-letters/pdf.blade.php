<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>
        Surat Pengantar PKL - {{ $introductionLetter->letter_number }}
    </title>

    <style>
        @page {
            margin: 25mm 25mm 25mm 25mm;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11pt;
            line-height: 1.6;
            color: #000;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .school-name {
            font-size: 16pt;
            font-weight: bold;
            margin: 0;
        }

        .school-type {
            font-size: 11pt;
            font-weight: bold;
            margin: 2px 0;
        }

        .school-address {
            font-size: 9pt;
            margin: 2px 0;
        }

        .header-line {
            border-top: 3px solid #000;
            border-bottom: 1px solid #000;
            height: 4px;
            margin-top: 10px;
            margin-bottom: 25px;
        }

        .title {
            text-align: center;
            margin-bottom: 2px;
        }

        .title h1 {
            font-size: 13pt;
            margin: 0;
            text-decoration: underline;
        }

        .letter-number {
            text-align: center;
            margin-bottom: 25px;
        }

        .paragraph {
            text-align: justify;
            margin-bottom: 12px;
        }

        .recipient {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .student-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        .student-table th,
        .student-table td {
            border: 1px solid #000;
            padding: 7px 8px;
        }

        .student-table th {
            text-align: center;
            font-weight: bold;
        }

        .student-table .number {
            width: 35px;
            text-align: center;
        }

        .student-table .nis {
            width: 100px;
        }

        .student-table .class {
            width: 75px;
            text-align: center;
        }

        .period-table {
            width: 100%;
            margin: 15px 0;
        }

        .period-table td {
            padding: 3px 0;
        }

        .signature {
            width: 100%;
            margin-top: 40px;
        }

        .signature-date {
            text-align: center;
            margin-bottom: 5px;
        }

        .signature-box {
            width: 45%;
            margin-left: auto;
            text-align: center;
        }

        .signature-space {
            height: 75px;
        }

        .signature-name {
            font-weight: bold;
            text-decoration: underline;
        }

        .footer-note {
            margin-top: 30px;
            font-size: 8pt;
            color: #555;
            text-align: center;
        }
    </style>
</head>

<body>

    @php
    $application = $introductionLetter->internshipApplication;

    $students = collect();

    if ($application->leaderStudent) {
    $students->push($application->leaderStudent);
    }

    foreach ($application->groupMembers as $member) {
    if ($member->student) {
    $students->push($member->student);
    }
    }

    $students = $students
    ->unique('id')
    ->values();

    $letterDate = $introductionLetter->letter_date
    ->locale('id')
    ->translatedFormat('d F Y');

    $internshipStart = \Carbon\Carbon::parse(
    $application->internship_start_date
    )
    ->locale('id')
    ->translatedFormat('d F Y');

    $internshipEnd = \Carbon\Carbon::parse(
    $application->internship_end_date
    )
    ->locale('id')
    ->translatedFormat('d F Y');
    @endphp


    {{-- HEADER SEKOLAH --}}

    <div class="header">

        <p class="school-name">
            SMK ICB CINTA NIAGA
        </p>

        <p class="school-type">
            SEKOLAH MENENGAH KEJURUAN
        </p>

        <p class="school-address">
            [ALAMAT LENGKAP SEKOLAH]
        </p>

        <p class="school-address">
            Telp. [NOMOR TELEPON] &nbsp; | &nbsp;
            Email: [EMAIL SEKOLAH]
        </p>

    </div>

    <div class="header-line"></div>


    {{-- JUDUL SURAT --}}

    <div class="title">

        <h1>
            SURAT PENGANTAR PRAKTIK KERJA LAPANGAN
        </h1>

        <strong>
            (PKL)
        </strong>

    </div>

    <div class="letter-number">

        Nomor:
        {{ $introductionLetter->letter_number }}

    </div>


    {{-- PEMBUKA --}}

    <p class="paragraph">
        Yang bertanda tangan di bawah ini, Kepala SMK ICB Cinta Niaga,
        menerangkan bahwa siswa-siswi berikut merupakan peserta
        Praktik Kerja Lapangan (PKL) dari SMK ICB Cinta Niaga:
    </p>


    {{-- DATA SISWA --}}

    <table class="student-table">

        <thead>

            <tr>
                <th class="number">
                    No.
                </th>

                <th>
                    Nama Siswa
                </th>

                <th class="nis">
                    NIS
                </th>

                <th class="class">
                    Kelas
                </th>
            </tr>

        </thead>

        <tbody>

            @foreach ($students as $index => $student)

            <tr>

                <td class="number">
                    {{ $index + 1 }}
                </td>

                <td>
                    {{ $student->full_name }}
                </td>

                <td>
                    {{ $student->nis_nip ?? '-' }}
                </td>

                <td class="class">
                    {{ $student->class ?? '-' }}
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>


    {{-- TUJUAN PERUSAHAAN --}}

    <p class="paragraph">
        Siswa-siswi tersebut akan melaksanakan Praktik Kerja Lapangan
        di:
    </p>

    <div class="recipient">

        <strong>
            {{ $application->company->company_name }}
        </strong>

        <br>

        {{ $application->company->full_address }}

    </div>


    {{-- PERIODE PKL --}}

    <p class="paragraph">
        Adapun pelaksanaan Praktik Kerja Lapangan tersebut direncanakan
        berlangsung pada:
    </p>

    <table class="period-table">

        <tr>
            <td style="width: 160px;">
                <strong>
                    Periode PKL
                </strong>
            </td>

            <td>
                :
                {{ $internshipStart }}
                s.d.
                {{ $internshipEnd }}
            </td>
        </tr>

        <tr>
            <td>
                <strong>
                    Tempat
                </strong>
            </td>

            <td>
                :
                {{ $application->company->company_name }}
            </td>
        </tr>

    </table>


    {{-- PENUTUP --}}

    <p class="paragraph">
        Demikian surat pengantar ini dibuat untuk dapat dipergunakan
        sebagaimana mestinya. Kami mengucapkan terima kasih atas
        perhatian dan kerja sama yang diberikan dalam pelaksanaan
        Praktik Kerja Lapangan siswa-siswi kami.
    </p>


    {{-- TANDA TANGAN --}}

    <div class="signature">

        <div class="signature-date">
            Bandung, {{ $letterDate }}
        </div>

        <div class="signature-box">

            <div>
                Kepala SMK ICB Cinta Niaga
            </div>

            <div class="signature-space">
            </div>

            <div class="signature-name">
                [NAMA KEPALA SEKOLAH]
            </div>

            <div>
                NIP. [NIP KEPALA SEKOLAH]
            </div>

        </div>

    </div>


    <div class="footer-note">
        Dokumen ini diterbitkan melalui Sistem Manajemen PKL (SIMPEL).
    </div>

</body>

</html>