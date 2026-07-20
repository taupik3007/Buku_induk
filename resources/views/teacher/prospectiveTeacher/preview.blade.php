@extends('teacher.master')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="fw-bold">
            <i class="ti ti-file-text"></i>
            Data Lamaran Guru
        </h3>

        <a href="{{ route('teacher.prospectiveTeacher.cv.download', ['type' => 'creative', 'preview' => 1]) }}"
            target="_blank"
            class="btn btn-primary">
             Preview Creative
         </a>
         
        <a href=""
           class="btn btn-danger">

            <i class="ti ti-download"></i>
            Download PDF

        </a>

    </div>

    {{-- HEADER --}}
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <div class="row align-items-center">

                <div class="col-md-2 text-center">

                    @if($teacher->teacherBio?->tcb_photo)

                        <img
                            src="{{ asset('storage/'.$teacher->teacherBio->tcb_photo) }}"
                            class="rounded-circle border"
                            width="150"
                            height="150"
                            style="object-fit:cover;">

                    @else

                        <img
                        src="{{ Auth::user()?->usr_photo
                            ? asset('storage/'.Auth::user()->usr_photo)
                            : asset('assets/images/profile/user-1.jpg') }}"
                            class="rounded-circle border"
                            width="150">

                    @endif

                </div>

                <div class="col-md-10">

                    <h2 class="fw-bold">
                        {{ $teacher->user->usr_name }}
                    </h2>

                    <table class="table table-borderless">

                        <tr>
                            <th width="180">Email</th>
                            <td>{{ $teacher->user->email }}</td>
                        </tr>

                        <tr>
                            <th>No HP</th>
                            <td>{{ $teacher->teacherBio->tcb_telp }}</td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>

                                <span class="badge bg-warning">

                                    {{ ucfirst($teacher->teacherBio->tcb_status) }}

                                </span>

                            </td>
                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>


    {{-- BIODATA --}}
    <div class="card shadow-sm mb-4">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">

                <i class="ti ti-user"></i>

                Biodata

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6">

                    <table class="table">

                        <tr>
                            <th>Nama</th>
                            <td> {{ $teacher->user->usr_name }}</td>
                        </tr>

                        <tr>
                            <th>Tempat Lahir</th>
                            <td>{{ $teacher->teacherBio->tcb_birth_place }}</td>
                        </tr>

                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>{{ $teacher->teacherBio->tcb_birth_date }}</td>
                        </tr>

                        <tr>
                            <th>Jenis Kelamin</th>
                            <td> {{ $teacher->teacherBio->tcb_gender == 1 ? 'Laki-Laki' : 'Perempuan' }}</td>
                        </tr>

                    </table>

                </div>

                <div class="col-md-6">

                    <table class="table">

                        <tr>
                            <th>Agama</th>
                            <td>{{ $teacher->teacherBio->tcb_religion }}</td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>{{ $teacher->teacherBio->tcb_mary_status == 1 ? 'Sudah Menikah' : 'Belum Menikah' }}</td>
                        </tr>

                        <tr>
                            <th>Alamat</th>
                            <td><p>
                                {{ $teacher->teacherAddress->tca_detail }},
                                Kel. {{ $teacher->teacherAddress->tca_village_value }},
                                Kec. {{ $teacher->teacherAddress->tca_district_value }},
                                {{ $teacher->teacherAddress->tca_regency_value }},
                                {{ $teacher->teacherAddress->tca_province_value }},
                                {{ $teacher->teacherAddress->tca_postalcode }}
                                </p></td>
                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>


    {{-- RIWAYAT PENDIDIKAN --}}
    <div class="card shadow-sm mb-4">

        <div class="card-header bg-success text-white">

            <h5 class="mb-0">

                <i class="ti ti-school"></i>

                Riwayat Pendidikan

            </h5>

        </div>

        <div class="card-body">

            @forelse($teacher->teacherEducation as $edu)
        
                <div class="border rounded p-3 mb-3">
        
                    <h5 class="text-success fw-bold">
                        {{ $edu->tce_level }} - {{ $edu->tce_institution }}
                    </h5>
        
                    <div class="row">

                        <div class="col-md-4">
                            <strong>Jurusan</strong>
                            <br>
                            {{ $edu->tce_major }}
                        </div>
                    
                        <div class="col-md-4">
                            <strong>Tahun Lulus</strong>
                            <br>
                            {{ $edu->tce_graduation_year }}
                        </div>
                    
                        @if(!in_array($edu->tce_level, ['SMA', 'SMK']))
                            <div class="col-md-4">
                                <strong>Gelar</strong>
                                <br>
                                {{ $edu->tce_degree }}
                            </div>
                        @endif
                    
                    </div>
                </div>
        
            @empty
        
                <div class="alert alert-warning">
                    Belum ada data pendidikan.
                </div>
        
            @endforelse
        
        </div>

    </div>


    {{-- RIWAYAT MENGAJAR --}}
    <div class="card shadow-sm mb-5">

        <div class="card-header bg-info text-white">

            <h5 class="mb-0">

                <i class="ti ti-book"></i>

                Riwayat Mengajar

            </h5>

        </div>

        <div class="card-body">

            @forelse($teacher->teachHistories as $history)

                <div class="border rounded p-3 mb-3">

                    <h5 class="fw-bold text-info">

                        {{ $history->tcs_subject_name }}

                    </h5>

                    <div class="row">

                        <div class="col-md-3">

                            <strong>Sekolah</strong>

                            <br>

                            {{ $history->tcs_name_school }}

                        </div>

                        <div class="col-md-2">

                            <strong>Kelas</strong>

                            <br>

                            {{ $history->tcs_class }}

                        </div>

                        <div class="col-md-2">

                            <strong>JP</strong>

                            <br>

                            {{ $history->tcs_jp }}

                        </div>

                        <div class="col-md-2">

                            <strong>Tahun</strong>

                            <br>

                            {{ $history->tcs_year }}

                        </div>

                        <div class="col-md-3">

                            <strong>Status</strong>

                            <br>

                            @if($history->tcs_status=='aktif')

                                <span class="badge bg-success">

                                    Aktif

                                </span>

                            @else

                                <span class="badge bg-secondary">

                                    Non Aktif

                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            @empty

                <div class="alert alert-warning">

                    Belum ada riwayat mengajar.

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection