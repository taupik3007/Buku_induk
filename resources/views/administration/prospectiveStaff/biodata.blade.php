@extends('administration.master')

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
                                                    <span class="bs-stepper-label">Riwayat Pendidikan</span>
                                                </button>
                                            </div>
                                        </div>

                                        <form method="POST" action="/register">
                                            @csrf

                                            <div class="bs-stepper-content">

                                                <div id="step-1" class="content">
                                                    <form>
                                                        <div class="form-group mb-2">
                                                            <label class="form-">Nama</label>
                                                            <input type="text" class="form-control" id="nametext" aria-describedby="nama" placeholder="Nama">
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label class="form-">Tempat Lahir</label>
                                                            <input type="text" class="form-control" id="nametext" aria-describedby="tempat lahir" placeholder="Tempat Lahir">
                                                        </div>
                                                            <div class="form-group mb-2">
                                                                <label class="form-">Tanggal Lahir</label>
                                                                <input type="date" class="form-control" value="2018-05-13">
                                                            </div>
                                                        <div class="form-group mb-2">
                                                            <label class="form-" for="inlineFormCustomSelect">Agama</label>
                                                            <select class="form-select mr-sm-2" id="inlineFormCustomSelect">
                                                                <option selected>Pilih</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label class="form-">Telepon</label>
                                                            <input type="tel" class="form-control" id="nametext" aria-describedby="no. telp" placeholder="No. Telepon">
                                                        </div>
                                                    </form>

                                                    <button type="button" class="btn btn-primary"
                                                        onclick="stepper.next()">
                                                        Lanjut
                                                    </button>
                                                </div>
                                                <div id="step-2" class="content">
                                                    <form>
                                                        <div class="form-group mb-2">
                                                            <label class="form-">Detail</label>
                                                            <input type="text" class="form-control" id="nametext" aria-describedby="nama" placeholder="Nama">
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label class="form-" for="inlineFormCustomSelect">Desa</label>
                                                            <select class="form-select mr-sm-2" id="inlineFormCustomSelect">
                                                                <option selected>Pilih</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label class="form-" for="inlineFormCustomSelect">Kecamatan</label>
                                                            <select class="form-select mr-sm-2" id="inlineFormCustomSelect">
                                                                <option selected>Pilih</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label class="form-" for="inlineFormCustomSelect">Kabupaten</label>
                                                            <select class="form-select mr-sm-2" id="inlineFormCustomSelect">
                                                                <option selected>Pilih</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label class="form-" for="inlineFormCustomSelect">Provinsi</label>
                                                            <select class="form-select mr-sm-2" id="inlineFormCustomSelect">
                                                                <option selected>Pilih</option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label class="form-">Kode Pos</label>
                                                            <input type="number" class="form-control" id="nametext" aria-describedby="kode pos" placeholder="Kode Pos">
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label class="form-">Jarak</label>
                                                            <input type="number" class="form-control" id="nametext" aria-describedby="kode pos" placeholder="Kode Pos">
                                                        </div>
                                                    </form>
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="stepper.next()">
                                                        Lanjut
                                                    </button>
                                                </div>
                                                <div id="step-3" class="content">
                                                    <form>
                                                        <div class="form-group mb-2">
                                                            <label class="form-">Nama</label>
                                                            <input type="text" class="form-control" id="nametext" aria-describedby="nama" placeholder="Nama">
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label class="form-">NIK</label>
                                                            <input type="number" class="form-control" id="nametext" aria-describedby="nama" placeholder="NIK">
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label class="form-">Pekerjaan</label>
                                                            <input type="text" class="form-control" id="nametext" aria-describedby="nama" placeholder="Pekerjaan">
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label class="form-">NIP</label>
                                                            <input type="number" class="form-control" id="nametext" aria-describedby="nama" placeholder="NIP">
                                                        </div>
                                                    </form>
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="stepper.next()">
                                                        Lanjut
                                                    </button>
                                                </div>
                                        
                                                <div id="step-4" class="content">
                                                    <form>
                                                    <div class="form-group mb-2">
                                                        <label class="form-" for="inlineFormCustomSelect">Tingkat</label>
                                                        <select class="form-select mr-sm-2" id="inlineFormCustomSelect">
                                                            <option selected>Pilih</option>
                                                            <option value="sd">SD</option>
                                                            <option value="smp">SMP</option>
                                                            <option value="sma">SMA</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="form-">Nama Satuan Pendidikan</label>
                                                        <input type="text" class="form-control" id="nametext" aria-describedby="nama" placeholder="Nama">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="form-">Tahun Lulus</label>
                                                        <input type="month" class="form-control" value="1999-08">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="form-">Gelar</label>
                                                        <input type="text" class="form-control" id="nametext" aria-describedby="nama" placeholder="Nama">
                                                    </div>
                                                </form>
                                                    <button type="submit" class="btn btn-success">
                                                        Simpan
                                                    </button>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.stepper = new Stepper(document.querySelector('#stepper'))
    })
</script>


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
  
@endpush
