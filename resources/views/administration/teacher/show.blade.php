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
                            <span class="badge bg-info-subtle text-primary">
                                GTK : {{ $teacher->tcr_gtk }}
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
                                    <td class="text-muted ps-0" style="width:45%">NUPTK</td>
                                    <td class="fw-medium">{{ $teacher->tcr_nuptk ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">NIK</td>
                                    {{-- <td class="fw-medium">{{ $guru->nik ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Tempat Lahir</td>
                                    <td class="fw-medium">{{ $teacher->teacherBio->tcb_birth_place ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Tanggal Lahir</td>
                                    <td class="fw-medium">
                                        {{ $teacher->teacherBio->tcb_birth_date
                                            ? \Carbon\Carbon::parse($teacher->teacherBio->tcb_birth_date)->locale('id')->translatedFormat('d F Y')
                                            : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Jenis Kelamin</td>
                                    <td class="fw-medium">
                                        {{ $teacher->teacherBio->tcb_gender == 1 ? 'Laki-laki' : ($teacher->teacherBio->tcb_gender == 2 ? 'Perempuan' : '-') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Agama</td>
                                    <td class="fw-medium">{{ $teacher->teacherBio->religion->rlg_name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Status Nikah</td>
                                    <td class="fw-medium">
                                        {{ $teacher->teacherBio->tcb_mary_status == 1 ? 'Sudah Menikah' : 'Belum Menikah' }}
                                    </td>
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
                                    <td class="text-muted ps-0" style="width:45%">Alamat</td>
                                    <td class="fw-medium">{{ $teacher->user->address->adr_detail ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Desa / Kelurahan</td>
                                    <td class="fw-medium">{{ $teacher->user->address->adr_village_value ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Kecamatan</td>
                                    <td class="fw-medium">{{ $teacher->user->address->adr_district_value ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Kabupaten</td>
                                    <td class="fw-medium">{{ $teacher->user->address->adr_regency_value ?? '-' }}</td>

                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Provinsi</td>
                                    <td class="fw-medium">{{ $teacher->user->address->adr_province_value ?? '-' }}</td>

                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Kode Pos</td>
                                    <td class="fw-medium">{{ $teacher->user->address->adr_postal_code ?? '-' }}</td>

                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">No. Telp / HP</td>
                                    <td class="fw-medium">{{ $teacher->teacherBio->tcb_telp ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Email</td>
                                    <td class="fw-medium">{{ $teacher->user->email ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Data Pasangan --}}
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase text-muted fw-semibold mb-3"
                            style="font-size:11px;letter-spacing:.06em;">
                            Data Pasangan
                        </h6>
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-muted ps-0" style="width:45%">Nama Suami / Isteri</td>
                                    {{-- <td class="fw-medium">{{ $guru->nama_pasangan ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">NIK</td>
                                    {{-- <td class="fw-medium">{{ $guru->nik_pasangan ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Pekerjaan</td>
                                    {{-- <td class="fw-medium">{{ $guru->pekerjaan_pasangan ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">NIP</td>
                                    {{-- <td class="fw-medium">{{ $guru->nip_pasangan ?? '-' }}</td> --}}
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase text-muted fw-semibold mb-3"
                            style="font-size:11px;letter-spacing:.06em;">
                            Status Kepegawaian
                        </h6>
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-muted ps-0" style="width:45%">TMT</td>
                                    {{-- <td class="fw-medium">
                                        {{ $guru->tmt ? \Carbon\Carbon::parse($guru->tmt)->translatedFormat('d F Y') : '-' }}
                                    </td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">No. SK</td>
                                    {{-- <td class="fw-medium">{{ $guru->no_sk ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Durasi</td>
                                    {{-- <td class="fw-medium">{{ $guru->durasi ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Masa Kerja</td>
                                    {{-- <td class="fw-medium">{{ $guru->masa_kerja ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Status</td>
                                    {{-- <td class="fw-medium">{{ $guru->status ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Jabatan</td>
                                    {{-- <td class="fw-medium">{{ $guru->jabatan ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Inpassing</td>
                                    {{-- <td class="fw-medium">{{ $guru->inpassing ?? '-' }}</td> --}}
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase text-muted fw-semibold mb-3"
                            style="font-size:11px;letter-spacing:.06em;">
                            Data Mengajar
                        </h6>
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-muted ps-0" style="width:45%">Mata Pelajaran</td>
                                    {{-- <td class="fw-medium">{{ $guru->mata_pelajaran ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Tingkat / Kelas</td>
                                    {{-- <td class="fw-medium">{{ $guru->tingkat_kelas ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Tahun Pelajaran</td>
                                    {{-- <td class="fw-medium">{{ $guru->tahun_pelajaran ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Jml JP/Mng</td>
                                    {{-- <td class="fw-medium">{{ $guru->jml_jp ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Tugas Tambahan</td>
                                    {{-- <td class="fw-medium">{{ $guru->tugas_tambahan ?? '-' }}</td> --}}
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase text-muted fw-semibold mb-3"
                            style="font-size:11px;letter-spacing:.06em;">
                            Riwayat Mengajar
                        </h6>
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-muted ps-0" style="width:45%">Mata Pelajaran</td>
                                    {{-- <td class="fw-medium">{{ $guru->mata_pelajaran ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Nama Sekolah</td>
                                    {{-- <td class="fw-medium">{{ $guru->nama_sekolah ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Kelas / Tingkat</td>
                                    {{-- <td class="fw-medium">{{ $guru->kelas_tingkat ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Jml JP/Minggu</td>
                                    {{-- <td class="fw-medium">{{ $guru->jml_jp_minggu ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Dari Tahun / Sampai</td>
                                    <td class="fw-medium">
                                        {{-- {{ $guru->dari_tahun ?? '-' }} / {{ $guru->sampai_tahun ?? '-' }} --}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Status</td>
                                    {{-- <td class="fw-medium">{{ $guru->status ?? '-' }}</td> --}}
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase text-muted fw-semibold mb-3"
                            style="font-size:11px;letter-spacing:.06em;">
                            Riwayat Pendidikan
                        </h6>
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-muted ps-0" style="width:45%">SD / Sederajat</td>
                                    {{-- <td class="fw-medium">{{ $guru->sd ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Tahun Lulus SD</td>
                                    {{-- <td class="fw-medium">{{ $guru->thn_sd ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">SMP / Sederajat</td>
                                    {{-- <td class="fw-medium">{{ $guru->smp ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Tahun Lulus SMP</td>
                                    {{-- <td class="fw-medium">{{ $guru->thn_smp ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">SMA / Sederajat</td>
                                    {{-- <td class="fw-medium">{{ $guru->sma ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Tahun Lulus SMA</td>
                                    {{-- <td class="fw-medium">{{ $guru->thn_sma ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Nama Perguruan Tinggi</td>
                                    {{-- <td class="fw-medium">{{ $guru->perguruan_tinggi ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Fakultas</td>
                                    {{-- <td class="fw-medium">{{ $guru->fakultas ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Jurusan</td>
                                    {{-- <td class="fw-medium">{{ $guru->jurusan ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Tahun Lulus</td>
                                    {{-- <td class="fw-medium">{{ $guru->thn_lulus ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Gelar</td>
                                    {{-- <td class="fw-medium">{{ $guru->gelar ?? '-' }}</td> --}}
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase text-muted fw-semibold mb-3"
                            style="font-size:11px;letter-spacing:.06em;">
                            Sertifikasi
                        </h6>
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-muted ps-0" style="width:45%">Sudah / Belum</td>
                                    {{-- <td class="fw-medium">{{ $guru->sertifikasi ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Tahun</td>
                                    {{-- <td class="fw-medium">{{ $guru->thn_sertifikasi ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">No. Sertifikat</td>
                                    {{-- <td class="fw-medium">{{ $guru->no_sertifikat ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Kode Bidang Studi</td>
                                    {{-- <td class="fw-medium">{{ $guru->kode_bidang_studi ?? '-' }}</td> --}}
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Penyelenggara</td>
                                    {{-- <td class="fw-medium">{{ $guru->penyelenggara ?? '-' }}</td> --}}
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
