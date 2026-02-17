@extends('teacher.master')

@push('link')
  <link rel="stylesheet" href="{{asset('assets/libs/owl.carousel/dist/assets/owl.carousel.min.css')}}" />
  <!-- Favicon icon-->
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />

  <!-- Core Css -->
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">


@endpush

@section('title')
    E-Laundry | Dashboard
@endsection

@section('content')
    <section class="pt-3 pb-4">
            <div class="container-fluid">
                <div class="card data-shadow rounded-3 mb-7">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-7 p-lg-5 border flex-grow-1 rounded-3">
                                <div class="py-4 d-flex flex-column gap-4">

                                    <div id="stepper" class="bs-stepper">
                                        <div class="bs-stepper-header">
                                            <div class="step" data-target="#step-1">
                                                <button class="step-trigger">
                                                    <span class="bs-stepper-circle">1</span>
                                                    <span class="bs-stepper-label">Data Diri</span>
                                                </button>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#step-2">
                                                <button class="step-trigger">
                                                    <span class="bs-stepper-circle">2</span>
                                                    <span class="bs-stepper-label">Alamat</span>
                                                </button>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#step-3">
                                                <button class="step-trigger">
                                                    <span class="bs-stepper-circle">3</span>
                                                    <span class="bs-stepper-label">Pasangan</span>
                                                </button>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#step-4">
                                                <button class="step-trigger">
                                                    <span class="bs-stepper-circle">4</span>
                                                    <span class="bs-stepper-label">Riwayat Mengajar</span>
                                                </button>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#step-5">
                                                <button class="step-trigger">
                                                    <span class="bs-stepper-circle">5</span>
                                                    <span class="bs-stepper-label">Riwayat Pendidikan</span>
                                                </button>
                                            </div>
                                        </div>

                                        <form method="POST" action="/register">
                                            @csrf

                                            <div class="bs-stepper-content">
                                                    
                                                <div id="step-1" class="content">
                                                        <div class="form-group mb-2">
                                                            <label class="form-">Nama</label>
                                                            <input type="text" name="tcb_user_name" class="form-control" id="tcb_user_name" aria-describedby="nama" placeholder="Nama">
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label class="form-">Tempat Lahir</label>
                                                            <input type="text" name="tcb_birth_place" class="form-control" id="tcb_birth_place" aria-describedby="tempat lahir" placeholder="Tempat Lahir">
                                                        </div>
                                                            <div class="form-group mb-2">
                                                                <label class="form-">Tanggal Lahir</label>
                                                                <input type="date" name="tcb_birth_date" id="tcb_birth_date" class="form-control">
                                                            </div>
                                                        <div class="form-group mb-2">
                                                            <label class="form-" for="inlineFormCustomSelect">Agama</label>
                                                            <select name="tcb_religion" class="form-select mr-sm-2" id="tcb_religion">
                                                                <option selected>Pilih</option>
                                                                <option value="Islam">Islam</option>
                                                                <option value="Kristen Protestan">Kristen Protestan</option>
                                                                <option value="Katolik">Katolik</option>
                                                                <option value="Hindu">Hindu</option>
                                                                <option value="Buddha">Buddha</option>
                                                                <option value="Konghucu">Konghucu</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label class="form-" for="inlineFormCustomSelect">Menikah</label>
                                                            <select name="tcb_mary_status" class="form-select mr-sm-2" id="tcb_mary_status">
                                                                <option selected>Pilih</option>
                                                                <option value="1">Sudah</option>
                                                                <option value="0">belum</option>
                                                    
                                                            </select>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label class="form-">Telepon</label>
                                                            <input type="tel" name="tcb_telp" class="form-control" id="tcb_telp" aria-describedby="no. telp" placeholder="No. Telepon">
                                                        </div>
                                                 

                                                    <button type="button" class="btn btn-primary" onclick="saveStep1()">
                                                        Lanjut
                                                    </button>
                                                </div>
                                                <div id="step-2" class="content">
                        
                                                        <div class="form-group mb-2">
                                                            <label class="form-">Detail</label>
                                                            <input type="text" class="form-control" id="tca_detail" name="tca_detail" aria-describedby="nama" placeholder="Nama">
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label>Provinsi</label>
                                                            <select id="tca_province" name="tca_province" class="form-select"></select>
                                                        </div>
                                                        
                                                        <div class="form-group mb-2">
                                                            <label>Kabupaten / Kota</label>
                                                            <select id="tca_regency" name="tca_regency" class="form-select"></select>
                                                        </div>
                                                        
                                                        <div class="form-group mb-2">
                                                            <label>Kecamatan</label>
                                                            <select id="tca_district" name="tca_district" class="form-select"></select>
                                                        </div>
                                                        
                                                        <div class="form-group mb-2">
                                                            <label>Kelurahan</label>
                                                            <select id="tca_village" name="tca_village" class="form-select"></select>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label class="form-">Kode Pos</label>
                                                            <input type="number" class="form-control" id="tca_postalcode" name="tca_postalcode" aria-describedby="kode pos" placeholder="Kode Pos">
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label class="form-">Jarak</label>
                                                            <input type="number" class="form-control" id="tca_distance" name="tca_distance" aria-describedby="kode pos" placeholder="Kode Pos">
                                                        </div>
                                    
                                                    <button type="button" class="btn btn-primary"
                                                     onclick="saveAddress()">
                                                        Lanjut
                                                    </button>
                                                    <button type="button" class="btn btn-secondary"
                                                    onclick="stepper.previous()">
                                                    Kembali
                                                </button>
                                                </div>
                                                <div id="step-3" class="content">
                                   
                                                        <div class="form-group mb-2">
                                                            <label class="form-">Nama</label>
                                                            <input type="text" class="form-control" name="tcp_name" id="tcp_name" aria-describedby="nama" placeholder="Nama">
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label class="form-">NIK</label>
                                                            <input type="number" class="form-control" name="tcp_nik" id="tcp_nik" aria-describedby="nama" placeholder="NIK">
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label class="form-">Pekerjaan</label>
                                                            <input type="text" class="form-control" name="tcp_work" id="tcp_work" aria-describedby="nama" placeholder="Pekerjaan">
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label class="form-">NIP</label>
                                                            <input type="number" class="form-control" name="tcp_nip" id="tcp_nip" aria-describedby="nama" placeholder="NIP">
                                                        </div>
                                      
                                                        <button type="button" class="btn btn-primary"
                                                        onclick="savePartner()">
                                                           Lanjut
                                                       </button>
                                                       <button type="button" class="btn btn-secondary"
                                                       onclick="stepper.previous()">
                                                       Kembali
                                                   </button>
                                                </div>
                                                <div id="step-4" class="content">
                                                
                                                        <div class="form-group mb-2">
                                                            <label class="form-">Nama Mapel</label>
                                                            <input type="text" class="form-control" name="tcs_subject_name" id="tcs_subject_name" aria-describedby="nama" placeholder="Nama">
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label class="form-">Nama Sekolah</label>
                                                            <input type="text" class="form-control" name="tcs_name_school" id="tcs_name_school" aria-describedby="nama" placeholder="Nama Sekolah">
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label class="form-">Kelas</label>
                                                            <input type="number" class="form-control" name="tcs_class" id="tcs_class" aria-describedby="nama" placeholder="Kelas">
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label class="form-">Jumlah Jam</label>
                                                            <input type="number" class="form-control" name="tcs_jp" id="tcs_jp" aria-describedby="nama" placeholder="Jumlah Jam">
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label class="form-">Tahun</label>
                                                            <input type="number" class="form-control" name="tcs_year" id="tcs_year" aria-describedby="nama" placeholder="Tahun">
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label class="form-" for="inlineFormCustomSelect">Status</label>
                                                            <select class="form-select mr-sm-2" name="tcs_status" id="tcs_status">
                                                                <option selected>Pilih</option>
                                                                <option value="aktif">Aktif</option>
                                                                <option value="nonaktif">Non Aktif</option>
                                                            </select>
                                                        </div>
                                                  
                                                        <button type="button" class="btn btn-primary"
                                                        onclick="saveTeach()">
                                                           Lanjut
                                                       </button>
                                                       <button type="button" class="btn btn-secondary"
                                                       onclick="stepper.previous()">
                                                       Kembali
                                                   </button>
                                                </div>

                                                <div id="step-5" class="content">

                                                    <!-- WRAPPER PENDIDIKAN -->
                                                    <div id="education-wrapper">
                                                
                                                        <!-- FORM PERTAMA -->
                                                        <div class="education-item border p-3 mb-2 rounded">
                                                
                                                            <div class="form-group mb-2">
                                                                <label>Tingkat</label>
                                                                <select class="form-select level-select" id="tce_level" name="level[]">
                                                                    <option value="">Pilih</option>
                                                                    <option value="SMA">SMA</option>
                                                                    <option value="SMK">SMK</option>
                                                                </select>
                                                            </div>
                                                
                                                            <div class="form-group mb-2">
                                                                <label>Nama Satuan Pendidikan</label>
                                                                <input type="text" class="form-control" id="tce_institution" name="institution[]">
                                                            </div>
                                                
                                                            <div class="form-group mb-2">
                                                                <label>Tahun Lulus</label>
                                                                <input type="number" class="form-control" id="tce_graduation_year" name="graduation_year[]">
                                                            </div>
                                                
                                                            <div class="form-group mb-2 dynamic-field">
                                                                <label>Jurusan</label>
                                                                <input type="text" class="form-control" id="tce_major" name="major[]">
                                                            </div>

                                                           
                                                
                                                        </div>

                                                       
                                                
                                                    </div>
                                                
                                                    <div class="d-flex justify-content-between align-items-center mt-3">

                                                        <!-- KIRI (2 tombol) -->
                                                        <div>
                                                            <button type="button" class="btn btn-primary"
                                                        onclick="saveEducation()">
                                                           Simpan
                                                       </button>
                                                    
                                                            <button type="button"
                                                                    class="btn btn-secondary"
                                                                    onclick="stepper.previous()">
                                                                Kembali
                                                            </button>
                                                        </div>
                                                    
                                                        <!-- KANAN -->
                                                        <button type="button"
                                                                id="add-education"
                                                                class="btn btn-primary">
                                                            + Tambah Pendidikan
                                                        </button>
                                                    
                                                    </div>
                                                    
                                                
                                                </div>
                                                
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

              
            </div>
        </section>
        <!-- ------------------------------------- -->
        <!-- List End -->
        <!-- ------------------------------------- -->

      
    </div>

    <!-- ------------------------------------- -->
    <!-- Footer Start -->
    <!-- ------------------------------------- -->
    
    <!-- ------------------------------------- -->
    <!-- Footer End -->
    <!-- ------------------------------------- -->

    <!-- Scroll Top -->
    <a href="javascript:void(0)"
        class="top-btn btn btn-primary d-flex align-items-center justify-content-center round-54 p-0 rounded-circle">
        <i class="ti ti-arrow-up fs-7"></i>
    </a>

