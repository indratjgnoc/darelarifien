<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>
        Rapor {{ $schoolClass->name }}
    </title>

    <style>
        @page {
            margin: 25px 30px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #222;
        }

        .page {
            page-break-after: always;
        }

        .page:last-child {
            page-break-after: auto;
        }

        /* =========================================================
           HEADER
        ========================================================= */

        .header {
            width: 100%;
            border-bottom: 2px solid #087443;
            padding-bottom: 10px;
            margin-bottom: 18px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            border: none;
            padding: 0;
            vertical-align: middle;
        }

        .logo-cell {
            width: 75px;
            text-align: left;
        }

        .logo {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }

        .header-content {
            text-align: center;
        }

        .school-name {
            font-size: 18px;
            font-weight: bold;
            color: #087443;
            text-transform: uppercase;
        }

        .school-address {
            margin-top: 3px;
            font-size: 9px;
            color: #555;
        }

        .document-title {
            margin-top: 7px;
            font-size: 14px;
            font-weight: bold;
        }

        .academic-year {
            margin-top: 3px;
            color: #666;
            font-size: 9px;
        }

        /* =========================================================
           IDENTITY
        ========================================================= */

        .identity {
            width: 100%;
            margin-bottom: 18px;
            border-collapse: collapse;
        }

        .identity td {
            padding: 4px 0;
            vertical-align: top;
        }

        .identity .label {
            width: 90px;
            font-weight: bold;
        }

        .identity .separator {
            width: 10px;
        }

        .identity .value {
            width: 35%;
        }

        /* =========================================================
           TABLE NILAI
        ========================================================= */

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            background: #087443;
            color: white;
            border: 1px solid #087443;
            padding: 7px;
            text-align: center;
            font-weight: bold;
        }

        .table td {
            border: 1px solid #d9d9d9;
            padding: 7px;
            vertical-align: middle;
        }

        .table .center {
            text-align: center;
        }

        .table .subject {
            font-weight: bold;
        }

        /* =========================================================
           SUMMARY
        ========================================================= */

        .summary {
            margin-top: 18px;
            padding: 10px;
            border: 1px solid #d9d9d9;
            background: #f8faf9;
        }

        .summary-title {
            font-weight: bold;
            margin-bottom: 7px;
        }

        /* =========================================================
           SIGNATURE
        ========================================================= */

        .signatures {
            width: 100%;
            margin-top: 45px;
            border-collapse: collapse;
        }

        .signatures td {
            width: 50%;
            text-align: center;
            vertical-align: top;
            padding: 0;
        }

        /*
         * Tinggi dibuat sama untuk kedua kolom.
         * Ini memastikan nama Kepala Pesantren dan
         * nama Wali Kelas berada pada garis horizontal
         * yang sama.
         */
        .signature-title {
            height: 32px;
            line-height: 16px;
        }

        .signature-space {
            height: 65px;
        }

        .signature-name {
            font-weight: bold;
            text-decoration: underline;
        }

        /* =========================================================
           FOOTER
        ========================================================= */

        .footer {
            margin-top: 20px;
            font-size: 8px;
            color: #888;
            text-align: center;
        }
    </style>
</head>

