<div id="step-3" class="content">
    <div class="row g-3 mt-2">

        <div class="col-md-12">
            <label class="form-label fw-semibold">Pilihan Jurusan <span class="text-danger">*</span></label>
            <select name="ppsu_major_id" class="form-select select2" required>
                <option value="" disabled selected>Pilih Jurusan</option>
                @foreach ($majors as $major)
                    <option value="{{ $major->mjr_id }}">{{ $major->mjr_name }} ({{ $major->mjr_abbr }})</option>
                @endforeach
            </select>
        </div>

        <div class="col-12">
            <label class="form-label fw-semibold">Alasan Memilih Jurusan</label>
            <textarea name="ppsu_reason" class="form-control" rows="3" placeholder="Ceritakan alasan kamu memilih jurusan tersebut..."></textarea>
        </div>

        <div class="col-12">
            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" id="agreement" name="aggreement" required />
                <label class="form-check-label" for="agreement">
                    Saya menyatakan bahwa semua data yang saya isi adalah <strong>benar dan dapat dipertanggungjawabkan</strong>.
                </label>
            </div>
        </div>

        <div class="col-12 d-flex justify-content-between mt-3">
            <button type="button" class="btn btn-outline-secondary px-5" onclick="stepper.previous()">
                <i class="ti ti-arrow-left me-1"></i> Sebelumnya
            </button>
            <button type="button" class="btn btn-success px-5" onclick="stepThree()">
                <i class="ti ti-check me-1"></i> Kirim Pendaftaran
            </button>
        </div>

    </div>
</div>

<script>
function stepThree() {

    if (!$('#agreement').is(':checked')) {
        alert('Harap centang pernyataan persetujuan.');
        return;
    }

    let formData = {
        ppsu_major_id : $('[name="ppsu_major_id"]').val(),
        ppsu_reason   : $('[name="ppsu_reason"]').val(),
        _token        : '{{ csrf_token() }}'
    };

    $.ajax({
        url: "{{ route('prospectiveStudent.ppdbRegistration.stepThree') }}",
        type: "POST",
        data: formData,
        success: function(response) {
            if (response.status) {
                alert(response.message);
                stepper.next(); // atau redirect jika ini step terakhir
            }
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                let msg = Object.values(errors).flat().join('\n');
                alert(msg);
            } else {
                alert('Terjadi kesalahan server.');
            }
        }
    });
}
</script>