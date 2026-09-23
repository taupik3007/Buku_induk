<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Jadwal {{ $days[$day] ?? '-' }}
    </title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #000;
        }

        .print-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .print-header h2 {
            margin: 0 0 5px;
            font-size: 20px;
        }

        .print-header h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 500;
        }

        .print-header p {
            margin: 5px 0 0;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
            vertical-align: middle;
            font-size: 9px;
        }

        th {
            font-weight: bold;
        }

        .time-column {
            width: 70px;
        }

        .time {
            font-size: 8px;
            line-height: 1.3;
        }

        .subject {
            font-size: 9px;
            font-weight: bold;
            line-height: 1.2;
        }

        .teacher {
            font-size: 7px;
            margin-top: 2px;
            line-height: 1.2;
        }

        .break {
            font-weight: bold;
            font-size: 9px;
        }

        .empty {
            color: #777;
        }

        .footer {
            margin-top: 15px;
            font-size: 8px;
            text-align: right;
        }

        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        @media print {

            body {
                margin: 0;
            }

            .no-print {
                display: none !important;
            }

            table {
                page-break-inside: auto;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }

        }

    </style>

</head>

<body>

    <div class="no-print"
         style="margin-bottom: 15px;">

        <button onclick="window.print()">
            Cetak
        </button>

        <button onclick="window.close()">
            Tutup
        </button>

    </div>


    <div class="print-header">

        <h2>
            JADWAL PELAJARAN
        </h2>

        <h3>
            {{ $days[$day] ?? '-' }}
        </h3>

        <p>
            Tahun Ajaran:
            {{ $academicYears->firstWhere('acy_id', $academicYearId)?->acy_name ?? '-' }}
        </p>

    </div>


    <table>

        <thead>

            <tr>

                <th class="time-column">
                    Jam
                </th>

                @foreach ($classes as $class)

                    <th>
                        {{ $class->cls_level }}
                        {{ $class->cls_major?->mjr_abbr ?? '' }}
                        {{ $class->cls_number }}
                    </th>

                @endforeach

            </tr>

        </thead>


        <tbody>

            @forelse ($slots as $slot)

                <tr>

                    {{-- Jam --}}
                    <td>

                        @if ($slot->slt_type === 'break')

                            <strong>
                                Istirahat
                            </strong>

                        @else

                            <strong>
                                Jam {{ $slot->slt_number }}
                            </strong>

                        @endif

                        <div class="time">

                            {{ \Carbon\Carbon::parse($slot->slt_start_time)->format('H:i') }}

                            -

                            {{ \Carbon\Carbon::parse($slot->slt_end_time)->format('H:i') }}

                        </div>

                    </td>


                    {{-- Kelas --}}
                    @foreach ($classes as $class)

                        @if ($slot->slt_type === 'break')

                            <td class="break">
                                ISTIRAHAT
                            </td>

                        @else

                            @php

                                $key =
                                    $slot->slt_id .
                                    '-' .
                                    $class->cls_id;

                                $schedule =
                                    $scheduleMap->get($key);

                            @endphp


                            @if ($schedule)

                                <td>

                                    <div class="subject">

                                        {{ $schedule->subjectTeacher?->subject?->sbj_name ?? '-' }}

                                    </div>

                                    <div class="teacher">

                                        {{ $schedule->subjectTeacher?->teacher?->user?->usr_name ?? '-' }}

                                    </div>

                                </td>

                            @else

                                <td class="empty">
                                    -
                                </td>

                            @endif

                        @endif

                    @endforeach

                </tr>

            @empty

                <tr>

                    <td colspan="{{ $classes->count() + 1 }}">
                        Tidak ada slot jadwal.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>


    <div class="footer">
        Dicetak pada {{ now()->format('d/m/Y H:i') }}
    </div>


    <script>

        window.addEventListener('load', function () {
            window.print();
        });

    </script>

</body>

</html>