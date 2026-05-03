@extends('administration.master')

@section('title')
    SIMaput | Detail Guru
@endsection

@section('content')
    <div class="datatables">

        {{-- Breadcrumb --}}
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Detail Guru</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/administration/teachers">Daftar Guru</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Detail Guru</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3">
                        <div class="text-center mb-n5">
                            <img src="{{ asset('assets/images/breadcrumb/ChatBc.png') }}" alt="modernize-img"
                                class="img-fluid mb-n4" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Header Guru --}}
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center flex-shrink-0"
                        style="width:60px;height:60px;font-size:20px;font-weight:500;color:#185FA5;">
                        BU
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="fw-semibold mb-1">Budi Santoso, S.Pd</h5>
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            <span class="badge bg-primary-subtle text-primary">
                                NIP: 198504152010011005
                            </span>
                            <span class="badge bg-success-subtle text-success">Aktif</span>
                        </div>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="/administration/teachers" class="btn btn-outline-secondary btn-sm">
                            <i class="ti ti-arrow-left me-1"></i>Kembali
                        </a>
                        <a href="/administration/teachers/1/edit" class="btn btn-primary btn-sm">
                            <i class="ti ti-edit me-1"></i>Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            {{-- Data Pribadi --}}
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase text-muted fw-semibold mb-3"
                            style="font-size:11px;letter-spacing:.06em;">
                            Data Pribadi
                        </h6>
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-muted ps-0" style="width:45%">Jenis Kelamin</td>
                                    <td class="fw-medium">Laki - laki</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Tempat Lahir</td>
                                    <td class="fw-medium">Ngawi</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Tanggal Lahir</td>
                                    <td class="fw-medium">15 April 1985</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Agama</td>
                                    <td class="fw-medium">Islam</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Kewarganegaraan</td>
                                    <td class="fw-medium">WNI</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">No Telepon</td>
                                    <td class="fw-medium">081234567890</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Email</td>
                                    <td class="fw-medium">budi.santoso@sekolah.sch.id</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Data Alamat --}}
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase text-muted fw-semibold mb-3"
                            style="font-size:11px;letter-spacing:.06em;">
                            Data Alamat
                        </h6>
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-muted ps-0" style="width:45%">Provinsi</td>
                                    <td class="fw-medium">Jawa Timur</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Kabupaten/Kota</td>
                                    <td class="fw-medium">Kabupaten Ngawi</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Kecamatan</td>
                                    <td class="fw-medium">Ngawi</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Desa</td>
                                    <td class="fw-medium">Margomulyo</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Kode POS</td>
                                    <td class="fw-medium">63211</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Alamat Lengkap</td>
                                    <td class="fw-medium">Jl. Pahlawan No. 12 RT 02 RW 03</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Data Kepegawaian --}}
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase text-muted fw-semibold mb-3"
                            style="font-size:11px;letter-spacing:.06em;">
                            Data Kepegawaian
                        </h6>
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-muted ps-0" style="width:45%">NIP</td>
                                    <td class="fw-medium">198504152010011005</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Status Kepegawaian</td>
                                    <td class="fw-medium">PNS</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Golongan</td>
                                    <td class="fw-medium">III/b</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">TMT</td>
                                    <td class="fw-medium">01 Januari 2010</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Jurusan / Bidang</td>
                                    <td class="fw-medium">Teknik Komputer dan Jaringan</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Mata Pelajaran</td>
                                    <td class="fw-medium">Pemrograman Dasar</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Pendidikan Terakhir --}}
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase text-muted fw-semibold mb-3"
                            style="font-size:11px;letter-spacing:.06em;">
                            Pendidikan Terakhir
                        </h6>
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-muted ps-0" style="width:45%">Jenjang</td>
                                    <td class="fw-medium">S1</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Nama Institusi</td>
                                    <td class="fw-medium">Universitas Negeri Surabaya</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Jurusan</td>
                                    <td class="fw-medium">Pendidikan Teknik Informatika</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Tahun Lulus</td>
                                    <td class="fw-medium">2008</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('script')
    {{-- Tidak ada script tambahan untuk halaman ini --}}
@endpush