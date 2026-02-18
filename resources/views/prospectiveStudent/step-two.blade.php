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
            <option value="AK">Alaska</option>
            <option value="HI">Hawaii</option>
        </select>
    </div>

    {{-- Kecamatan --}}
    <div class="mb-3">
        <label class="form-label">Kecamatan</label>
        <select name="adr_district" id="district" class="select2 form-control">
            <option value="">Pilih..</option>
            <option value="AK">Alaska</option>
            <option value="HI">Hawaii</option>
        </select>
    </div>

    {{-- Desa --}}
    <div class="mb-3">
        <label class="form-label">Desa</label>
        <select name="adr_village" id="village" class="select2 form-control">
            <option value="">Pilih..</option>
            <option value="AK">Alaska</option>
            <option value="HI">Hawaii</option>
        </select>
    </div>

    {{-- Kode Pos --}}
    <div class="mb-3">
        <label class="form-label">Kode Pos</label>
     
        <select name="adr_postal_code" id="postal-code" class="select2 form-control">
            <option value="">Pilih..</option>
            <option value="AK">Alaska</option>
            <option value="HI">Hawaii</option>
        </select>
    </div>

    {{-- Jarak Rumah ke Sekolah --}}
    <div class="mb-3">
        <label class="form-label">Jarak Rumah ke Sekolah (km)</label>
        <input type="text" name="adr_distance" class="form-control">
    </div>

    {{-- Alamat Lengkap --}}
    <div class="mb-3">
        <label class="form-label">Alamat Lengkap</label>
        <textarea name="adr_detail" class="form-control" rows="3"></textarea>
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
    $.get('/prospective-student/api/provinces', function (res) {
        let el = $('#province');
        el.empty().append('<option value="">Pilih Provinsi..</option>');

        res.data.forEach(item => {
            el.append(`<option value="${item.code}">${item.name}</option>`);
        });

        el.trigger('change');
    });
}

function loadRegencies(provinceId) {
    $.get(`/prospective-student/api/regencies/${provinceId}`, function (res) {
        let el = $('#regency');
        el.empty().append('<option value="">Pilih Kabupaten..</option>');

        res.data.forEach(item => {
            el.append(`<option value="${item.code}">${item.name}</option>`);
        });

        el.trigger('change');
    });
}

function loadDistricts(regencyId) {
    $.get(`/prospective-student/api/districts/${regencyId}`, function (res) {
        let el = $('#district');
        el.empty().append('<option value="">Pilih Kecamatan..</option>');

        res.data.forEach(item => {
            el.append(`<option value="${item.code}">${item.name}</option>`);
        });

        el.trigger('change');
    });
}

function loadVillages(districtId) {
    $.get(`/prospective-student/api/villages/${districtId}`, function (res) {
        let el = $('#village');
        el.empty().append('<option value="">Pilih Desa..</option>');

        res.data.forEach(item => {
            el.append(`<option value="${item.code}">${item.name}</option>`);
        });

        el.trigger('change');
    });
}
</script>







