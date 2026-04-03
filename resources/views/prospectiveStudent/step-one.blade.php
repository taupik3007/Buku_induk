<div id="step-1" class="content">

    {{-- Jenis Kelamin --}}
    <div class="mb-3">
        <label class="form-label">Jenis Kelamin</label>
        <select name="stb_gender" class="form-select" required>
            <option value="">Pilih ..</option>
            <option value="1" {{ old('stb_gender', $biodata->stb_gender ?? '') == 1 ? 'selected' : '' }}>
                Laki - laki
            </option>

            <option value="2" {{ old('stb_gender', $biodata->stb_gender ?? '') == 2 ? 'selected' : '' }}>
                Perempuan
            </option>
        </select>
    </div>

    {{-- Tempat Lahir --}}
    <div class="mb-3">
        <label class="form-label">Tempat Lahir</label>
        <input type="text" name="stb_birth_place" class="form-control"
            value="{{ old('stb_birth_place', $biodata->stb_birth_place ?? '') }}" required>
    </div>

    {{-- Tanggal Lahir --}}
    <div class="mb-3">
        <label class="form-label">Tanggal Lahir</label>
        <input type="date" name="stb_birth_date" class="form-control"
            value="{{ old('stb_birth_date', $biodata->stb_birth_date ?? '') }}" required>
    </div>

    {{-- Agama --}}
    @php
        $selectedReligion = old('stb_religion_id', $biodata->stb_religion_id ?? '');
    @endphp
    <div class="mb-3">
        <label class="form-label">Agama</label>
        <select name="stb_religion_id" class="form-select" required>
            <option value="">Pilih ..</option>

            @foreach ($religion as $rlg)
                <option value="{{ $rlg->rlg_id }}" {{ $selectedReligion == $rlg->rlg_id ? 'selected' : '' }}>
                    {{ $rlg->rlg_name }}
                </option>
            @endforeach

        </select>
    </div>

    {{-- Kewarganegaraan --}}
    <div class="mb-3">
        <label class="form-label">Kewarganegaraan</label>
        @php
            $nationality = old('stb_nationality', $biodata->stb_nationality ?? '');
        @endphp

        <select name="stb_nationality" class="form-select" required>
            <option value="">Pilih ..</option>
            <option value="WNI" {{ $nationality === 'WNI' ? 'selected' : '' }}>WNI</option>
            <option value="WNA" {{ $nationality === 'WNA' ? 'selected' : '' }}>WNA</option>
        </select>
    </div>

    {{-- Data Saudara --}}
    <div class="row">
        <div class="col-md-3">
            <div class="mb-3">
                <label class="form-label">Anak ke</label>
                <input type="number" name="fml_birth_order" class="form-control" required
                    value="{{ old('fml_birth_order', $family->fml_birth_order ?? '') }}">
            </div>
        </div>

        <div class="col-md-3">
            <div class="mb-3">
                <label class="form-label">Jumlah Saudara Kandung</label>
                <input type="number" name="fml_sibling" class="form-control" required
                    value="{{ old('fml_sibling', $family->fml_sibling ?? '') }}">
            </div>
        </div>

        <div class="col-md-3">
            <div class="mb-3">
                <label class="form-label">Saudara Tiri</label>
                <input type="number" name="fml_step_sibling" class="form-control"
                    value="{{ old('fml_step_sibling', $family->fml_step_sibling ?? '') }}">
            </div>
        </div>

        <div class="col-md-3">
            <div class="mb-3">
                <label class="form-label">Saudara Angkat</label>
                <input type="number" name="fml_adoptive_sibling" class="form-control"
                    value="{{ old('fml_adoptive_sibling', $family->fml_adoptive_sibling ?? '') }}">
            </div>
        </div>
    </div>


    {{-- Status Keluarga --}}
    <div class="mb-3">
        <label class="form-label">Status Keluarga</label>

        @php
            $status = old('fml_status', $family->fml_status ?? '');
        @endphp

        <select name="fml_status" class="form-select" required>
            <option value="">Pilih ..</option>

            <option value="0" {{ (string) $status === '0' ? 'selected' : '' }}>
                Lengkap
            </option>

            <option value="1" {{ (string) $status === '1' ? 'selected' : '' }}>
                Yatim
            </option>

            <option value="2" {{ (string) $status === '2' ? 'selected' : '' }}>
                Piatu
            </option>

            <option value="3" {{ (string) $status === '3' ? 'selected' : '' }}>
                Yatim Piatu
            </option>

            <option value="4" {{ (string) $status === '4' ? 'selected' : '' }}>
                Cerai
            </option>
        </select>
    </div>


    {{-- Bahasa --}}
    <div class="mb-3">
        <label class="form-label">Bahasa Sehari-hari</label>
        <input type="text" name="stb_language" class="form-control"
            value="{{ old('stb_language', $biodata->stb_language ?? '') }}" required>
    </div>

    {{-- Telepon --}}
    <div class="mb-3">
        <label class="form-label">No Telepon</label>
        <input type="text" name="stb_telp" class="form-control"
            value="{{ old('stb_telp', $biodata->stb_telp ?? '') }}" required>
    </div>

    {{-- Tinggal --}}
    <div class="mb-3">
        <label class="form-label">Tinggal</label>
        @php
            $living = old('stb_living_with', $biodata->stb_living_with ?? '');
        @endphp

        <select name="stb_living_with" class="form-select" required>
            <option value="">Pilih ..</option>

            <option value="1" {{ (string) $living === '1' ? 'selected' : '' }}>
                Bersama Orangtua
            </option>

            <option value="2" {{ (string) $living === '2' ? 'selected' : '' }}>
                Tinggal bersama Ayah
            </option>

            <option value="3" {{ (string) $living === '3' ? 'selected' : '' }}>
                Tinggal bersama Ibu
            </option>

            <option value="4" {{ (string) $living === '4' ? 'selected' : '' }}>
                Tinggal bersama Wali
            </option>

            <option value="5" {{ (string) $living === '5' ? 'selected' : '' }}>
                Tinggal Sendiri
            </option>

        </select>
    </div>

    <div class="d-flex justify-content-between mt-4">
        {{-- <button type="button" class="btn btn-secondary" onclick="stepper.previous()">
            Kembali
        </button> --}}

        <button type="button" class="btn btn-primary" onclick="stepOne()">
            Lanjut
        </button>
    </div>

</div>

<script>
    function stepOne() {
    let form = document.querySelector('#step-1').closest('form');
    let formData = new FormData(form);

    fetch("{{ route('prospectiveStudent.register.stepOne') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: res.message,
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    stepper.next();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: res.message,
                });
            }
        })
        .catch(err => {
            console.error(err);
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: 'Periksa Kembali Inputan',
            });
        });
}
</script>
