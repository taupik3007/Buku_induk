<div id="step-1" class="content">

    {{-- Jenis Kelamin --}}
    <div class="mb-3">
        <label class="form-label">Jenis Kelamin</label>
        <select name="stb_gender" class="form-select" required>
            <option value="">Pilih ..</option>
            <option value="1">Laki - laki</option>
            <option value="2">Perempuan</option>
        </select>
    </div>

    {{-- Tempat Lahir --}}
    <div class="mb-3">
        <label class="form-label">Tempat Lahir</label>
        <input type="text" name="stb_birth_place" class="form-control" required>
    </div>

    {{-- Tanggal Lahir --}}
    <div class="mb-3">
        <label class="form-label">Tanggal Lahir</label>
        <input type="date" name="stb_birth_date" class="form-control" required>
    </div>

    {{-- Agama --}}
    <div class="mb-3">
        <label class="form-label">Agama</label>
        <select name="stb_religion_id" class="form-select" required>
            <option value="">Pilih ..</option>
            @foreach ($religion as $rlg)
                <option value="{{ $rlg->rlg_id }}">
                    {{ $rlg->rlg_name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Kewarganegaraan --}}
    <div class="mb-3">
        <label class="form-label">Kewarganegaraan</label>
        <select name="stb_nationality" class="form-select" required>
            <option value="">Pilih ..</option>
            <option value="WNI">WNI</option>
            <option value="WNA">WNA</option>
        </select>
    </div>

    {{-- Data Saudara --}}
    <div class="row">
        <div class="col-md-3">
            <div class="mb-3">
                <label class="form-label">Anak ke</label>
                <input type="number" name="fml_birth_order" class="form-control" required>
            </div>
        </div>

        <div class="col-md-3">
            <div class="mb-3">
                <label class="form-label">Jumlah Saudara Kandung</label>
                <input type="number" name="fml_sibling" class="form-control" required>
            </div>
        </div>

        <div class="col-md-3">
            <div class="mb-3">
                <label class="form-label">Saudara Tiri</label>
                <input type="number" name="fml_step_sibling" class="form-control">
            </div>
        </div>

        <div class="col-md-3">
            <div class="mb-3">
                <label class="form-label">Saudara Angkat</label>
                <input type="number" name="fml_adoptive_sibling" class="form-control">
            </div>
        </div>
    </div>

    {{-- Status Keluarga --}}
    <div class="mb-3">
        <label class="form-label">Status Keluarga</label>
        <select name="fml_status" class="form-select" required>
            <option value="">Pilih ..</option>
            <option value="1">Lengkap</option>
            <option value="2">Tidak Lengkap</option>
        </select>
    </div>

    {{-- Bahasa --}}
    <div class="mb-3">
        <label class="form-label">Bahasa Sehari-hari</label>
        <input type="text" name="stb_language" class="form-control" required>
    </div>

    {{-- Telepon --}}
    <div class="mb-3">
        <label class="form-label">No Telepon</label>
        <input type="text" name="stb_telp" class="form-control" required>
    </div>

    {{-- Tinggal --}}
    <div class="mb-3">
        <label class="form-label">Tinggal</label>
        <select name="stb_living_with" class="form-select" required>
            <option value="">Pilih ..</option>
            <option value="1">Bersama Orangtua</option>
            <option value="2">Tidak Dengan Orangtua</option>
        </select>
    </div>

    <button type="button" class="btn btn-primary" onclick="stepOne()">
        Lanjut
    </button>

</div>
