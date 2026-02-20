<div id="step-6" class="content">

    <div class="mb-3">
        <label class="form-label">Nama Wali</label>
        <input type="text" name="fml_guardian_name" class="form-control"
            value="{{ old('fml_guardian_name', $family->fml_guardian_name ?? '') }}"
            placeholder="Nama lengkap wali">
    </div>

    <div class="mb-3">
        @php
            $selectedReligion = old('fml_guardian_religion_id', $family->fml_guardian_religion_id ?? '');
        @endphp
        <label class="form-label">Agama</label>
        <select name="fml_guardian_religion_id" class="form-select">
            <option value="">Pilih ..</option>
            @foreach ($religion as $rlg)
                <option value="{{ $rlg->rlg_id }}" {{ $selectedReligion == $rlg->rlg_id ? 'selected' : '' }}>
                    {{ $rlg->rlg_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Kewarganegaraan</label>
        <input type="text" name="fml_guardian_nationality"
            value="{{ old('fml_guardian_nationality', $family->fml_guardian_nationality ?? '') }}"
            class="form-control" placeholder="Contoh: Indonesia">
    </div>

    <div class="mb-3">
        <label class="form-label">Pekerjaan</label>
        <input type="text" name="fml_guardian_occupation" class="form-control"
            value="{{ old('fml_guardian_occupation', $family->fml_guardian_occupation ?? '') }}"
            placeholder="Pekerjaan">
    </div>

    <div class="mb-3">
        <label class="form-label">Pendidikan Terakhir</label>
        <input type="text" name="fml_guardian_education" class="form-control"
            value="{{ old('fml_guardian_education', $family->fml_guardian_education ?? '') }}"
            placeholder="Pendidikan terakhir">
    </div>

    <div class="mb-3">
        <label class="form-label">Penghasilan per Bulan (Rp)</label>
        @php
            $selectedIncome = old('fml_guardian_income', $family->fml_guardian_income ?? '');
        @endphp
        <select name="fml_guardian_income" class="form-select">
            <option value="">-- Pilih Rentang Penghasilan --</option>
            <option value="1" {{ $selectedIncome == 1 ? 'selected' : '' }}>< Rp 1.000.000</option>
            <option value="2" {{ $selectedIncome == 2 ? 'selected' : '' }}>Rp 1.000.000 - Rp 3.000.000</option>
            <option value="3" {{ $selectedIncome == 3 ? 'selected' : '' }}>Rp 3.000.000 - Rp 5.000.000</option>
            <option value="4" {{ $selectedIncome == 4 ? 'selected' : '' }}>Rp 5.000.000 - Rp 10.000.000</option>
            <option value="5" {{ $selectedIncome == 5 ? 'selected' : '' }}>> Rp 10.000.000</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea name="fml_guardian_address" class="form-control" rows="3"
            placeholder="Alamat lengkap">{{ old('fml_guardian_address', $family->fml_guardian_address ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Nomor Telepon</label>
        <input type="number" name="fml_guardian_phone"
            value="{{ old('fml_guardian_phone', $family->fml_guardian_phone ?? '') }}"
            class="form-control" placeholder="08xxxxxxxxxx">
    </div>

    <div class="d-flex justify-content-between mt-4">
        <button type="button" class="btn btn-secondary" onclick="stepper.previous()">
            Kembali
        </button>

        <button type="button" class="btn btn-primary" onclick="stepSix()">
            Lanjut
        </button>
    </div>

</div>

<script>
function stepSix() {

    let formData = {
        fml_guardian_name: $('[name="fml_guardian_name"]').val(),
        fml_guardian_religion_id: $('[name="fml_guardian_religion_id"]').val(),
        fml_guardian_nationality: $('[name="fml_guardian_nationality"]').val(),
        fml_guardian_education: $('[name="fml_guardian_education"]').val(),
        fml_guardian_occupation: $('[name="fml_guardian_occupation"]').val(),
        fml_guardian_income: $('[name="fml_guardian_income"]').val(),
        fml_guardian_address: $('[name="fml_guardian_address"]').val(),
        fml_guardian_phone: $('[name="fml_guardian_phone"]').val(),
        _token: '{{ csrf_token() }}'
    };

    $.ajax({
        url: "{{ route('prospectiveStudent.register.stepSix') }}",
        type: "POST",
        data: formData,
        success: function(response) {

            if (response.status) {
                alert(response.message);
                stepper.next();
            }
        },
        error: function(xhr) {

            if (xhr.status === 422) {
                alert('Validasi gagal. Cek kembali inputan.');
            } else {
                alert('Terjadi kesalahan server.');
            }
        }
    });
}
</script>
