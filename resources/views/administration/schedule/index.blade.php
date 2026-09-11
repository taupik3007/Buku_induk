@extends('administration.master')

@push('link') <style>
.schedule-table {
font-size: 12px;
}

```
    .schedule-table th {
        font-size: 12px;
        padding: 8px 6px !important;
        white-space: nowrap;
    }

    .schedule-table td {
        padding: 7px 5px !important;
        vertical-align: middle;
    }

    .schedule-time {
        width: 120px;
        min-width: 120px;
        font-size: 10px;
        white-space: nowrap;
    }

    .schedule-cell {
        min-width: 150px;
        height: 62px;
    }

    .schedule-cell .subject {
        font-size: 12px;
        font-weight: 600;
        line-height: 1.3;
    }

    .schedule-cell .teacher {
        font-size: 10px;
        color: #6c757d;
        line-height: 1.3;
    }

    .schedule-break {
        background-color: #f8f9fa !important;
        color: #6c757d;
        font-size: 11px;
        font-weight: 600;
    }

    .day-button {
        min-width: 85px;
    }
</style>
```

@endpush

@section('title')
SiMAPUT | Jadwal Pelajaran
@endsection

@section('content')

```
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

                            <li class="breadcrumb-item"
                                aria-current="page">
                                Jadwal Pelajaran
                            </li>

                        </ol>

                    </nav>

                </div>


                <div class="col-3">

                    <div class="text-center mb-n5">

                        <img src="{{ asset('assets/images/breadcrumb/ChatBc.png') }}"
                             alt="modernize-img"
                             class="img-fluid mb-n4">

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Filter --}}
    <div class="card mb-4">

        <div class="card-body">

            <div class="row align-items-end">

                {{-- Tahun Ajaran --}}
                <div class="col-md-4">

                    <form method="GET"
                          action="{{ route('administration.schedule.index') }}">

                        <label for="academic_year"
                               class="form-label fw-semibold">
                            Tahun Ajaran
                        </label>

                        <select name="acy_id"
                                id="academic_year"
                                class="form-select"
                                onchange="this.form.submit()">

                            @foreach ($academicYears as $academicYear)

                                <option value="{{ $academicYear->acy_id }}"
                                    {{ $academicYearId == $academicYear->acy_id ? 'selected' : '' }}>

                                    {{ $academicYear->acy_name }}

                                </option>

                            @endforeach

                        </select>

                    </form>

                </div>

            </div>

        </div>

    </div>


    {{-- Pilihan Hari --}}
    <div class="d-flex flex-wrap gap-2 mb-4">

        @foreach ($days as $dayNumber => $dayName)

            <a href="{{ route('administration.schedule.index', [
                'acy_id' => $academicYearId,
                'day' => $dayNumber,
            ]) }}"
               class="btn day-button
               {{ $day == $dayNumber ? 'btn-primary' : 'btn-light' }}">

                {{ $dayName }}

            </a>

        @endforeach

    </div>


    {{-- Judul --}}
    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>

            <h4 class="fw-semibold mb-1">
                Jadwal Hari {{ $days[$day] ?? '-' }}
            </h4>

            <p class="text-muted mb-0">

                Tahun Ajaran:
                {{ $academicYears->firstWhere('acy_id', $academicYearId)?->acy_name ?? '-' }}

            </p>

        </div>

        <span class="badge bg-success-subtle text-success">
            Jadwal Pelajaran
        </span>

    </div>


    {{-- Tabel --}}
    <div class="card">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered text-center align-middle schedule-table">

                    <thead>

                        <tr>

                            <th class="schedule-time">
                                Jam
                            </th>

                            @foreach ($classes as $class)

                                <th style="min-width: 150px;">

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
                                <td class="schedule-time">

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

                                    <small class="text-muted">

                                        {{ \Carbon\Carbon::parse($slot->slt_start_time)->format('H:i') }}

                                        -

                                        {{ \Carbon\Carbon::parse($slot->slt_end_time)->format('H:i') }}

                                    </small>

                                </td>


                                {{-- Kelas --}}
                                @foreach ($classes as $class)

                                    @if ($slot->slt_type === 'break')

                                        <td class="schedule-break">

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

                                            <td class="schedule-cell">

                                                <div class="subject">

                                                    {{ $schedule->subjectTeacher?->subject?->sbj_name ?? '-' }}

                                                </div>

                                                <div class="teacher">

                                                    {{ $schedule->subjectTeacher?->teacher?->user?->usr_name ?? '-' }}

                                                </div>

                                            </td>

                                        @else

                                            <td class="schedule-cell">

                                                <span class="text-muted">
                                                    -
                                                </span>

                                            </td>

                                        @endif

                                    @endif

                                @endforeach

                            </tr>

                        @empty

                            <tr>

                                <td colspan="{{ $classes->count() + 1 }}"
                                    class="text-center py-5">

                                    <i class="ti ti-calendar-off fs-8 text-muted"></i>

                                    <h5 class="mt-3">
                                        Belum ada slot jadwal
                                    </h5>

                                    <p class="text-muted mb-0">
                                        Belum ada slot waktu untuk hari
                                        {{ $days[$day] ?? '-' }}.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>
```

@endsection
