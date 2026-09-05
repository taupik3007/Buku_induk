@extends('administration.master')

@section('title')
    SiMAPUT | Tambah Jam Pelajaran
@endsection

@section('content')

    <div class="datatables">

        {{-- Header --}}
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">

                <div class="row align-items-center">

                    <div class="col-9">

                        <h4 class="fw-semibold mb-2">
                            TAMBAH JAM PELAJARAN
                        </h4>

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">

                                <li class="breadcrumb-item">
                                    <a href="{{ route('administration.schedule.index') }}"
                                       class="text-muted text-decoration-none">
                                        Jadwal Pelajaran
                                    </a>
                                </li>

                                <li class="breadcrumb-item">
                                    <a href="{{ route('administration.schedule.slot.index') }}"
                                       class="text-muted text-decoration-none">
                                        Jam Pelajaran
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
                            <img src="{{ asset('assets/images/breadcrumb/ChatBc.png') }}"
                                 alt="modernize-img"
                                 class="img-fluid mb-n4">
                        </div>
                    </div>

                </div>

            </div>
        </div>


        {{-- Form --}}
        <div class="card">

            <div class="card-body">

                <h4 class="fw-semibold mb-4">
                    Data Jam
                </h4>

                <form action="{{ route('administration.schedule.slot.store') }}"
                      method="POST">

                    @csrf

                    <div class="row">

                        {{-- Hari --}}
                        <div class="col-md-6 mb-4">

                            <label for="slt_day" class="form-label fw-semibold">
                                Hari
                            </label>

                            <select name="slt_day"
                                    id="slt_day"
                                    class="form-select"
                                    required>

                                <option value="">
                                    -- Pilih Hari --
                                </option>

                                <option value="1" {{ old('slt_day') == 1 ? 'selected' : '' }}>
                                    Senin
                                </option>

                                <option value="2" {{ old('slt_day') == 2 ? 'selected' : '' }}>
                                    Selasa
                                </option>

                                <option value="3" {{ old('slt_day') == 3 ? 'selected' : '' }}>
                                    Rabu
                                </option>

                                <option value="4" {{ old('slt_day') == 4 ? 'selected' : '' }}>
                                    Kamis
                                </option>

                                <option value="5" {{ old('slt_day') == 5 ? 'selected' : '' }}>
                                    Jumat
                                </option>

                            </select>

                            @error('slt_day')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- Tipe Slot --}}
                        <div class="col-md-6 mb-4">

                            <label for="slt_type" class="form-label fw-semibold">
                                Tipe Slot
                            </label>

                            <select name="slt_type"
                                    id="slt_type"
                                    class="form-select"
                                    required>

                                <option value="lesson"
                                    {{ old('slt_type', 'lesson') === 'lesson' ? 'selected' : '' }}>
                                    Pelajaran
                                </option>

                                <option value="break"
                                    {{ old('slt_type') === 'break' ? 'selected' : '' }}>
                                    Istirahat
                                </option>

                            </select>

                            @error('slt_type')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- Nomor Jam --}}
                        <div class="col-md-6 mb-4">

                            <label for="slt_number" class="form-label fw-semibold">
                                Nomor Jam
                            </label>

                            <input type="number"
                                   name="slt_number"
                                   id="slt_number"
                                   class="form-control"
                                   min="1"
                                   value="{{ old('slt_number') }}"
                                   placeholder="Contoh: 1">

                            <small class="text-muted">
                                Nomor jam hanya digunakan untuk slot pelajaran.
                            </small>

                            @error('slt_number')
                                <small class="text-danger d-block">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- Jam Mulai --}}
                        <div class="col-md-6 mb-4">

                            <label for="slt_start_time" class="form-label fw-semibold">
                                Jam Mulai
                            </label>

                            <input type="time"
                                   name="slt_start_time"
                                   id="slt_start_time"
                                   class="form-control"
                                   value="{{ old('slt_start_time') }}"
                                   required>

                            @error('slt_start_time')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        {{-- Jam Selesai --}}
                        <div class="col-md-6 mb-4">

                            <label for="slt_end_time" class="form-label fw-semibold">
                                Jam Selesai
                            </label>

                            <input type="time"
                                   name="slt_end_time"
                                   id="slt_end_time"
                                   class="form-control"
                                   value="{{ old('slt_end_time') }}"
                                   required>

                            @error('slt_end_time')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                    </div>


                    {{-- Tombol --}}
                    <div class="d-flex justify-content-end gap-2 mt-3">

                        <a href="{{ route('administration.schedule.slot.index') }}"
                           class="btn btn-light">
                            Batal
                        </a>

                        <button type="submit"
                                class="btn btn-primary">
                            <i class="ti ti-device-floppy me-1"></i>
                            Simpan
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection


@push('script')

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const typeSelect = document.getElementById('slt_type');
        const numberInput = document.getElementById('slt_number');

        function toggleNumberInput() {

            if (typeSelect.value === 'break') {

                numberInput.value = '';
                numberInput.disabled = true;
                numberInput.removeAttribute('required');

            } else {

                numberInput.disabled = false;

            }

        }

        typeSelect.addEventListener('change', toggleNumberInput);

        toggleNumberInput();

    });
</script>

@endpush