@endsection

@push('script')



<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
<!-- Import Js Files -->
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/js/theme/app.init.js') }}"></script>
<script src="{{ asset('assets/js/theme/theme.js') }}"></script>
<script src="{{ asset('assets/js/theme/app.min.js') }}"></script>

<!-- solar icons -->
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
<script src="{{ asset('assets/libs/owl.carousel/dist/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/frontend-landingpage/homepage.js') }}"></script>
{{-- bs stapper --}}
<script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
<script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js')}}"></script>
  <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
  <script src="{{ asset('assets/js/forms/select2.init.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    function getVal(id){
    let el = document.getElementById(id);

    if(!el){
        console.error(id + ' tidak ditemukan');
        return '';
    }

    return el.value;
}

    function saveStep1() {
    
        let formData = new FormData();
    
        formData.append('tcb_user_name', getVal('tcb_user_name'));
    formData.append('tcb_birth_place', getVal('tcb_birth_place'));
    formData.append('tcb_birth_date', getVal('tcb_birth_date'));
    formData.append('tcb_religion', getVal('tcb_religion'));
    formData.append('tcb_mary_status', getVal('tcb_mary_status'));
    formData.append('tcb_telp', getVal('tcb_telp'));

        fetch("{{ route('administration.prospectiveTeacher.store_biodata') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: formData
        })
        .then(response => {
    
            if(!response.ok){
                throw new Error('Server error ' + response.status);
            }
    
            return response.json();
        })
        .then(data => {
    
            if(data.success){

Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'success',
    title: data.message ?? 'Biodata tersimpan',
    showConfirmButton: false,
    timer: 2000
});

stepper.next();

}else{

Swal.fire({
    icon: 'error',
    title: 'Gagal',
    text: data.message ?? 'Gagal simpan biodata'
});

}

    
        })
        .catch(err => {

Swal.fire({
    icon: 'error',
    title: 'Server Error',
    text: 'Terjadi kesalahan sistem'
});

console.error(err);

});
    }
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        fetch("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")
            .then(response => response.json())
            .then(data => {
                let province = document.getElementById("tca_province");
                province.innerHTML = '<option>Pilih Provinsi</option>';
    
                data.forEach(item => {
                    province.innerHTML += 
                        `<option value="${item.id}">${item.name}</option>`;
                });
            });
    });
    </script>

