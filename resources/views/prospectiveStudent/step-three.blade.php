<div id="step-3" class="content">

    <div class="mb-3">
        <label class="form-label">Golongan Darah</label>
        <input type="text" name="phy_blood_type"  value="{{ old('phy_blood_type', $physicalCondition->phy_blood_type ?? '') }}" class="form-control" placeholder="Contoh: A, B, AB, O ,Jika tidak ada, isi '-'">
    </div>

    <div class="mb-3">
        <label class="form-label">Penyakit Bawaan</label>
        <input type="text" name="phy_illness" value="{{ old('phy_ullness', $physicalCondition->phy_illness ?? '') }}" class="form-control" placeholder="Jika tidak ada, isi '-'">
    </div>

    <div class="mb-3">
        <label class="form-label">Kelainan Jasmani</label>
        <input type="text" name="phy_disability" value="{{ old('phy_disability', $physicalCondition->phy_disability ?? '') }}" class="form-control" placeholder="Jika tidak ada, isi '-'">
    </div>

    <div class="mb-3">
        <label class="form-label">Tinggi Badan (cm)</label>
        <input type="number" name="phy_height" value="{{ old('phy_height', $physicalCondition->phy_height ?? '') }}" class="form-control" min="0">
    </div>

    <div class="mb-4">
        <label class="form-label">Berat Badan (kg)</label>
        <input type="number" name="phy_weight" value="{{ old('phy_weight', $physicalCondition->phy_weight ?? '') }}" class="form-control" min="0">
    </div>

  
        <button type="button" class="btn btn-secondary" onclick="stepper.previous()">
        Kembali
    </button>

    <button type="button" class="btn btn-primary" onclick="stepThree()">
        Lanjut
    </button>
  

</div>

<script>
function stepThree() {

    let formData = {
        phy_blood_type: $('input[name="phy_blood_type"]').val(),
        phy_illness: $('input[name="phy_illness"]').val(),
        phy_disability: $('input[name="phy_disability"]').val(),
        phy_height: $('input[name="phy_height"]').val(),
        phy_weight: $('input[name="phy_weight"]').val(),
        _token: '{{ csrf_token() }}'
    };

    $.ajax({
    url: "{{ route('prospectiveStudent.register.stepThree') }}",
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

    error: function(xhr){

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
                timer: 2000,
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

