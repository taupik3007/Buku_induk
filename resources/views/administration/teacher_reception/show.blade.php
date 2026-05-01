@extends('administration.master')

@push('link')
    <link rel="stylesheet" href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endpush

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
                        <h4 class="fw-semibold mb-8">Detail Pendaftar Calon Guru</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/administration/ppdb">PPDB</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="/administration/ppdb/{{ $teacher->usr_id }}/pendaftar">Daftar Pendaftar</a>
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
                        {{-- {{ strtoupper(substr($teacher->user->usr_name, 0, 1)) }}{{ strtoupper(substr(strrchr($teacher->user->usr_name, ' ') ?: $teacher->user->usr_name, 1, 1)) }} --}}
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="fw-semibold mb-1">{{ $teacher->teacherBio->tcb_user_name ?? '-' }}</h5>
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            <span class="badge bg-primary-subtle text-primary">
                                No. Daftar: {{--  {{ $teacher->user->usr_name ?? '-' }} --}}
                            </span>
                            @php
                                $statusMap = [
                                    'pending'    => ['bg-warning-subtle text-warning', 'Menunggu Verifikasi'],
                                    'verified'   => ['bg-success-subtle text-success', 'Terverifikasi'],
                                    'rejected'   => ['bg-danger-subtle text-danger', 'Ditolak'],
                                    'accepted'   => ['bg-info-subtle text-info', 'Diterima'],
                                ];
                                // $statusKey   = $student->reg_status ?? 'pending';
                                // [$badgeClass, $badgeLabel] = $statusMap[$statusKey] ?? ['bg-secondary-subtle text-secondary', ucfirst($statusKey)];
                            @endphp
                            {{-- <span class="badge {{ $badgeClass }}">{{ $badgeLabel }}</span> --}}
                        </div>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href=""
                            class="btn btn-outline-secondary btn-sm">
                            <i class="ti ti-arrow-left me-1"></i>Kembali
                        </a>
                        <form action="{{ route('administration.teacherReception.accept', $teacher->usr_id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button class="btn btn-success btn-sm">Terima</button>
                        </form>
                        <a href="/administration/teacher-reception/{{ $teacher->usr_id}}/reject" class="btn btn-danger btn-sm"  onclick="confirmDelete('{{ $teacher->usr_name }}')">Tolak</a>
                        {{-- @if(($student->reg_status ?? 'pending') === 'pending')
                            <form action="" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="ti ti-circle-check me-1"></i>Terima
                                </button>
                            </form>
                            <form action="" method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin ingin menolak pendaftaran ini?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="ti ti-x me-1"></i>Tolak
                                </button>
                            </form>
                        @endif --}}
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
                        <td class="fw-medium">{{ $teacher->teacherBio->tcb_user_name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0">Tempat Lahir</td>
                        <td class="fw-medium">{{ $teacher->teacherBio->tcb_birth_place ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0">Tanggal Lahir</td>
                        <td class="fw-medium">
                            {{  $teacher->teacherBio->tcb_birth_date ? \Carbon\Carbon::parse($teacher->teacherBio->tcb_birth_date)->translatedFormat('d F Y') : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0">Agama</td>
                        <td class="fw-medium">{{ $teacher->teacherBio->tcb_religion ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0">Status Pernikahan</td>
                        <td class="fw-medium">{{ $teacher->teacherBio->tcb_mary_status  == 1 ? 'Menikah' : 'Belum Menikah' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0">No Telepon</td>
                        <td class="fw-medium">(+62) {{ $teacher->teacherBio->tcb_telp ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
  {{-- Alamat--}}
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase text-muted fw-semibold mb-3" style="font-size:11px;letter-spacing:.06em;">
                            Data Alamat
                        </h6>
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-muted ps-0" style="width:45%">Provinsi</td>
                                    <td class="fw-medium">{{ $teacher->teacherBio->address->tca_province_value ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Kabupaten/Kota</td>
                                    <td class="fw-medium">{{ $teacher->teacherBio->address->tca_regency_value ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Kecamatan</td>
                                    <td class="fw-medium">{{ $teacher->teacherBio->address->tca_district_value ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Desa</td>
                                    <td class="fw-medium">{{ $teacher->teacherBio->address->tca_village_value ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Kode POS</td>
                                    <td class="fw-medium">{{ $teacher->teacherBio->address->tca_postalcode ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Jarak Rumah ke Sekolah(km)</td>
                                    <td class="fw-medium">{{ $teacher->teacherBio->address->tca_distance ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Alamat Lengkap</td>
                                    <td class="fw-medium">{{ $teacher->teacherBio->address->tca_detail ?? '' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase text-muted fw-semibold mb-3" style="font-size:11px;letter-spacing:.06em;">
                            Riwayat Pendidikan
                        </h6>
                        @foreach($teacher->teacherBio->education as $edu)
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="fw-bold" style="width:45%">{{ $edu->tce_level }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Nama Institusi</td>
                                    <td class="fw-medium">{{ $edu->tce_institution }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Tahun Lulus</td>
                                    <td class="fw-medium">{{ $edu->tce_graduation_year }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Jurusan</td>
                                    <td class="fw-medium">{{ $edu->tce_major }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Gelar</td>
                                    <td class="fw-medium">{{ $edu->tce_degree ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                        @endforeach
                    </div>
                </div>
            </div>
           
            {{-- Data Orang Tua / Wali --}}
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase text-muted fw-semibold mb-3" style="font-size:11px;letter-spacing:.06em;">
                            Riwayat Mengajar
                        </h6>
                        @foreach( $teacher->teacherBio->history as $history)
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-muted ps-0" style="width:45%">Nama Mata Pelajaran</td>
                                    <td class="fw-medium">{{ $history->tcs_subject_name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Nama Sekolah</td>
                                    <td class="fw-medium">{{ $history->tcs_name_school ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Kelas</td>
                                    <td class="fw-medium">{{ $history->tcs_class ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Jam Pelajaran</td>
                                    <td class="fw-medium">{{ $history->tcs_jp ?? '' }} Jam</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Tahun</td>
                                    <td class="fw-medium">{{ $history->tcs_year ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Status Mengajar</td>
                                    <td class="fw-medium">{{ $history->tcs_status ?? '' }}</td>
                                </tr>
                            </tbody>
                        </table>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase text-muted fw-semibold mb-3" style="font-size:11px;letter-spacing:.06em;">
                            Pasangan
                        </h6>
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-muted ps-0" style="width:45%">Nama</td>
                                    <td class="fw-medium">{{ $teacher->teacherBio->partner->tcp_name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">NIK</td>
                                    <td class="fw-medium">{{ $teacher->teacherBio->partner->tcp_nik ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Pekerjaan</td>
                                    <td class="fw-medium">{{ $teacher->teacherBio->partner->tcp_work ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">NIP</td>
                                    <td class="fw-medium">{{ $teacher->teacherBio->partner->tcp_nip ?? '-' }}</td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase text-muted fw-semibold mb-3" style="font-size:11px;letter-spacing:.06em;">
                            Status Pendaftaran
                        </h6>
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-muted ps-0">Tanggal Daftar</td>
                                    <td class="fw-medium">
                                        {{ $teacher->created_at ? \Carbon\Carbon::parse($teacher->created_at)->translatedFormat('d F Y, H.i') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted ps-0">Status Pendaftaran</td>
                                    <td class="fw-medium">
                                        @if($teacher->usr_status == 0)
                                        Pending
                                    @elseif($teacher->usr_status == 1)
                                        Diterima
                                    @elseif($teacher->usr_status == 2)
                                        Ditolak
                                    @endif
                                    </td>
                                </tr>
                                {{-- <tr>
                                    <td class="text-muted ps-0">Status</td>
                                    <td></td>
                                </tr> --}}
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
<script>
    document.addEventListener("DOMContentLoaded", async function () {
    
        const provinceId = "{{ $teacher->teacherBio->address->tca_province ?? '' }}";
    
        let el = document.getElementById("provinsiText");

        if (!provinceId) return;
    
        let provinces = await fetch("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")
            .then(res => res.json());
    
        let province = provinces.find(p => p.id == provinceId);
    
        if (province) {
            document.getElementById("provinsiText").innerText = province.name;
        }
    
    });
    </script>
    {{-- Tidak ada script tambahan untuk halaman ini --}}
@endpush