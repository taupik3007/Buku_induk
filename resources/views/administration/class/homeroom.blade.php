@extends('administration.master')

@section('title')
    SiMAPUT | Pilih Wali Kelas
@endsection

@section('content')

<div class="card">
    <div class="card-body">

        <h4 class="card-title mb-4">
            Pilih Wali Kelas
        </h4>

        <form action="" method="POST">
            @csrf

            <div class="mb-4">
                <label for="teacher_id" class="form-label">
                    Guru Wali Kelas
                </label>

                <select name="teacher_id"
                        id="teacher_id"
                        class="form-select"
                        required>

                    <option value="" selected disabled>
                        -- Pilih Guru --
                    </option>

                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->usr_id }}">
                            {{ $teacher->usr_name }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ url()->previous() }}"
                   class="btn btn-light">
                    Kembali
                </a>

                <button type="submit"
                        class="btn btn-primary">
                    Simpan Wali Kelas
                </button>
            </div>

        </form>

    </div>
</div>

@endsection