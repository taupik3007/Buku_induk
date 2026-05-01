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
                                <a class="text-muted text-decoration-none" href="/administration/subjects">Daftar Mata Pelajaran</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Mata Pelajaran</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('assets/images/breadcrumb/ChatBc.png') }}" alt="modernize-img" class="img-fluid mb-n4" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Tambah Mata Pelajaran</h4>

            <form action="/administration/subjects" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="sbj_name" class="form-label">Nama Mata Pelajaran</label>
                    <input type="text" class="form-control" id="sbj_name" name="sbj_name" placeholder="Contoh: Matematika">
                </div>

                <div class="mb-3">
                    <label for="sbj_code" class="form-label">Kode Mata Pelajaran</label>
                    <input type="text" class="form-control" id="sbj_code" name="sbj_code" placeholder="Contoh: MTK">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="/administration/subjects" class="btn btn-secondary">Batal</a>
                </div>

            </form>
        </div>
    </div>
@endsection