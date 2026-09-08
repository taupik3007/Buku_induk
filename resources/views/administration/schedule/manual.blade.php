@extends('administration.master')

@push('link')
    <style>
        .schedule-manual {
            font-size: 12px;
        }

        .schedule-manual th {
            padding: 8px 6px !important;
            font-size: 12px;
            white-space: nowrap;
        }

        .schedule-manual td {
            padding: 7px 5px !important;
            vertical-align: middle;
        }

        .schedule-time {
            width: 115px;
            font-size: 10px;
            white-space: nowrap;
        }

        .schedule-cell {
            min-width: 145px;
            height: 65px;
        }

        .schedule-cell.empty {
            cursor: pointer;
        }

        .schedule-cell.empty:hover {
            background-color: #f8f9fa;
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
            background-color: #f8f9fa;
            color: #6c757d;
            font-size: 11px;
            font-weight: 600;
        }

        .add-schedule {
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
    </style>
@endpush

@section('title')
    SiMAPUT | Penjadwalan Manual
@endsection

@section('content')
    <div class="datatables">

        {{-- Header --}}
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">

                <div class="row align-items-center">

                    <div class="col-9">

                        <h4 class="fw-semibold mb-2">
                            PENJADWALAN
                        </h4>

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">

                                <li class="breadcrumb-item">
                                    <a href="{{ route('administration.schedule.index') }}"
                                        class="text-muted text-decoration-none">
                                        Jadwal
                                    </a>
                                </li>

                                <li class="breadcrumb-item" aria-current="page">
                                    Penjadwalan Manual
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



                <form method="GET" action="{{ route('administration.schedule.manual') }}">

                    <div class="row align-items-end">

                        {{-- Tahun Ajaran --}}
                        <div class="col-md-4 mb-3 mb-md-0">

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


                        {{-- Kelas --}}
                        <div class="col-md-4 mb-3 mb-md-0">

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



                </form>


                <div class="col-md-4">

                    <div class="d-flex gap-2">

                        <button type="button" class="btn btn-primary">

                            <i class="ti ti-device-floppy me-1"></i>
                            Simpan Jadwal

                        </button>

                        <button type="button" class="btn btn-light">

                            <i class="ti ti-refresh me-1"></i>
                            Reset

                        </button>

                    </div>

                </div>

            </div>

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

        <span class="badge bg-warning-subtle text-warning">
            Penyusunan Jadwal
        </span>

    </div>

    @php
        $days = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
        ];
    @endphp
    {{-- Schedule Table --}}
    <div class="card">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered text-center align-middle schedule-manual">

                    <thead>

                        <tr>

                            <th class="schedule-time">
                                Jam
                            </th>

                            <th>
                                Senin
                            </th>

                            <th>
                                Selasa
                            </th>

                            <th>
                                Rabu
                            </th>

                            <th>
                                Kamis
                            </th>

                            <th>
                                Jumat
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($timeRows as $timeRow)
                            <tr>

                                {{-- Waktu --}}
                                <td class="schedule-time">

                                    @if ($timeRow->slt_type === 'break')
                                        <span class="fw-semibold">
                                            Istirahat
                                        </span>
                                    @else
                                        <span class="fw-semibold">
                                            Jam {{ $timeRow->slt_number }}
                                        </span>
                                    @endif

                                    <br>

                                    <span class="text-muted">
                                        {{ \Carbon\Carbon::parse($timeRow->slt_start_time)->format('H:i') }}
                                        -
                                        {{ \Carbon\Carbon::parse($timeRow->slt_end_time)->format('H:i') }}
                                    </span>

                                </td>


                                @foreach ($days as $dayNumber => $dayName)
                                    @php
                                        $slot = $scheduleSlots
                                            ->get($dayNumber, collect())
                                            ->first(function ($item) use ($timeRow) {
                                                return $item->slt_start_time == $timeRow->slt_start_time &&
                                                    $item->slt_end_time == $timeRow->slt_end_time;
                                            });
                                    @endphp


                                    @if (!$slot)
                                        <td class="schedule-cell">
                                            -
                                        </td>
                                    @elseif ($slot->slt_type === 'break')
                                        <td class="schedule-break">
                                            ISTIRAHAT
                                        </td>
                                    @else
                                        @php
                                            $schedule = $schedules->get($slot->slt_id);
                                        @endphp
                                        @if ($schedule)
                                            <td class="schedule-cell">

                                                <div class="position-relative">

                                                    <div class="subject">
                                                        {{ $schedule->subjectTeacher?->subject?->sbj_name ?? '-' }}
                                                    </div>

                                                    <div class="teacher">
                                                        {{ $schedule->subjectTeacher?->teacher?->user?->usr_name ?? '-' }}
                                                    </div>

                                                    <div class="dropdown position-absolute top-0 end-0">

                                                        <button type="button" class="btn btn-sm p-0"
                                                            data-bs-toggle="dropdown" aria-expanded="false">

                                                            <i class="ti ti-dots-vertical"></i>

                                                        </button>

                                                        <ul class="dropdown-menu dropdown-menu-end">

                                                            

                                                            <li>

                                                                <form
                                                                    action="{{ route('administration.schedule.destroy', $schedule->sch_id) }}"
                                                                    method="POST">

                                                                    @csrf
                                                                    @method('DELETE')

                                                                    <button type="submit" class="dropdown-item text-danger"
                                                                        data-confirm-delete="true">

                                                                        <i class="ti ti-trash me-2"></i>
                                                                        Hapus

                                                                    </button>

                                                                </form>

                                                            </li>

                                                        </ul>

                                                    </div>

                                                </div>

                                            </td>
                                        @else
                                            <td class="schedule-cell empty">

                                                <button type="button" class="btn btn-primary btn-sm add-schedule"
                                                    data-bs-toggle="modal" data-bs-target="#scheduleModal"
                                                    data-slot-id="{{ $slot->slt_id }}" data-day-name="{{ $dayName }}"
                                                    data-slot-number="{{ $slot->slt_number }}"
                                                    data-start="{{ \Carbon\Carbon::parse($slot->slt_start_time)->format('H:i') }}"
                                                    data-end="{{ \Carbon\Carbon::parse($slot->slt_end_time)->format('H:i') }}">

                                                    <i class="ti ti-plus"></i>

                                                </button>

                                            </td>
                                        @endif
                                    @endif
                                @endforeach

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    </div>


    <div class="modal fade" id="scheduleModal" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        Tambah Jadwal
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <form action="{{ route('administration.schedule.store') }}" method="POST">

                        @csrf

                        <input type="hidden" name="sch_slot_id" id="sch_slot_id">

                        <div class="modal-body">

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Slot
                                </label>

                                <input type="text" id="selected_slot" class="form-control" readonly>
                            </div>

                            <div class="mb-3">

                                <label for="subject_teacher_id" class="form-label fw-semibold">
                                    Mata Pelajaran / Guru
                                </label>
                                <input type="hidden" name="acy_id" value="{{ $academicYearId }}">

                                <input type="hidden" name="class_id" value="{{ $classId }}">
                                <select name="sch_subject_teacher_id" id="subject_teacher_id" class="form-select"
                                    required>


                                    <option value="">
                                        -- Pilih Pengampu --
                                    </option>

                                    @foreach ($subjectTeachers as $subjectTeacher)
                                        @php
                                            $used = $usedHours->get($subjectTeacher->subt_id, 0);
                                            $total = $subjectTeacher->subt_total_hours;
                                            $remaining = $total - $used;
                                        @endphp

                                        @if ($remaining > 0)
                                            <option value="{{ $subjectTeacher->subt_id }}">

                                                {{ $subjectTeacher->subject?->sbj_name ?? '-' }}
                                                -
                                                {{ $subjectTeacher->teacher?->user?->usr_name ?? '-' }}

                                                ({{ $used }}/{{ $total }} JP)
                                            </option>
                                        @endif
                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                Batal
                            </button>

                            <button type="submit" class="btn btn-primary">
                                Tambahkan
                            </button>

                        </div>

                    </form>

                </div>



            </div>

        </div>

    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const scheduleButtons = document.querySelectorAll('.add-schedule');

            const selectedSlot = document.getElementById('selected_slot');
            const selectedSlotId = document.getElementById('sch_slot_id');

            scheduleButtons.forEach(function(button) {

                button.addEventListener('click', function() {

                    const slotId = this.dataset.slotId;
                    const dayName = this.dataset.dayName;
                    const slotNumber = this.dataset.slotNumber;
                    const start = this.dataset.start;
                    const end = this.dataset.end;

                    selectedSlotId.value = slotId;

                    selectedSlot.value =
                        dayName +
                        ' - Jam ' +
                        slotNumber +
                        ' (' +
                        start +
                        ' - ' +
                        end +
                        ')';

                });

            });

        });
    </script>
@endpush
