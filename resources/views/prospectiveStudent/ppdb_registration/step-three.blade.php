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
            <textarea name="ppsu_reason" class="form-control" rows="3"
                placeholder="Ceritakan alasan kamu memilih jurusan tersebut..."></textarea>
        </div>

        <div class="col-12">
            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" id="agreement" name="aggreement" required />
                <label class="form-check-label" for="agreement">
                    Saya menyatakan bahwa semua data yang saya isi adalah <strong>benar dan dapat
                        dipertanggungjawabkan</strong>.
                </label>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <button type="button" class="btn btn-secondary" onclick="stepper.previous()">
                Kembali
            </button>
            <button type="button" class="btn btn-success" onclick="stepThree()">
                Kirim Pendaftaran
            </button>
        </div>

    </div>
</div>

<script>
    function stepThree() {

        if (!$('#agreement').is(':checked')) {
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian!',
                text: 'Harap centang pernyataan persetujuan.',
            });
            return;
        }

        Swal.fire({
            icon: 'question',
            title: 'Konfirmasi Pendaftaran',
            text: 'Apakah data yang Anda isi sudah sesuai dan yakin ingin mengirim pendaftaran?',
            showCancelButton: true,
            confirmButtonText: 'Ya, Kirim Pendaftaran',
            cancelButtonText: 'Periksa Kembali',
            reverseButtons: true,
            allowOutsideClick: false
        }).then((result) => {

            if (result.isConfirmed) {

                let formData = {
                    ppsu_major_id: $('[name="ppsu_major_id"]').val(),
                    ppsu_reason: $('[name="ppsu_reason"]').val(),
                    _token: '{{ csrf_token() }}'
                };

                $.ajax({
                    url: "{{ route('prospectiveStudent.ppdbRegistration.stepThree') }}",
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

                                window.location.href = '/prospective-student/';

                            });

                        }
                    },

                    error: function(xhr) {

                        if (xhr.status === 422) {

                            let errors = xhr.responseJSON.errors;
                            let msg = Object.values(errors).flat().join('\n');

                            Swal.fire({
                                icon: 'error',
                                title: 'Validasi Gagal!',
                                text: msg,
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

            // Kalau klik "Periksa Kembali"
            // tidak ada proses AJAX.
            // User tetap berada di step 3.

        });
    }
</script>
