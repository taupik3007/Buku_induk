@extends('administration.master')

@push('link')
    <link rel="stylesheet" href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
@endpush

@section('title')
    SiMAPUT | Pengaturan Jam Pelajaran
@endsection

@section('content')

    <div class="datatables">

        {{-- Header --}}
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">

                <div class="row align-items-center">

                    <div class="col-9">

                        <h4 class="fw-semibold mb-2">
                            PENGATURAN JAM PELAJARAN
                        </h4>

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">

                                <li class="breadcrumb-item">
                                    <a href="{{ route('administration.schedule.index') }}"
                                       class="text-muted text-decoration-none">
                                        Jadwal Pelajaran
                                    </a>
                                </li>

                                <li class="breadcrumb-item" aria-current="page">
                                    Jam Pelajaran
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


        {{-- Table --}}
        <div class="card">

            <div class="card-body">

                <div class="mb-5 position-relative">

                    <h4 class="card-title mb-0">
                        Daftar Jam Pelajaran
                    </h4>

                    <a href="{{ route('administration.schedule.slot.create') }}"
                       class="btn btn-primary position-absolute top-0 end-0">

                        <i class="ti ti-plus me-1"></i>
                        Tambah Jam

                    </a>

                </div>


                <div class="table-responsive">

                    <table id="file_export"
                           class="table w-100 table-striped table-bordered display text-nowrap">

                        <thead>

                            <tr>
                                <th width="8%">No</th>
                                <th>Hari</th>
                                <th width="12%">Jam Ke</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Tipe</th>
                                <th width="12%">Aksi</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($scheduleSlots as $no => $slot)

                                <tr>

                                    <td>
                                        {{ $no + 1 }}
                                    </td>

                                    <td>

                                        @php
                                            $days = [
                                                1 => 'Senin',
                                                2 => 'Selasa',
                                                3 => 'Rabu',
                                                4 => 'Kamis',
                                                5 => 'Jumat',
                                            ];
                                        @endphp

                                        {{ $days[$slot->slt_day] ?? '-' }}

                                    </td>

                                    <td>
                                        {{ $slot->slt_number ?? '-' }}
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($slot->slt_start_time)->format('H:i') }}
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($slot->slt_end_time)->format('H:i') }}
                                    </td>

                                    <td>

                                        @if ($slot->slt_type === 'lesson')

                                            <span class="badge bg-primary-subtle text-primary">
                                                Pelajaran
                                            </span>

                                        @elseif ($slot->slt_type === 'break')

                                            <span class="badge bg-warning-subtle text-warning">
                                                Istirahat
                                            </span>

                                        @else

                                            <span class="badge bg-secondary-subtle text-secondary">
                                                {{ $slot->slt_type }}
                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        <div class="d-flex gap-1">

                                            <a href="#"
                                               class="btn btn-primary btn-sm">
                                                <i class="ti ti-edit"></i>
                                            </a>

                                            <a href="#"
                                               class="btn btn-danger btn-sm">
                                                <i class="ti ti-trash"></i>
                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                        <tfoot>

                            <tr>
                                <th>No</th>
                                <th>Hari</th>
                                <th>Jam Ke</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Tipe</th>
                                <th>Aksi</th>
                            </tr>

                        </tfoot>

                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection


@push('script')

    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>

    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <script src="{{ asset('assets/js/datatable/datatable-advanced.init.js') }}"></script>

@endpush