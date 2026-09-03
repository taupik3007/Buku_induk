@extends('administration.master')

@section('title')
    SiMAPUT | Tambah Mata Pelajaran
@endsection

@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">MATA PELAJARAN</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="/administration/subjects">Daftar Mata
                                    Pelajaran</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Mata Pelajaran</li>
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

    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Tambah Mata Pelajaran</h4>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('administration.subject.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="sbj_name" class="form-label">Nama Mata Pelajaran</label>
                    <input type="text" name="sbj_name" id="sbj_name" class="form-control"
                        placeholder="Contoh: Pemrograman Web" required>
                </div>

                <div class="mb-3">
                    <label for="sbj_level" class="form-label">Tingkat Kelas</label>
                    <select name="sbj_level" id="sbj_level" class="form-select" required>
                        <option value="">-- Pilih Tingkat --</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="sbj_major_id" class="form-label">Jurusan</label>
                    <select name="sbj_major_id" id="sbj_major_id" class="form-select" required>
                        <option value="">-- Pilih Jurusan --</option>
                        @foreach ($majors as $major)
                            <option value="{{ $major->mjr_id }}">{{ $major->mjr_abbr }}</option>
                        @endforeach
                        <option value="">Normatif</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
            </form>
        </div>
    </div>
@endsection