<body>

    @foreach ($students as $report)

        <div class="page">

            {{-- =====================================================
                 HEADER
            ====================================================== --}}

            <div class="header">

                <table class="header-table">

                    <tr>

                        {{-- LOGO --}}
                        <td class="logo-cell">

                            @if (!empty($settings['logo']))

                                @php
                                    $logoPath = storage_path(
                                        'app/public/' . $settings['logo']
                                    );
                                @endphp

                                @if (file_exists($logoPath))

                                    <img
                                        src="{{ $logoPath }}"
                                        class="logo"
                                        alt="Logo"
                                    >

                                @endif

                            @endif

                        </td>


                        {{-- INFORMASI PESANTREN --}}
                        <td class="header-content">

                            <div class="school-name">
                                {{ $settings['school_name'] ?? 'Pesantren Darel Arifien' }}
                            </div>

                            @if (!empty($settings['address']))

                                <div class="school-address">
                                    {{ $settings['address'] }}
                                </div>

                            @endif

                            <div class="document-title">
                                LAPORAN HASIL BELAJAR SANTRI
                            </div>

                            <div class="academic-year">

                                Tahun Ajaran:
                                {{ $schoolClass->academicYear->name ?? '-' }}

                            </div>

                        </td>

                        {{-- SPACER AGAR HEADER TETAP CENTER --}}
                        <td class="logo-cell">
                        </td>

                    </tr>

                </table>

            </div>


            {{-- =====================================================
                 IDENTITAS SANTRI
            ====================================================== --}}

            <table class="identity">

                <tr>

                    <td class="label">
                        Nama Santri
                    </td>

                    <td class="separator">
                        :
                    </td>

                    <td class="value">
                        {{ $report->student->name }}
                    </td>

                    <td class="label">
                        Kelas
                    </td>

                    <td class="separator">
                        :
                    </td>

                    <td>
                        {{ $schoolClass->name }}
                    </td>

                </tr>


                <tr>

                    <td class="label">
                        NIS
                    </td>

                    <td class="separator">
                        :
                    </td>

                    <td class="value">
                        {{ $report->student->nis ?? '-' }}
                    </td>

                    <td class="label">
                        Semester
                    </td>

                    <td class="separator">
                        :
                    </td>

                    <td>
                        {{ $schoolClass->academicYear->semester ?? '-' }}
                    </td>

                </tr>


                <tr>

                    <td class="label">
                        NISN
                    </td>

                    <td class="separator">
                        :
                    </td>

                    <td class="value">
                        {{ $report->student->nisn ?? '-' }}
                    </td>

                    <td class="label">
                        Wali Kelas
                    </td>

                    <td class="separator">
                        :
                    </td>

                    <td>
                        {{ $schoolClass->homeroomTeacher->name ?? '-' }}
                    </td>

                </tr>

            </table>


            {{-- =====================================================
                 NILAI
            ====================================================== --}}

            <table class="table">

                <thead>

                    <tr>

                        <th style="width: 7%;">
                            No
                        </th>

                        <th style="width: 43%;">
                            Mata Pelajaran
                        </th>

                        <th style="width: 20%;">
                            Guru
                        </th>

                        <th style="width: 15%;">
                            Nilai
                        </th>

                        <th style="width: 15%;">
                            Predikat
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach ($report->subjects as $index => $item)

                        @php

                            $score = (float) $item->final_score;

                            /*
                             * Predikat sementara.
                             *
                             * Nanti bisa kita pindahkan ke
                             * pengaturan akademik jika sekolah
                             * mempunyai standar resmi.
                             */

                            if ($score >= 90) {
                                $predicate = 'A';
                            } elseif ($score >= 80) {
                                $predicate = 'B';
                            } elseif ($score >= 70) {
                                $predicate = 'C';
                            } else {
                                $predicate = 'D';
                            }

                        @endphp


                        <tr>

                            <td class="center">
                                {{ $index + 1 }}
                            </td>

                            <td class="subject">
                                {{ $item->subject->name ?? '-' }}
                            </td>

                            <td>
                                {{ $item->teacher->name ?? '-' }}
                            </td>

                            <td class="center">
                                {{ number_format($score, 2) }}
                            </td>

                            <td class="center">
                                {{ $predicate }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>


            {{-- =====================================================
                 KETERANGAN
            ====================================================== --}}

            <div class="summary">

                <div class="summary-title">
                    Keterangan
                </div>

                <div>
                    Nilai akhir dihitung berdasarkan bobot komponen
                    penilaian yang telah ditetapkan pada tahun ajaran.
                </div>

            </div>


            {{-- =====================================================
                 TANDA TANGAN
            ====================================================== --}}

            <table class="signatures">

                <tr>

                    {{-- KEPALA PESANTREN --}}
                    <td>

                        <div class="signature-title">
                            Mengetahui,<br>
                            Kepala Pesantren
                        </div>

                        <div class="signature-space"></div>

                        <div class="signature-name">
                            {{ $settings['principal_name'] ?? '______________________________' }}
                        </div>

                    </td>


                    {{-- WALI KELAS --}}
                    <td>

                        <div class="signature-title">
                            &nbsp;<br>
                            Wali Kelas
                        </div>

                        <div class="signature-space"></div>

                        <div class="signature-name">
                            {{ $schoolClass->homeroomTeacher->name ?? '______________________________' }}
                        </div>

                    </td>

                </tr>

            </table>


            {{-- =====================================================
                 FOOTER
            ====================================================== --}}

            <div class="footer">

                Dokumen ini dibuat melalui Sistem Informasi Akademik

                @if (!empty($settings['school_name']))

                    {{ $settings['school_name'] }}

                @else

                    Pesantren Darel Arifien

                @endif

            </div>

        </div>

    @endforeach

</body>

</html>