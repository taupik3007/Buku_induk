@extends('administration.master')

@push('link')
    <link rel="stylesheet" href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endpush

@section('title')
    SIMaput | Detail Siswa PPDB
@endsection

@section('content')
    <div class="datatables">

        {{-- Breadcrumb --}}
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Detail Pendaftar PPDB</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/administration/ppdb">PPDB</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="/administration/ppdb/{{ $student->ppd_id }}/pendaftar">Daftar Pendaftar</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Detail Siswa</li>
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

        {{-- Header Siswa --}}
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center flex-shrink-0"
                        style="width:60px;height:60px;font-size:20px;font-weight:500;color:#185FA5;">
                        {{ strtoupper(substr($student->std_name, 0, 1)) }}{{ strtoupper(substr(strrchr($student->std_name, ' ') ?: $student->std_name, 1, 1)) }}
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="fw-semibold mb-1">{{ $student->std_name }}</h5>
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            <span class="badge bg-primary-subtle text-primary">
                                No. Daftar: {{ $student->reg_number ?? '-' }}
                            </span>
                            @php
                                $statusMap = [
                                    'pending'    => ['bg-warning-subtle text-warning', 'Menunggu Verifikasi'],
                                    'verified'   => ['bg-success-subtle text-success', 'Terverifikasi'],
                                    'rejected'   => ['bg-danger-subtle text-danger', 'Ditolak'],
                                    'accepted'   => ['bg-info-subtle text-info', 'Diterima'],
                                ];
                                $statusKey   = $student->reg_status ?? 'pending';
                                [$badgeClass, $badgeLabel] = $statusMap[$statusKey] ?? ['bg-secondary-subtle text-secondary', ucfirst($statusKey)];
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ $badgeLabel }}</span>
                        </div>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="/administration/ppdb/{{ $student->ppd_id }}/pendaftar"
                            class="btn btn-outline-secondary btn-sm">
                            <i class="ti ti-arrow-left me-1"></i>Kembali
                        </a>
                        @if(($student->reg_status ?? 'pending') === 'pending')
                            <form action="/administration/ppdb-student/{{ $student->std_id }}/verify" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="ti ti-circle-check me-1"></i>Verifikasi
                                </button>
                            </form>
                            <form action="/administration/ppdb-student/{{ $student->std_id }}/reject" method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin ingin menolak pendaftaran ini?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="ti ti-x me-1"></i>Tolak
                                </button>
                            </form>
                        @endif
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
                        <td class="fw-medium">{{ $student->student->biodata->stb_gender == 1 ? 'Laki - laki' : 'Perempuan' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0">Tempat Lahir</td>
                        <td class="fw-medium">{{  $student->student->biodata->stb_birth_place ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0">Tanggal Lahir</td>
                        <td class="fw-medium">
                            {{  $student->student->biodata->stb_birth_date ? \Carbon\Carbon::parse($student->student->biodata->stb_birth_date)->translatedFormat('d F Y') : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0">Agama</td>
                        <td class="fw-medium">{{ $student->student->biodata->religion->rlg_name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0">Kewarganegaraan</td>
                        <td class="fw-medium">{{ $student->student->biodata->stb_nationality ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0">Anak ke</td>
                        <td class="fw-medium">{{ $student->student->family->fml_birth_order ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0">Jml. Saudara Kandung</td>
                        <td class="fw-medium">{{ $$student->student->family->fml_sibling ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0">Saudara Tiri</td>
                        <td class="fw-medium">{{ $student->student->family->fml_step_sibling ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0">Saudara Angkat</td>
                        <td class="fw-medium">{{ $student->student->family->fml_adoptive_sibling ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0">Status Keluarga</td>
                        <td class="fw-medium">{{ $student->std_family_status ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0">Bahasa Sehari-hari</td>
                        <td class="fw-medium">{{ $student->student->biodata->stb_language ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0">No Telepon</td>
                        <td class="fw-medium">{{ $student->std_phone ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0">Tinggal</td>
                        <td class="fw-medium">{{ $student->std_living_with ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

            {{-- Data Orang Tua / Wali --}}
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase text-muted fw-semibold mb-3" style="font-size:11px;letter-spacing:.06em;">
                            Data Orang Tua / Wali
                        </h6>
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-muted ps-0" style="width:45%">Nama Ayah</td>
                                    <td class="fw-medium">{{ $student->std_father_name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Nama Ibu</td>
                                    <td class="fw-medium">{{ $student->std_mother_name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Pekerjaan</td>
                                    <td class="fw-medium">{{ $student->std_parent_job ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">No. HP</td>
                                    <td class="fw-medium">{{ $student->std_parent_phone ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Email</td>
                                    <td class="fw-medium">{{ $student->std_parent_email ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Asal Sekolah --}}
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase text-muted fw-semibold mb-3" style="font-size:11px;letter-spacing:.06em;">
                            Asal Sekolah
                        </h6>
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-muted ps-0" style="width:45%">Nama Sekolah</td>
                                    <td class="fw-medium">{{ $student->std_school_name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">NPSN</td>
                                    <td class="fw-medium">{{ $student->std_npsn ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Kota / Kabupaten</td>
                                    <td class="fw-medium">{{ $student->std_school_city ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Tahun Lulus</td>
                                    <td class="fw-medium">{{ $student->std_graduation_year ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Status Pendaftaran --}}
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase text-muted fw-semibold mb-3" style="font-size:11px;letter-spacing:.06em;">
                            Status Pendaftaran
                        </h6>
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-muted ps-0" style="width:45%">Jalur</td>
                                    <td class="fw-medium">{{ $student->reg_path ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Tanggal Daftar</td>
                                    <td class="fw-medium">
                                        {{ $student->created_at ? \Carbon\Carbon::parse($student->created_at)->translatedFormat('d F Y, H.i') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Jarak ke Sekolah</td>
                                    <td class="fw-medium">{{ $student->reg_distance ? number_format($student->reg_distance, 1) . ' km' : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Status</td>
                                    <td><span class="badge {{ $badgeClass }}">{{ $badgeLabel }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Dokumen & Berkas --}}
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase text-muted fw-semibold mb-3" style="font-size:11px;letter-spacing:.06em;">
                            Berkas &amp; Dokumen
                        </h6>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama Dokumen</th>
                                        <th width="20%">Jenis</th>
                                        <th width="15%">Status</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($documents as $no => $doc)
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td>{{ $doc->pdr_name }}</td>
                                            <td>
                                                <span class="badge bg-secondary-subtle text-secondary">
                                                    {{ $doc->pdr_type }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($doc->file_path)
                                                    <span class="badge bg-success-subtle text-success">Diunggah</span>
                                                @else
                                                    <span class="badge bg-danger-subtle text-danger">Belum Diunggah</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($doc->file_path)
                                                    <a href="{{ asset('storage/' . $doc->file_path) }}"
                                                        target="_blank"
                                                        class="btn btn-outline-primary btn-sm">
                                                        <i class="ti ti-eye me-1"></i>Lihat
                                                    </a>
                                                @else
                                                    <span class="text-muted small">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">Tidak ada dokumen</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('script')
    {{-- Tidak ada script tambahan untuk halaman ini --}}
@endpush