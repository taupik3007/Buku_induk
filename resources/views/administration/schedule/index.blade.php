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
                    <div class="col-md-4 mb-3 mb-md-0">

                        <label for="academic_year"
                               class="form-label fw-semibold">
                            Tahun Ajaran
                        </label>

                        <select id="academic_year"
                                class="form-select">

                            <option selected>
                                2026 / 2027
                            </option>

                            <option>
                                2025 / 2026
                            </option>

                            <option>
                                2024 / 2025
                            </option>

                        </select>

                    </div>


                    {{-- Kelas --}}
                    <div class="col-md-4 mb-3 mb-md-0">

                        <label for="class"
                               class="form-label fw-semibold">
                            Kelas
                        </label>

                        <select id="class"
                                class="form-select">

                            <option selected>
                                X RPL 1
                            </option>

                            <option>
                                X RPL 2
                            </option>

                            <option>
                                X RPL 3
                            </option>

                            <option>
                                XI RPL 1
                            </option>

                            <option>
                                XI RPL 2
                            </option>

                        </select>

                    </div>


                    {{-- Button --}}
                    <div class="col-md-4">

                        <div class="d-flex gap-2">

                            <button type="button"
                                    class="btn btn-primary">

                                <i class="ti ti-wand me-1"></i>
                                Generate Jadwal

                            </button>

                            <button type="button"
                                    class="btn btn-light">

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

            <div class="d-flex gap-2">

                <span class="badge bg-success-subtle text-success">
                    Jadwal Tersedia
                </span>

                <button type="button"
                        class="btn btn-outline-primary btn-sm">

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


                            {{-- Jam 1 --}}
                            <tr>

                                <td>
                                    <span class="fw-semibold">
                                        Jam 1
                                    </span>

                                    <br>

                                    <span class="text-muted time">
                                        07:00 - 07:45
                                    </span>
                                </td>

                                <td>

                                    <div class="subject-name">
                                        Matematika
                                    </div>

                                    <div class="text-muted teacher-name">
                                        Budi Santoso
                                    </div>

                                </td>

                                <td>

                                    <div class="subject-name">
                                        Bahasa Inggris
                                    </div>

                                    <div class="text-muted teacher-name">
                                        Siti Aminah
                                    </div>

                                </td>

                                <td>

                                    <div class="subject-name">
                                        Pendidikan Agama
                                    </div>

                                    <div class="text-muted teacher-name">
                                        Andi Wijaya
                                    </div>

                                </td>

                                <td>

                                    <div class="subject-name">
                                        Produktif RPL
                                    </div>

                                    <div class="text-muted teacher-name">
                                        Budi Santoso
                                    </div>

                                </td>

                                <td>

                                    <div class="subject-name">
                                        Bahasa Indonesia
                                    </div>

                                    <div class="text-muted teacher-name">
                                        Siti Aminah
                                    </div>

                                </td>

                            </tr>


                            {{-- Jam 2 --}}
                            <tr>

                                <td>
                                    <span class="fw-semibold">
                                        Jam 2
                                    </span>

                                    <br>

                                    <span class="text-muted time">
                                        07:45 - 08:30
                                    </span>
                                </td>

                                <td>

                                    <div class="subject-name">
                                        Matematika
                                    </div>

                                    <div class="text-muted teacher-name">
                                        Budi Santoso
                                    </div>

                                </td>

                                <td>

                                    <div class="subject-name">
                                        Bahasa Inggris
                                    </div>

                                    <div class="text-muted teacher-name">
                                        Siti Aminah
                                    </div>

                                </td>

                                <td>

                                    <div class="subject-name">
                                        Pendidikan Agama
                                    </div>

                                    <div class="text-muted teacher-name">
                                        Andi Wijaya
                                    </div>

                                </td>

                                <td>

                                    <div class="subject-name">
                                        Produktif RPL
                                    </div>

                                    <div class="text-muted teacher-name">
                                        Budi Santoso
                                    </div>

                                </td>

                                <td>

                                    <div class="subject-name">
                                        Bahasa Indonesia
                                    </div>

                                    <div class="text-muted teacher-name">
                                        Siti Aminah
                                    </div>

                                </td>

                            </tr>


                            {{-- Jam 3 --}}
                            <tr>

                                <td>

                                    <span class="fw-semibold">
                                        Jam 3
                                    </span>

                                    <br>

                                    <span class="text-muted time">
                                        08:30 - 09:15
                                    </span>

                                </td>

                                <td>

                                    <div class="subject-name">
                                        IPA
                                    </div>

                                    <div class="text-muted teacher-name">
                                        Andi Wijaya
                                    </div>

                                </td>

                                <td>

                                    <div class="subject-name">
                                        Matematika
                                    </div>

                                    <div class="text-muted teacher-name">
                                        Budi Santoso
                                    </div>

                                </td>

                                <td>

                                    <div class="subject-name">
                                        Produktif RPL
                                    </div>

                                    <div class="text-muted teacher-name">
                                        Siti Aminah
                                    </div>

                                </td>

                                <td>

                                    <div class="subject-name">
                                        Bahasa Inggris
                                    </div>

                                    <div class="text-muted teacher-name">
                                        Andi Wijaya
                                    </div>

                                </td>

                                <td>

                                    <div class="subject-name">
                                        IPA
                                    </div>

                                    <div class="text-muted teacher-name">
                                        Budi Santoso
                                    </div>

                                </td>

                            </tr>


                            {{-- Istirahat --}}
                            <tr class="break-row">

                                <td>

                                    <span class="fw-semibold text-muted">
                                        Istirahat
                                    </span>

                                    <br>

                                    <span class="text-muted time">
                                        09:15 - 09:30
                                    </span>

                                </td>

                                <td colspan="5"
                                    class="bg-light">

                                    <span class="fw-semibold text-muted">
                                        ISTIRAHAT
                                    </span>

                                </td>

                            </tr>


                            {{-- Jam 4 --}}
                            <tr>

                                <td>

                                    <span class="fw-semibold">
                                        Jam 4
                                    </span>

                                    <br>

                                    <span class="text-muted time">
                                        09:30 - 10:15
                                    </span>

                                </td>

                                <td>

                                    <div class="subject-name">
                                        IPA
                                    </div>

                                    <div class="text-muted teacher-name">
                                        Andi Wijaya
                                    </div>

                                </td>

                                <td>

                                    <div class="subject-name">
                                        Matematika
                                    </div>

                                    <div class="text-muted teacher-name">
                                        Budi Santoso
                                    </div>

                                </td>

                                <td>

                                    <div class="subject-name">
                                        Produktif RPL
                                    </div>

                                    <div class="text-muted teacher-name">
                                        Siti Aminah
                                    </div>

                                </td>

                                <td>

                                    <div class="subject-name">
                                        Bahasa Inggris
                                    </div>

                                    <div class="text-muted teacher-name">
                                        Andi Wijaya
                                    </div>

                                </td>

                                <td>

                                    <div class="subject-name">
                                        IPA
                                    </div>

                                    <div class="text-muted teacher-name">
                                        Budi Santoso
                                    </div>

                                </td>

                            </tr>


                            {{-- Jam 5 --}}
                            <tr>

                                <td>

                                    <span class="fw-semibold">
                                        Jam 5
                                    </span>

                                    <br>

                                    <span class="text-muted time">
                                        10:15 - 11:00
                                    </span>

                                </td>

                                <td>

                                    <div class="subject-name">
                                        Bahasa Indonesia
                                    </div>

                                    <div class="text-muted teacher-name">
                                        Siti Aminah
                                    </div>

                                </td>

                                <td>

                                    <div class="subject-name">
                                        IPA
                                    </div>

                                    <div class="text-muted teacher-name">
                                        Andi Wijaya
                                    </div>

                                </td>

                                <td>

                                    <div class="subject-name">
                                        Matematika
                                    </div>

                                    <div class="text-muted teacher-name">
                                        Budi Santoso
                                    </div>

                                </td>

                                <td>

                                    <div class="subject-name">
                                        Produktif RPL
                                    </div>

                                    <div class="text-muted teacher-name">
                                        Budi Santoso
                                    </div>

                                </td>

                                <td>

                                    <div class="subject-name">
                                        Pendidikan Agama
                                    </div>

                                    <div class="text-muted teacher-name">
                                        Andi Wijaya
                                    </div>

                                </td>

                            </tr>


                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection