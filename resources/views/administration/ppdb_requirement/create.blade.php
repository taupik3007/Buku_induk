@extends('administration.master')

@section('title')
    SIMaput | Tambah Persyaratan PPDB
@endsection

@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Tambah Persyaratan PPDB</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/administration/ppdb-requirement">Daftar Persyaratan</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
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
            <h4 class="card-title mb-4">Form Tambah Persyaratan</h4>

            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="" method="POST">
                @csrf

                {{-- Hidden PPDB ID --}}
                <input type="hidden" name="pdr_ppdb_id" value="{{ $ppdb->ppd_id }}">

                <div class="mb-4">
                    <label class="form-label fw-semibold">Nama Persyaratan <span class="text-danger">*</span></label>
                    <input type="text" name="pdr_name" class="form-control @error('pdr_name') is-invalid @enderror"
                        placeholder="Contoh: Akta Kelahiran, Kartu Keluarga..."
                        value="{{ old('pdr_name') }}">
                    @error('pdr_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Jenis Inputan <span class="text-danger">*</span></label>
                    <select name="pdr_type" class="form-select @error('pdr_type') is-invalid @enderror">
                        <option value="" disabled selected>-- Pilih Jenis --</option>
                        <option value="text" {{ old('pdr_type') == 'text' ? 'selected' : '' }}>Text</option>
                        <option value="file" {{ old('pdr_type') == 'file' ? 'selected' : '' }}>File Upload</option>
                        <option value="number" {{ old('pdr_type') == 'number' ? 'selected' : '' }}>Angka</option>
                        <option value="date" {{ old('pdr_type') == 'date' ? 'selected' : '' }}>Tanggal</option>
                    </select>
                    @error('pdr_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="/administration/ppdb-requirement/0" class="btn btn-outline-secondary">Batal</a>
                </div>

            </form>
        </div>
    </div>
@endsection