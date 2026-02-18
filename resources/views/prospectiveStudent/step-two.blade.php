<div id="step-2" class="content">

    {{-- Provinsi --}}
    <div class="mb-3">
        <label class="form-label">Provinsi</label>
        <select name="adr_province" id="province" class="select2 form-control">
            <option value="">Pilih Provinsi..</option>
            
        </select>

    </div>

    {{-- Kabupaten / Kota --}}
    <div class="mb-3">
        <label class="form-label">Kabupaten / Kota</label>
        <select name="adr_regency" id="regency" class="select2 form-control">
            <option value="">Pilih..</option>
        </select>
    </div>

    {{-- Kecamatan --}}
    <div class="mb-3">
        <label class="form-label">Kecamatan</label>
        <select name="adr_district" id="district" class="select2 form-control">
            <option value="">Pilih..</option>
        </select>
    </div>

    {{-- Desa --}}
    <div class="mb-3">
        <label class="form-label">Desa</label>
        <select name="adr_village" id="village" class="select2 form-control">
            <option value="">Pilih..</option>
        </select>
    </div>

    {{-- Kode Pos --}}
    <div class="mb-3">
        <label class="form-label">Kode Pos</label>
     
        <input type="text" name="adr_postal_code"  value="{{ $address->adr_postal_code ?? '' }}" class="form-control">

    </div>

    {{-- Jarak Rumah ke Sekolah --}}
    <div class="mb-3">
        <label class="form-label">Jarak Rumah ke Sekolah (km)</label>
        <input type="number" name="adr_distance"  value="{{ $address->adr_distance?? '' }}" class="form-control">
    </div>

    {{-- Alamat Lengkap --}}
    <div class="mb-3">
        <label class="form-label">Alamat Lengkap</label>
        <textarea name="adr_detail" class="form-control" rows="3">{{ $address->adr_detail?? '' }}</textarea>
    </div>

    <button type="button" class="btn btn-secondary" onclick="stepper.previous()">
        Kembali
    </button>

    <button type="button" class="btn btn-primary" onclick="stepTwo()">
        Lanjut
    </button>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
let oldProvince = "{{ $address->adr_province ?? '' }}";
let oldRegency  = "{{ $address->adr_regency ?? '' }}";
let oldDistrict = "{{ $address->adr_district ?? '' }}";
let oldVillage  = "{{ $address->adr_village ?? '' }}";
</script>

<script>
$(document).ready(function () {

    // $('.form-select').select2({
    //     theme: 'bootstrap-5',
    //     width: '100%'
    // });

    loadProvinces();

    $(document).on('change', '#province', function () {
        reset('#regency');
        reset('#district');
        reset('#village');

        if (this.value) {
            loadRegencies(this.value);
        }
    });

    $(document).on('change', '#regency', function () {
        reset('#district');
        reset('#village');

        if (this.value) {
            loadDistricts(this.value);
        }
    });

    $(document).on('change', '#district', function () {
        reset('#village');

        if (this.value) {
            loadVillages(this.value);
        }
    });

});
</script>
<script>
function reset(selector) {
    $(selector).empty().append('<option value="">Pilih..</option>').trigger('change');
}

function loadProvinces() {
    // console.log(oldProvince);
    $.get('/prospective-student/api/provinces', function (res) {
        let el = $('#province');
        el.empty().append('<option value="">Pilih Provinsi..</option>');

        res.data.forEach(item => {
            let selected = item.code == oldProvince ? 'selected' : '';
            el.append(`<option value="${item.code}" ${selected}>${item.name}</option>`);
        });
        if (oldProvince) {
            loadRegencies(oldProvince);
        }

        el.trigger('change');
    });
}

function loadRegencies(provinceId) {
    $.get(`/prospective-student/api/regencies/${provinceId}`, function (res) {
        let el = $('#regency');
        el.empty().append('<option value="">Pilih Kabupaten..</option>');

        res.data.forEach(item => {
            let selected = item.code == oldRegency ? 'selected' : '';
            el.append(`<option value="${item.code}"${selected}>${item.name}</option>`);
        });
        

        el.trigger('change');
    });
}

function loadDistricts(regencyId) {
    $.get(`/prospective-student/api/districts/${regencyId}`, function (res) {
        let el = $('#district');
        el.empty().append('<option value="">Pilih Kecamatan..</option>');

        res.data.forEach(item => {
            let selected = item.code == oldDistrict ? 'selected' : '';

            el.append(`<option value="${item.code}"${selected}>${item.name}</option>`);
        });

        el.trigger('change');
    });
}

function loadVillages(districtId) {
    $.get(`/prospective-student/api/villages/${districtId}`, function (res) {
        let el = $('#village');
        el.empty().append('<option value="">Pilih Desa..</option>');

        res.data.forEach(item => {
            let selected = item.code == oldVillage ? 'selected' : '';

            el.append(`<option value="${item.code}"${selected}>${item.name}</option>`);
        });

        el.trigger('change');
    });
}
</script>


<script>
function stepTwo() {

    let formData = {
        adr_province: $('#province').val(),
        adr_regency: $('#regency').val(),
        adr_district: $('#district').val(),
        adr_village: $('#village').val(),
        adr_postal_code: $('input[name="adr_postal_code"]').val(),
        adr_distance: $('input[name="adr_distance"]').val(),
        adr_detail: $('textarea[name="adr_detail"]').val(),
        _token: '{{ csrf_token() }}'
    };

    $.ajax({
        url: "{{ route('prospectiveStudent.register.stepTwo') }}",
        type: "POST",
        data: formData,
        success: function(response) {

            if(response.status){
                alert(response.message);

                // lanjut ke step berikutnya
                stepper.next();
            }
        },
        error: function(xhr){

            if(xhr.status === 422){
                alert('Validasi gagal. Cek kembali inputan.');
            } else {
                alert('Terjadi kesalahan server.');
            }
        }
    });
}
</script>







