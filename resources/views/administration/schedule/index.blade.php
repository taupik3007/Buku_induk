@extends('administration.master')

@push('link')
    <style>
        .schedule-table {
            font-size: 12px;
        }

        .schedule-table th {
            font-size: 12px;
            padding: 8px 6px !important;
            white-space: nowrap;
        }

        .schedule-table td {
            padding: 7px 5px !important;
        }

        .schedule-table .subject-name {
            font-size: 12px;
            font-weight: 600;
            line-height: 1.3;
        }

        .schedule-table .teacher-name {
            font-size: 10px;
            line-height: 1.3;
        }

        .schedule-table .time {
            font-size: 10px;
            line-height: 1.3;
        }

        .schedule-table .break-row td {
            padding: 6px !important;
        }
    </style>
@endpush

@section('title')
    SiMAPUT | Jadwal Pelajaran
@endsection

@section('content')
    <div class="datatables">

        {{-- Header --}}
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">

                <div class="row align-items-center">

                    <div class="col-9">

                        <h4 class="fw-semibold mb-2">
                            JADWAL PELAJARAN
                        </h4>

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">

                                <li class="breadcrumb-item" aria-current="page">
                                    Jadwal Pelajaran
                                </li>

                            </ol>
                        </nav>

                    </div>

                    <div class="col-3">

                        <div class="text-center mb-n5">

                            <img src="{{ asset('assets/images/breadcrumb/ChatBc.png') }}" alt="modernize-img"
                                class="img-fluid mb-n4">

                        </div>

                    </div>

                </div>

            </div>
        </div>


        {{-- Filter --}}
        <div class="card mb-4">

            <div class="card-body">

                <form method="GET" action="{{ route('administration.schedule.index') }}">

                    <div class="row align-items-end">

                        <div class="col-md-4">
                            <label for="academic_year" class="form-label fw-semibold">
                                Tahun Ajaran
                            </label>

                            <select name="acy_id" id="academic_year" class="form-select" onchange="this.form.submit()">

                                @foreach ($academicYears as $academicYear)
                                    <option value="{{ $academicYear->acy_id }}"
                                        {{ $academicYearId == $academicYear->acy_id ? 'selected' : '' }}>
                                        {{ $academicYear->acy_year }}/{{ $academicYear->acy_year + 1 }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="class" class="form-label fw-semibold">
                                Kelas
                            </label>

                            <select name="class_id" id="class" class="form-select" onchange="this.form.submit()">

                                @foreach ($classes as $class)
                                    <option value="{{ $class->cls_id }}" {{ $classId == $class->cls_id ? 'selected' : '' }}>
                                        {{ $class->cls_level }}
                                        {{ $class->cls_major?->mjr_abbr ?? '' }}
                                        {{ $class->cls_number }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                    </div>

                </form>

            </div>

        </div>


        {{-- Informasi --}}
        <div class="d-flex justify-content-between align-items-center mb-3">

            <div>

                <h4 class="fw-semibold mb-1">
                    Jadwal X RPL 1
                </h4>

                <p class="text-muted mb-0">
                    Tahun Ajaran 2026 / 2027
                </p>

            </div>

            <div class="d-flex gap-2">

                <span class="badge bg-success-subtle text-success">
                    Jadwal Tersedia
                </span>

                <button type="button" class="btn btn-outline-primary btn-sm">

                    <i class="ti ti-printer me-1"></i>
                    Cetak

                </button>

            </div>

        </div>


        {{-- Jadwal --}}
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered text-center align-middle schedule-table">

                        <thead>
                            <tr>
                                <th style="width: 120px;">
                                    Jam
                                </th>

                                <th>Senin</th>
                                <th>Selasa</th>
                                <th>Rabu</th>
                                <th>Kamis</th>
                                <th>Jumat</th>
                               
                            </tr>
                        </thead>

                        <tbody>

                            @php
                                $days = [
                                    1 => 'Senin',
                                    2 => 'Selasa',
                                    3 => 'Rabu',
                                    4 => 'Kamis',
                                    5 => 'Jumat',
                                 
                                ];

                                $allSlots = $slots->flatten()->unique('slt_id');
                            @endphp

                            @foreach ($allSlots as $slot)
                                <tr>

                                    {{-- Jam --}}
                                    <td>

                                        @if ($slot->slt_type === 'break')
                                            <span class="fw-semibold text-muted">
                                                Istirahat
                                            </span>
                                        @else
                                            <span class="fw-semibold">
                                                Jam {{ $slot->slt_number }}
                                            </span>
                                        @endif

                                        <br>

                                        <span class="text-muted time">
                                            {{ \Carbon\Carbon::parse($slot->slt_start_time)->format('H:i') }}
                                            -
                                            {{ \Carbon\Carbon::parse($slot->slt_end_time)->format('H:i') }}
                                        </span>

                                    </td>


                                    {{-- Hari --}}
                                    @foreach ($days as $dayNumber => $dayName)
                                        @php
                                            $daySlot = $slots
                                                ->get($dayNumber, collect())
                                                ->firstWhere('slt_id', $slot->slt_id);
                                        @endphp

                                        <td>

                                            @if ($daySlot)
                                                @if ($daySlot->slt_type === 'break')
                                                    <span class="fw-semibold text-muted">
                                                        ISTIRAHAT
                                                    </span>
                                                @else
                                                    @php
                                                        $schedule = $schedules->get($daySlot->slt_id);
                                                    @endphp

                                                    @if ($schedule)
                                                        <div class="subject-name">
                                                            {{ $schedule->subjectTeacher?->subject?->sbj_name ?? '-' }}
                                                        </div>

                                                        <div class="text-muted teacher-name">
                                                            {{ $schedule->subjectTeacher?->teacher?->user?->usr_name ?? '-' }}
                                                        </div>
                                                    @else
                                                        <span class="text-muted">
                                                            -
                                                        </span>
                                                    @endif
                                                @endif
                                            @else
                                                <span class="text-muted">
                                                    -
                                                </span>
                                            @endif

                                        </td>
                                    @endforeach

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>
        </div>

    </div>
@endsection
