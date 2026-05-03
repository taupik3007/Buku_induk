<div id="step-4" class="content">

    <div class="mb-3">
        <label class="form-label">Nama Ayah</label>
        <input type="text" name="fml_father_name" class="form-control"  value="{{ old('fml_father_name', $family->fml_father_name ?? '') }}" placeholder="Nama lengkap ayah">
    </div>
    <div class="mb-3">
        @php
        $selectedReligion = old('fml_father_religion_id', $family->fml_father_religion_id ?? '');
    @endphp
        <label class="form-label">Agama</label>
        <select name="fml_father_religion_id" class="form-select" required>
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
        @php
            $fathernationality = old('fml_father_nationality', $family->fml_father_nationality ?? '');
        @endphp

        <select name="fml_father_nationality" class="form-select" required>
            <option value="">Pilih ..</option>
            <option value="WNI" {{ $fathernationality === 'WNI' ? 'selected' : '' }}>WNI</option>
            <option value="WNA" {{ $fathernationality === 'WNA' ? 'selected' : '' }}>WNA</option>
        </select>
    </div>

    {{-- <div class="mb-3">
        <label class="form-label">Kewarganegaraan</label>
        <input type="text" name="fml_father_nationality" value="{{ old('fml_father_nationality', $family->fml_father_nationality ?? '') }}" class="form-control" placeholder="Contoh: Indonesia">
    </div> --}}

    <div class="mb-3">
        <label class="form-label">Pekerjaan </label>
        <input type="text" name="fml_father_occupation" class="form-control" value="{{ old('fml_father_occupation', $family->fml_father_occupation ?? '') }}" placeholder="Pekerjaan">
    </div>
    {{-- <div class="mb-3">
        <label class="form-label">Pendidikan Terakhir</label>
        <input type="text" name="fml_father_education" class="form-control" value="{{ old('fml_father_education', $family->fml_father_education ?? '') }}" placeholder="Pendidikan terakhir">
    </div> --}}
    <div class="mb-3">
        <label class="form-label">Pendidikan Terakhir</label>
        @php
            $fathereducation = old('fml_father_education', $family->fml_father_education ?? '');
        @endphp

        <select name="fml_father_education" class="form-select" required>
            <option value="">Pilih ..</option>
            <option value="SD" {{ $fathereducation === 'SD' ? 'selected' : 'SD' }}>SD</option>
            <option value="SMP" {{ $fathereducation === 'SMP' ? 'selected' : 'SMP' }}>SMP</option>
            <option value="SMA" {{ $fathereducation === 'SMA' ? 'selected' : 'SMA' }}>SMA</option>
            <option value="SMK" {{ $fathereducation === 'SMK' ? 'selected' : 'SMK' }}>SMK</option>
            <option value="S1" {{ $fathereducation === 'S1' ? 'selected' : 'S1' }}>S1</option>
            <option value="S2" {{ $fathereducation === 'S2' ? 'selected' : 'S2' }}>S2</option>
        </select>
    </div>
    
    <div class="mb-3">
    <label class="form-label">Penghasilan per Bulan (Rp)</label>
    @php
        $selectedIncome = old('fml_father_income', $family->fml_father_income ?? '');
    @endphp
    <select name="fml_father_income" class="form-select" required>
        <option value="">-- Pilih Rentang Penghasilan --</option>
        <option value="1" {{ $selectedIncome == 1 ? 'selected' : '' }}>< Rp 1.000.000</option>
        <option value="2"{{ $selectedIncome == 2 ? 'selected' : '' }}>Rp 1.000.000 - Rp 3.000.000</option>
        <option value="3"{{ $selectedIncome == 3 ? 'selected' : '' }}>Rp 3.000.000 - Rp 5.000.000</option>
        <option value="4"{{ $selectedIncome == 4 ? 'selected' : '' }}>Rp 5.000.000 - Rp 10.000.000</option>
        <option value="5"{{ $selectedIncome == 5 ? 'selected' : '' }}>> Rp 10.000.000</option>
    </select>
</div>

    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea name="fml_father_address" class="form-control" rows="3" placeholder="Alamat lengkap">{{ old('fml_father_address', $family->fml_father_address ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Nomor Telepon</label>
        <input type="number" name="fml_father_phone" value="{{ old('fml_father_phone', $family->fml_father_phone ?? '') }}" class="form-control" placeholder="08xxxxxxxxxx">
    </div>

    {{-- <div class="mb-3">
        <label class="form-label">Status</label>
        <input type="text" name="fml_father_status" class="form-control" placeholder="Contoh: Menikah">
    </div> --}}

    <div class="d-flex justify-content-between mt-4">
        <button type="button" class="btn btn-secondary" onclick="stepper.previous()">
            Kembali
        </button>

        <button type="button" class="btn btn-primary" onclick="stepFour()">
            Lanjut
        </button>
    </div>

</div>


<script>
    function stepFour() {
    let formData = {
        fml_father_name: $('input[name="fml_father_name"]').val(),
        fml_father_religion_id: $('select[name="fml_father_religion_id"]').val(),
        fml_father_nationality: $('select[name="fml_father_nationality"]').val(),
        fml_father_education: $('select[name="fml_father_education"]').val(),
        fml_father_occupation: $('input[name="fml_father_occupation"]').val(),
        fml_father_income: $('select[name="fml_father_income"]').val(),
        fml_father_address: $('textarea[name="fml_father_address"]').val(),
        fml_father_phone: $('input[name="fml_father_phone"]').val(),
        _token: '{{ csrf_token() }}'
    };

    $.ajax({
        url: "{{ route('prospectiveStudent.register.stepFour') }}",
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
                }).then(() => {
                    stepper.next();
                });
            }
        },
        error: function(xhr) {
            console.log(xhr.responseJSON);
            if (xhr.status === 422) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal!',
                    text: 'Cek kembali inputan.',
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Terjadi kesalahan server.',
                });
            }
        }
    });
}
</script>
