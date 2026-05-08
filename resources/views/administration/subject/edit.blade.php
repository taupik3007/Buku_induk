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

            <form action="" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="sbj_name" class="form-label">Nama Mata Pelajaran</label>
                    <input type="text" class="form-control" value="{{$edit_subject->sbj_name}}" id="sbj_name" name="sbj_name" placeholder="Contoh: Matematika">
                </div>

                <div class="mb-3">
                    <label for="sbj_code" class="form-label">Kode Mata Pelajaran</label>
                    <input type="text" class="form-control" value="{{$edit_subject->sbj_code}}" id="sbj_code" name="sbj_code" placeholder="Contoh: MTK">
                </div>

                <div class="mb-3">
                    <label for="exampleInputText1" class="form-label">Tingkatan</label>
                    {{-- <div class="col-sm-9"> --}}
                        <select class="form-select mr-sm-2" name="sbj_level"
                            oninvalid="this.setCustomValidity('Tingkatan Wajib Diisi')"
                            onchange="this.setCustomValidity('')" required>
                            <option selected value="" >Pilih Level/Tingkatan...</option>
                            <option value="10" {{ $edit_subject->sbj_level == '10' ? 'selected' : '' }}>X</option>
                            <option value="11" {{ $edit_subject->sbj_level == '11' ? 'selected' : '' }}>XI</option>
                            <option value="12" {{ $edit_subject->sbj_level == '12' ? 'selected' : '' }}>XII</option>
                        </select>
                    {{-- </div> --}}
                    @error('sbj_level')
                        <div>error</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputText1" class="form-label">Jurusan</label>
                    {{-- <div class="col-sm-9"> --}}
                        <select class="form-select mr-sm-2"  name="sbj_major_id"
                            oninvalid="this.setCustomValidity('Jurusan wajib diisi')"
                            onchange="this.setCustomValidity('')" required>
                            <option selected value="">Pilih Jurusan...</option>
                            @foreach ($majors as $major)
                                <option value="{{ $major->mjr_id }}" {{ $edit_subject->sbj_major_id == $major->mjr_id ? 'selected' : '' }}>
                                    {{ $major->mjr_abbr }} - {{ $major->mjr_name }}</option>
                            @endforeach
                        </select>
                    {{-- </div> --}}
                    @error('sbj_major_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="/administration/subject" class="btn btn-secondary">Batal</a>
                </div>

            </form>
        </div>
    </div>
@endsection