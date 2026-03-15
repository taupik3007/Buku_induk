<div id="step-2" class="content">

    @forelse ($requirements as $req)
        <div class="mb-3">
            <label class="form-label">{{ $req->pdr_name }}</label>

            @if ($req->pdr_type === 'text')
                <input type="text" name="requirements[{{ $req->pdr_id }}]" class="form-control"
                    value="{{ old('requirements.' . $req->pdr_id, $studentRequirements[$req->pdr_id]->psr_value ?? '') }}"
                    placeholder="{{ $req->pdr_name }}">

            @elseif ($req->pdr_type === 'number')
                <input type="number" name="requirements[{{ $req->pdr_id }}]" class="form-control"
                    value="{{ old('requirements.' . $req->pdr_id, $studentRequirements[$req->pdr_id]->psr_value ?? '') }}"
                    placeholder="{{ $req->pdr_name }}">

            @elseif ($req->pdr_type === 'date')
                <input type="date" name="requirements[{{ $req->pdr_id }}]" class="form-control"
                    value="{{ old('requirements.' . $req->pdr_id, $studentRequirements[$req->pdr_id]->psr_value ?? '') }}">

            @elseif ($req->pdr_type === 'file')
                @if (!empty($studentRequirements[$req->pdr_id]->psr_value))
                    <div class="mb-1">
                        <a href="{{ Storage::url($studentRequirements[$req->pdr_id]->psr_value) }}"
                            target="_blank" class="text-sm text-primary">
                            <i class="bi bi-file-earmark me-1"></i>Lihat file yang sudah diupload
                        </a>
                    </div>
                @endif
                <input type="file" name="requirements[{{ $req->pdr_id }}]" class="form-control"
                    accept=".pdf,.jpg,.jpeg,.png">
                <div class="form-text">Format: PDF, JPG, PNG. Maks: 2MB.</div>
            @endif

            {{-- Tempat munculnya error per field --}}
            <div class="invalid-feedback-req" data-id="{{ $req->pdr_id }}"></div>
        </div>
    @empty
        <div class="alert alert-info">Belum ada persyaratan yang ditentukan.</div>
    @endforelse

    <div class="d-flex justify-content-between mt-4">
        <button type="button" class="btn btn-secondary" onclick="stepper.previous()">
            Kembali
        </button>

        <button type="button" class="btn btn-primary" onclick="stepTwo()">
            Lanjut
        </button>
    </div>

</div>

<script>
function stepTwo() {

    // Reset error sebelumnya
    $('[name^="requirements"]').removeClass('is-invalid');
    $('.invalid-feedback-req').text('').hide();

    let form = document.querySelector('#step-2').closest('form');
    let formData = new FormData(form);
    formData.append('_token', '{{ csrf_token() }}');

    $.ajax({
        url: "{{ route('prospectiveStudent.ppdbRegistration.stepTwo') }}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.status) {
                stepper.next();
            }
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                $.each(errors, function(field, messages) {
                    // field format: requirements.123
                    let id = field.split('.')[1];
                    let input = $('[name="requirements[' + id + ']"]');
                    input.addClass('is-invalid');
                    let feedback = $('.invalid-feedback-req[data-id="' + id + '"]');
                    feedback.text(messages[0]).show();
                });
            } else {
                alert('Terjadi kesalahan server.');
            }
        }
    });
}
</script>