<script>
    document.getElementById("tca_province").addEventListener("change", function () {
        let provinceId = this.value;
    
        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`)
            .then(response => response.json())
            .then(data => {
                let city = document.getElementById("tca_regency");
                city.innerHTML = '<option>Pilih Kabupaten</option>';
    
                data.forEach(item => {
                    city.innerHTML += 
                        `<option value="${item.id}">${item.name}</option>`;
                });
            });
    });
    </script>

<script>
    document.getElementById("tca_regency").addEventListener("change", function () {
        let cityId = this.value;
    
        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${cityId}.json`)
            .then(response => response.json())
            .then(data => {
                let district = document.getElementById("tca_district");
                district.innerHTML = '<option>Pilih Kecamatan</option>';
    
                data.forEach(item => {
                    district.innerHTML += 
                        `<option value="${item.id}">${item.name}</option>`;
                });
            });
    });
    </script>

<script>
    document.getElementById("tca_district").addEventListener("change", function () {
        let districtId = this.value;
    
        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${districtId}.json`)
            .then(response => response.json())
            .then(data => {
                let village = document.getElementById("tca_village");
                village.innerHTML = '<option>Pilih Kelurahan</option>';
    
                data.forEach(item => {
                    village.innerHTML += 
                        `<option value="${item.id}">${item.name}</option>`;
                });
            });
    });
    </script>

    <script>
        function saveAddress(){

let formData = new FormData();

function getVal(name){
    let el = document.querySelector(`[name="${name}"]`);
    return el ? el.value : '';
}
formData.append('tca_detail', getVal('tca_detail'));
formData.append('tca_province', getVal('tca_province'));
formData.append('tca_regency', getVal('tca_regency'));
formData.append('tca_district', getVal('tca_district'));
formData.append('tca_village', getVal('tca_village'));
formData.append('tca_postalcode', getVal('tca_postalcode'));
formData.append('tca_distance', getVal('tca_distance'));

fetch("{{ route('administration.prospectiveTeacher.store_address') }}", {
    method: "POST",
    headers: {
        'X-CSRF-TOKEN':
        document.querySelector('meta[name="csrf-token"]').content
    },
    body: formData
})
.then(res => res.json())
.then(res => {

    if(res.success){

Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'success',
    title: res.message,
    showConfirmButton: false,
    timer: 2000
});

stepper.next();

}else{

Swal.fire({
    icon: 'error',
    title: 'Gagal',
    text: res.message
});

}


})
.catch(err => {

Swal.fire({
    icon: 'error',
    title: 'Server Error',
    text: 'Terjadi kesalahan sistem'
});

console.error(err);

});

}

    </script>


    <script>
        function savePartner(){

    let formData = new FormData();

    function getVal(name){
    let el = document.querySelector(`[name="${name}"]`);
    return el ? el.value : '';
    }
    formData.append('tcp_name', getVal('tcp_name'));
    formData.append('tcp_nik', getVal('tcp_nik'));
    formData.append('tcp_work', getVal('tcp_work'));
    formData.append('tcp_nip', getVal('tcp_nip'));
 
    fetch("{{ route('administration.prospectiveTeacher.store_partner') }}", {
    method: "POST",
    headers: {
        'X-CSRF-TOKEN':
        document.querySelector('meta[name="csrf-token"]').content
    },
    body: formData
    })
    .then(res => res.json())
    .then(res => {

        if(res.success){

Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'success',
    title: res.message,
    showConfirmButton: false,
    timer: 2000
});

stepper.next();

}else{

Swal.fire({
    icon: 'error',
    title: 'Gagal',
    text: res.message
});

}


    })
    .catch(err => {

Swal.fire({
    icon: 'error',
    title: 'Server Error',
    text: 'Terjadi kesalahan sistem'
});

console.error(err);

});

    }

    </script>


<script>
    function saveTeach(){

let formData = new FormData();

function getVal(name){
let el = document.querySelector(`[name="${name}"]`);
return el ? el.value : '';
}
formData.append('tcs_subject_name', getVal('tcs_subject_name'));
formData.append('tcs_name_school', getVal('tcs_name_school'));
formData.append('tcs_class', getVal('tcs_class'));
formData.append('tcs_jp', getVal('tcs_jp'));
formData.append('tcs_year', getVal('tcs_year'));
formData.append('tcs_status', getVal('tcs_status'));

fetch("{{ route('administration.prospectiveTeacher.store_history') }}", {
method: "POST",
headers: {
    'X-CSRF-TOKEN':
    document.querySelector('meta[name="csrf-token"]').content
},
body: formData
})
.then(res => res.json())
.then(res => {

    if(res.success){

Swal.fire({
toast: true,
position: 'top-end',
icon: 'success',
title: res.message,
showConfirmButton: false,
timer: 2000
});

stepper.next();

}else{

Swal.fire({
icon: 'error',
title: 'Gagal',
text: res.message
});

}


})
.catch(err => {

Swal.fire({
icon: 'error',
title: 'Server Error',
text: 'Terjadi kesalahan sistem'
});

console.error(err);

});

}

</script>

<script>
    $('#add-education').click(function () {

let total = $('.education-item').length;

let options = '';

// FORM PERTAMA
if (total === 0) {
    options = `
        <option value="">Pilih</option>
        <option value="SMA">SMA</option>
        <option value="SMK">SMK</option>
    `;
} 
// FORM KEDUA+
else {
    options = `
        <option value="">Pilih</option>
        <option value="D3">D3</option>
        <option value="S1">S1</option>
        <option value="S2">S2</option>
        <option value="S3">S3</option>
    `;
}

let form = `
    <div class="education-item border p-3 mb-2 rounded">

        <div class="form-group mb-2">
            <label>Tingkat</label>
            <select class="form-select level-select" id="tce_level" name="level[]">
                ${options}
            </select>
        </div>

        <div class="form-group mb-2">
            <label>Nama Instansi</label>
            <input type="text" class="form-control" id="tce_institution" name="institution[]">
        </div>

        <div class="form-group mb-2">
            <label>Tahun Lulus</label>
            <input type="number" class="form-control" id="tce_graduation_year" name="graduation_year[]">
        </div>

        <div class="form-group mb-2 dynamic-field">
            <label>Gelar</label>
            <input type="text" class="form-control" id="tce_degree" name="degree[]">
        </div>

    </div>
`;

$('#education-wrapper').append(form);

});
$(document).on('change', '.level-select', function () {

let level = $(this).val();
let container = $(this)
    .closest('.education-item')
    .find('.dynamic-field');

if (level === 'SMA' || level === 'SMK') {

    container.html(`
        <label>Jurusan</label>
        <input type="text" class="form-control" name="major[]">
    `);

} else {

    container.html(`
        <label>Gelar</label>
        <input type="text" class="form-control" name="degree[]">
    `);
}

});

</script>

<script>
    function saveEducation(){

let formData = new FormData();

document.querySelectorAll('.education-item').forEach((item, i) => {

    let levelEl = item.querySelector('[name="level[]"]');
    let institutionEl = item.querySelector('[name="institution[]"]');
    let yearEl = item.querySelector('[name="graduation_year[]"]');
    let majorEl = item.querySelector('[name="major[]"]');
    let degreeEl = item.querySelector('[name="degree[]"]');

    formData.append(`education[${i}][level]`,
        levelEl ? levelEl.value : '');

    formData.append(`education[${i}][institution]`,
        institutionEl ? institutionEl.value : '');

    formData.append(`education[${i}][graduation_year]`,
        yearEl ? yearEl.value : '');

    formData.append(`education[${i}][major]`,
        majorEl ? majorEl.value : '');

    formData.append(`education[${i}][degree]`,
        degreeEl ? degreeEl.value : '');

});

fetch("{{ route('administration.prospectiveTeacher.store_education') }}", {
    method: "POST",
    headers: {
        'X-CSRF-TOKEN':
        document.querySelector('meta[name="csrf-token"]').content
    },
    body: formData
})
.then(res => res.json())
.then(res => {

    if(res.success){

        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: res.message,
            showConfirmButton: false,
            timer: 2000
        });

    } else {

        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: res.message
        });

    }

});
}

    </script>
    
     
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.stepper = new Stepper(document.querySelector('#stepper'))
        })
    </script>

@endpush
