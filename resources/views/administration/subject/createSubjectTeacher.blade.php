@extends('administration.master')

@section('title')
    SiMAPUT | Tambah Pengampu
@endsection
@push('link')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="datatables">

        {{-- Header --}}
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">

                    <div class="col-9">
                        <h4 class="fw-semibold mb-2">
                            TAMBAH PENGAMPU
                        </h4>

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">

                                <li class="breadcrumb-item">
                                    <a href="/administration/subject" class="text-muted text-decoration-none">
                                        Mata Pelajaran
                                    </a>
                                </li>

                                <li class="breadcrumb-item">
                                    <a href="#" class="text-muted text-decoration-none">
                                        Pengampu
                                    </a>
                                </li>

                                <li class="breadcrumb-item" aria-current="page">
                                    Tambah
                                </li>

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


        {{-- Informasi Mata Pelajaran --}}
        <div class="card mb-4">
            <div class="card-body">

                <h4 class="fw-semibold mb-3">
                    {{ $subject->sbj_name }}
                </h4>

                <div class="row">

                    <div class="col-md-4">
                        <small class="text-muted d-block">
                            Nama Mata Pelajaran
                        </small>

                        <h5 class="mb-0">
                            {{ $subject->sbj_name }}
                        </h5>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted d-block">
                            Kode
                        </small>

                        <h5 class="mb-0">
                            {{ $subject->sbj_code }}
                        </h5>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted d-block">
                            Tingkatan
                        </small>

                        <h5 class="mb-0">
                            Kelas {{ $subject->sbj_level }}
                        </h5>
                    </div>

                </div>

            </div>
        </div>


        {{-- Form --}}
        <div class="card">

            <div class="card-body">

                <h4 class="fw-semibold mb-4">
                    Data Pengampu
                </h4>

                <form action="{{ route('administration.subject.subjectTeacher.store', $subject->sbj_id) }}" method="POST">

                    @csrf

                    <div class="row">

                        {{-- Guru --}}
                        <div class="col-md-6 mb-4">
                            <label for="teacher" class="form-label fw-semibold">
                                Guru Pengampu
                            </label>

                            <select name="teacher_id" id="teacher" class="form-select" required>
                                <option value="">-- Pilih Guru --</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->tcr_id }}"
                                        {{ old('teacher_id') == $teacher->tcr_id ? 'selected' : '' }}>
                                        {{ $teacher->user?->usr_name ?? '-' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Kelas --}}
                        <div class="col-md-6 mb-4">
                            <label for="class" class="form-label fw-semibold">
                                Kelas
                            </label>

                            <select name="class_id[]" id="class" class="form-select" multiple required>

                                @foreach ($classes as $class)
                                    <option value="{{ $class->cls_id }}"
                                        {{ in_array($class->cls_id, old('class_id', [])) ? 'selected' : '' }}>
                                        {{ $class->cls_level }}
                                        {{ $class->cls_major?->mjr_abbr ?? '' }}
                                        {{ $class->cls_number }}
                                    </option>
                                @endforeach

                            </select>

                            @error('class_id')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        {{-- Jumlah Jam --}}
                        <div class="col-md-6 mb-4">
                            <label for="total_hours" class="form-label fw-semibold">
                                Jumlah Jam Pelajaran
                            </label>

                            <div class="input-group">
                                <input type="number" name="total_hours" id="total_hours" class="form-control"
                                    min="2" max="20" placeholder="Contoh: 4" required>

                                <span class="input-group-text">
                                    JP / Minggu
                                </span>
                            </div>

                            <small class="text-muted">
                                Masukkan jumlah JP mata pelajaran dalam satu minggu.
                            </small>
                        </div>

                    </div>


                    {{-- Tombol --}}
                    <div class="d-flex justify-content-end gap-2 mt-3">

                        <a href="#" class="btn btn-light">
                            Batal
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-device-floppy me-1"></i>
                            Simpan Pengampu
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('#class').select2({
            placeholder: 'Pilih Kelas',
            width: '100%',
            closeOnSelect: false
        });
    </script>
@endpush
