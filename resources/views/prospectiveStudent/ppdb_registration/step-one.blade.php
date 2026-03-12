<div id="step-1" class="content">

    {{-- Nama Sekolah --}}
    <div class="mb-3">
        <label class="form-label">Nama Sekolah Asal</label>
        <input type="text" name="prv_school_name" class="form-control"
            value="{{ old('prv_school_name', $previousEducation->prv_school_name ?? '') }}"
            placeholder="Contoh: SMP Negeri 1 Jakarta"
            required>
    </div>

    {{-- NPSN --}}
    <div class="mb-3">
        <label class="form-label">NPSN <small class="text-muted">(Nomor Pokok Sekolah Nasional)</small></label>
        <input type="text" name="prv_npsn" class="form-control"
            value="{{ old('prv_npsn', $previousEducation->prv_npsn ?? '') }}"
            placeholder="Contoh: 20101234"
            maxlength="8"
            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
            required>
        <div class="form-text">NPSN terdiri dari 8 digit angka.</div>
    </div>

    {{-- Nomor Ijazah --}}
    <div class="mb-3">
        <label class="form-label">Nomor Ijazah <small class="text-muted">(Opsional)</small></label>
        <input type="text" name="prv_certificate_number" class="form-control"
            value="{{ old('prv_certificate_number', $previousEducation->prv_certificate_number ?? '') }}"
            placeholder="Contoh: 123456789">
    </div>

    <button type="button" class="btn btn-primary" onclick="stepOne()">
        Lanjut
    </button>

</div>

<script>
    function stepOne() {
        let form = document.querySelector('#step-1').closest('form');
        let formData = new FormData(form);

        fetch("{{ route('prospectiveStudent.ppdbRegistration.stepOne') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    stepper.next();
                } else {
                    alert(res.message);
                }
            })
            .catch(err => {
                console.error(err);
                alert('Validasi gagal. Cek kembali inputan.');
            });
    }
</script>