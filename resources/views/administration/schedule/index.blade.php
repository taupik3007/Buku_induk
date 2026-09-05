@extends('administration.master')

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

                <div class="row align-items-end">

                    {{-- Tahun Ajaran --}}
                    <div class="col-md-4 mb-3 mb-md-0">
                        <label for="academic_year" class="form-label fw-semibold">
                            Tahun Ajaran
                        </label>

                        <select id="academic_year" class="form-select">
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
                        <label for="class" class="form-label fw-semibold">
                            Kelas
                        </label>

                        <select id="class" class="form-select">

                            <option selected>
                                X RPL 1
                            </option>

                            <option>
                                X RPL 2
                            </option>

                            <option>
                                XI RPL 1
                            </option>

                            <option>
                                XI RPL 2
                            </option>

                        </select>
                    </div>


                    {{-- Tombol --}}
                    <div class="col-md-4">
                        <div class="d-flex gap-2">

                            <button type="button" class="btn btn-primary">
                                <i class="ti ti-wand me-1"></i>
                                Generate Jadwal
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


        {{-- Informasi Jadwal --}}
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


        {{-- Tabel Jadwal --}}
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered text-center align-middle">

                        <thead>
                            <tr>

                                <th style="min-width: 140px;">
                                    Jam
                                </th>

                                <th style="min-width: 200px;">
                                    Senin
                                </th>

                                <th style="min-width: 200px;">
                                    Selasa
                                </th>

                                <th style="min-width: 200px;">
                                    Rabu
                                </th>

                                <th style="min-width: 200px;">
                                    Kamis
                                </th>

                                <th style="min-width: 200px;">
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

                                    <small class="text-muted">
                                        07:00 - 07:45
                                    </small>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        Matematika
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        Budi Santoso
                                    </small>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        Bahasa Inggris
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        Siti Aminah
                                    </small>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        Pendidikan Agama
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        Andi Wijaya
                                    </small>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        Produktif RPL
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        Budi Santoso
                                    </small>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        Bahasa Indonesia
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        Siti Aminah
                                    </small>
                                </td>

                            </tr>


                            {{-- Jam 2 --}}
                            <tr>

                                <td>
                                    <span class="fw-semibold">
                                        Jam 2
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        07:45 - 08:30
                                    </small>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        Matematika
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        Budi Santoso
                                    </small>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        Bahasa Inggris
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        Siti Aminah
                                    </small>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        Pendidikan Agama
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        Andi Wijaya
                                    </small>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        Produktif RPL
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        Budi Santoso
                                    </small>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        Bahasa Indonesia
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        Siti Aminah
                                    </small>
                                </td>

                            </tr>


                            {{-- Jam 3 --}}
                            <tr>

                                <td>
                                    <span class="fw-semibold">
                                        Jam 3
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        08:30 - 09:15
                                    </small>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        IPA
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        Andi Wijaya
                                    </small>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        Matematika
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        Budi Santoso
                                    </small>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        Produktif RPL
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        Siti Aminah
                                    </small>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        Bahasa Inggris
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        Andi Wijaya
                                    </small>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        IPA
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        Budi Santoso
                                    </small>
                                </td>

                            </tr>


                            {{-- Istirahat --}}
                            <tr>

                                <td>
                                    <span class="fw-semibold text-muted">
                                        Istirahat
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        09:15 - 09:30
                                    </small>
                                </td>

                                <td colspan="5" class="bg-light">

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

                                    <small class="text-muted">
                                        09:30 - 10:15
                                    </small>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        IPA
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        Andi Wijaya
                                    </small>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        Matematika
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        Budi Santoso
                                    </small>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        Produktif RPL
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        Siti Aminah
                                    </small>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        Bahasa Inggris
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        Andi Wijaya
                                    </small>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        IPA
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        Budi Santoso
                                    </small>
                                </td>

                            </tr>


                            {{-- Jam 5 --}}
                            <tr>

                                <td>
                                    <span class="fw-semibold">
                                        Jam 5
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        10:15 - 11:00
                                    </small>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        Bahasa Indonesia
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        Siti Aminah
                                    </small>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        IPA
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        Andi Wijaya
                                    </small>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        Matematika
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        Budi Santoso
                                    </small>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        Produktif RPL
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        Budi Santoso
                                    </small>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        Pendidikan Agama
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        Andi Wijaya
                                    </small>
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>
        </div>

    </div>
@endsection
