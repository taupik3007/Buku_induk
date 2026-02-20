<div id="step-5" class="content">

    <div class="mb-3">
        <label class="form-label">Nama Ibu</label>
        <input type="text" name="fml_mother_name" class="form-control"
            value="{{ old('fml_mother_name', $family->fml_mother_name ?? '') }}"
            placeholder="Nama lengkap ibu">
    </div>

    <div class="mb-3">
        @php
            $selectedReligion = old('fml_mother_religion_id', $family->fml_mother_religion_id ?? '');
        @endphp
        <label class="form-label">Agama</label>
        <select name="fml_mother_religion_id" class="form-select" required>
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
        <input type="text" name="fml_mother_nationality"
            value="{{ old('fml_mother_nationality', $family->fml_mother_nationality ?? '') }}"
            class="form-control" placeholder="Contoh: Indonesia">
    </div>

    <div class="mb-3">
        <label class="form-label">Pekerjaan</label>
        <input type="text" name="fml_mother_occupation" class="form-control"
            value="{{ old('fml_mother_occupation', $family->fml_mother_occupation ?? '') }}"
            placeholder="Pekerjaan">
    </div>

    <div class="mb-3">
        <label class="form-label">Pendidikan Terakhir</label>
        <input type="text" name="fml_mother_education" class="form-control"
            value="{{ old('fml_mother_education', $family->fml_mother_education ?? '') }}"
            placeholder="Pendidikan terakhir">
    </div>

    <div class="mb-3">
        <label class="form-label">Penghasilan per Bulan (Rp)</label>
        @php
            $selectedIncome = old('fml_mother_income', $family->fml_mother_income ?? '');
        @endphp
        <select name="fml_mother_income" class="form-select" required>
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
        <textarea name="fml_mother_address" class="form-control" rows="3"
            placeholder="Alamat lengkap">{{ old('fml_mother_address', $family->fml_mother_address ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Nomor Telepon</label>
        <input type="number" name="fml_mother_phone"
            value="{{ old('fml_mother_phone', $family->fml_mother_phone ?? '') }}"
            class="form-control" placeholder="08xxxxxxxxxx">
    </div>

    <div class="d-flex justify-content-between mt-4">
        <button type="button" class="btn btn-secondary" onclick="stepper.previous()">
            Kembali
        </button>

        <button type="button" class="btn btn-primary" onclick="stepFive()">
            Lanjut
        </button>
    </div>

</div>
<script>
function stepFive() {

    let formData = {
        fml_mother_name: $('[name="fml_mother_name"]').val(),
        fml_mother_religion_id: $('[name="fml_mother_religion_id"]').val(),
        fml_mother_nationality: $('[name="fml_mother_nationality"]').val(),
        fml_mother_education: $('[name="fml_mother_education"]').val(),
        fml_mother_occupation: $('[name="fml_mother_occupation"]').val(),
        fml_mother_income: $('[name="fml_mother_income"]').val(),
        fml_mother_address: $('[name="fml_mother_address"]').val(),
        fml_mother_phone: $('[name="fml_mother_phone"]').val(),
        _token: '{{ csrf_token() }}'
    };

    $.ajax({
        url: "{{ route('prospectiveStudent.register.stepFive') }}",
        type: "POST",
        data: formData,

        success: function(response) {

            if (response.status) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message,
                    timer: 1500,
                    showConfirmButton: false
                });

                setTimeout(() => {
                    stepper.next();
                }, 1500);
            }
        },

        error: function(xhr) {

            if (xhr.status === 422) {

                let errors = xhr.responseJSON.errors;
                let message = '';

                $.each(errors, function(key, value){
                    message += value[0] + '<br>';
                });

                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    html: message,
                    timer: 2500,
                    showConfirmButton: false
                });

            } else {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan server.',
                    timer: 2000,
                    showConfirmButton: false
                });

            }
        }
    });
}
</script>