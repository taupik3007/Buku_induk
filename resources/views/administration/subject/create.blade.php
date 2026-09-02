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

            <form action="" method="POST">
    @csrf
    @method('PATCH')

    <div class="mb-3">
        <label for="teacher_id" class="form-label">Wali Kelas</label>

        <select name="teacher_id" id="teacher_id" class="form-select" required>
            <option value="">-- Pilih Guru --</option>

            @foreach ($teachers as $teacher)
                <option value="{{ $teacher->usr_id }}"
                    {{ $class->cls_homeroom_teacher_id == $teacher->usr_id ? 'selected' : '' }}>
                    {{ $teacher->usr_name }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">
        Simpan
    </button>
</form>
        </div>
    </div>

    

@endsection
