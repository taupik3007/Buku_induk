@extends('administration.master')

@push('link')
@endpush

@section('title')
    SiMAPUT | Pengampu Mata Pelajaran
@endsection

@section('content')

    <div class="datatables">

        {{-- Header --}}
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-2">PENGAMPU MATA PELAJARAN</h4>

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/administration/subject"
                                       class="text-muted text-decoration-none">
                                        Mata Pelajaran
                                    </a>
                                </li>

                                <li class="breadcrumb-item" aria-current="page">
                                    Matematika
                                </li>
                            </ol>
                        </nav>
                    </div>

                    <div class="col-3">
                        <div class="text-center mb-n5">
                            <img src="{{ asset('assets/images/breadcrumb/ChatBc.png') }}"
                                 alt="modernize-img"
                                 class="img-fluid mb-n4" />
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- Informasi Mata Pelajaran --}}
        <div class="card mb-4">
            <div class="card-body">

                <div class="row align-items-center">

                    <div class="col-md-8">
                        <h4 class="fw-semibold mb-3">
                            Matematika
                        </h4>

                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <small class="text-muted d-block">
                                    Kode Mata Pelajaran
                                </small>
                                <span class="fw-semibold">
                                    RPL-10-1
                                </span>
                            </div>

                            <div class="col-md-4 mb-2">
                                <small class="text-muted d-block">
                                    Tingkatan
                                </small>
                                <span class="fw-semibold">
                                    Kelas 10
                                </span>
                            </div>

                            <div class="col-md-4 mb-2">
                                <small class="text-muted d-block">
                                    Jurusan
                                </small>
                                <span class="fw-semibold">
                                    RPL
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">
                            Tahun Ajaran
                        </label>

                        <select class="form-select">
                            <option selected>2026 / 2027</option>
                            <option>2025 / 2026</option>
                            <option>2024 / 2025</option>
                        </select>
                    </div>

                </div>

            </div>
        </div>


        {{-- Header Pengampu --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="fw-semibold mb-1">
                    Daftar Pengampu
                </h4>

                <p class="text-muted mb-0">
                    Pengampu Matematika tahun ajaran 2026 / 2027
                </p>
            </div>

            <a href="/administration/subject/7/subject-teachers/create"
               class="btn btn-primary">
                <i class="ti ti-plus me-1"></i>
                Tambah Pengampu
            </a>
        </div>


        {{-- Card Pengampu --}}
        <div class="row">

            {{-- Pengampu 1 --}}
            <div class="col-md-6 col-xl-4">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-primary-subtle text-primary">
                                Kelas X RPL 1
                            </span>

                            <div class="dropdown">
                                <button class="btn btn-sm btn-light"
                                        type="button"
                                        data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="ti ti-edit me-2"></i>
                                            Edit
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item text-danger" href="#">
                                            <i class="ti ti-trash me-2"></i>
                                            Hapus
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3">

                            <div class="rounded-circle bg-primary-subtle text-primary
                                        d-flex align-items-center justify-content-center"
                                 style="width: 50px; height: 50px;">
                                <i class="ti ti-user fs-7"></i>
                            </div>

                            <div class="ms-3">
                                <h5 class="mb-1 fw-semibold">
                                    Budi Santoso
                                </h5>

                                <span class="text-muted">
                                    Guru Mata Pelajaran
                                </span>
                            </div>

                        </div>

                        <div class="border-top pt-3">

                            <div class="d-flex justify-content-between">
                                <span class="text-muted">
                                    Mata Pelajaran
                                </span>

                                <span class="fw-semibold">
                                    Matematika
                                </span>
                            </div>

                            <div class="d-flex justify-content-between mt-2">
                                <span class="text-muted">
                                    Jumlah Jam
                                </span>

                                <span class="badge bg-success-subtle text-success">
                                    4 JP / Minggu
                                </span>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


            {{-- Pengampu 2 --}}
            <div class="col-md-6 col-xl-4">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-primary-subtle text-primary">
                                Kelas X RPL 2
                            </span>

                            <div class="dropdown">
                                <button class="btn btn-sm btn-light"
                                        type="button"
                                        data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="ti ti-edit me-2"></i>
                                            Edit
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item text-danger" href="#">
                                            <i class="ti ti-trash me-2"></i>
                                            Hapus
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3">

                            <div class="rounded-circle bg-primary-subtle text-primary
                                        d-flex align-items-center justify-content-center"
                                 style="width: 50px; height: 50px;">
                                <i class="ti ti-user fs-7"></i>
                            </div>

                            <div class="ms-3">
                                <h5 class="mb-1 fw-semibold">
                                    Siti Aminah
                                </h5>

                                <span class="text-muted">
                                    Guru Mata Pelajaran
                                </span>
                            </div>

                        </div>

                        <div class="border-top pt-3">

                            <div class="d-flex justify-content-between">
                                <span class="text-muted">
                                    Mata Pelajaran
                                </span>

                                <span class="fw-semibold">
                                    Matematika
                                </span>
                            </div>

                            <div class="d-flex justify-content-between mt-2">
                                <span class="text-muted">
                                    Jumlah Jam
                                </span>

                                <span class="badge bg-success-subtle text-success">
                                    4 JP / Minggu
                                </span>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


            {{-- Pengampu 3 --}}
            <div class="col-md-6 col-xl-4">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-primary-subtle text-primary">
                                Kelas XI RPL 1
                            </span>

                            <div class="dropdown">
                                <button class="btn btn-sm btn-light"
                                        type="button"
                                        data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="ti ti-edit me-2"></i>
                                            Edit
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item text-danger" href="#">
                                            <i class="ti ti-trash me-2"></i>
                                            Hapus
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3">

                            <div class="rounded-circle bg-primary-subtle text-primary
                                        d-flex align-items-center justify-content-center"
                                 style="width: 50px; height: 50px;">
                                <i class="ti ti-user fs-7"></i>
                            </div>

                            <div class="ms-3">
                                <h5 class="mb-1 fw-semibold">
                                    Andi Wijaya
                                </h5>

                                <span class="text-muted">
                                    Guru Mata Pelajaran
                                </span>
                            </div>

                        </div>

                        <div class="border-top pt-3">

                            <div class="d-flex justify-content-between">
                                <span class="text-muted">
                                    Mata Pelajaran
                                </span>

                                <span class="fw-semibold">
                                    Matematika
                                </span>
                            </div>

                            <div class="d-flex justify-content-between mt-2">
                                <span class="text-muted">
                                    Jumlah Jam
                                </span>

                                <span class="badge bg-success-subtle text-success">
                                    4 JP / Minggu
                                </span>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection