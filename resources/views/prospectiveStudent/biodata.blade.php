<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />

    <!-- Core Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">


    <title>Modernize Bootstrap Admin</title>
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="{{ asset('assets/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}" />
</head>

<body>


    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('assets/images/logos/favicon.png') }}" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!-- ------------------------------------- -->
    <!-- Top Bar Start -->
    <!-- ------------------------------------- -->

    <!-- ------------------------------------- -->
    <!-- Top Bar End -->
    <!-- ------------------------------------- -->

    <!-- ------------------------------------- -->
    <!-- Header Start -->
    <!-- ------------------------------------- -->
    <header class="header-fp p-0 w-100">
        <nav class="navbar navbar-expand-lg bg-primary-subtle py-2 py-lg-10">
            <div class="custom-container d-flex align-items-center justify-content-between">
                <a href="../main/frontend-landingpage.html" class="text-nowrap logo-img">
                    <img src="../assets/images/logos/dark-logo.svg" class="dark-logo" alt="Logo-Dark" />
                    <img src="../assets/images/logos/light-logo.svg" class="light-logo" alt="Logo-light" />
                </a>
                <button class="navbar-toggler border-0 p-0 shadow-none" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <i class="ti ti-menu-2 fs-8"></i>
                </button>
                
            </div>
        </nav>
    </header>
    <!-- ------------------------------------- -->
    <!-- Header End -->
    <!-- ------------------------------------- -->

    <!-- ------------------------------------- -->
    <!-- Responsive Sidebar Start -->
    <!-- ------------------------------------- -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <a href="../main/frontend-landingpage.html">
                <img src="../assets/images/logos/dark-logo.svg" alt="Logo-light" />
            </a>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-unstyled ps-0">
                <li class="mb-1">
                    <a href="../main/frontend-aboutpage.html"
                        class="px-0 fs-4 d-block text-dark link-primary w-100 py-2">
                        About Us
                    </a>
                </li>

                <li class="mb-1">
                    <a href="../main/frontend-blogpage.html"
                        class="px-0 fs-4 d-block w-100 py-2 text-dark link-primary">
                        Blog
                    </a>
                </li>

                <li class="mb-1">
                    <a href="../main/frontend-portfoliopage.html"
                        class="px-0 fs-4 d-flex align-items-center justify-content-start gap-2 w-100 py-2 text-dark link-primary">
                        Portfolio
                        <span class="badge text-primary bg-primary-subtle fs-2 fw-bolder hstack">New</span>
                    </a>
                </li>

                <li class="mb-1">
                    <a href="../main/index.html" class="px-0 fs-4 d-block w-100 py-2 text-dark link-primary">
                        Dashboard
                    </a>
                </li>

                <li class="mb-1">
                    <a href="../main/frontend-pricingpage.html"
                        class="px-0 fs-4 d-block w-100 py-2 text-dark link-primary">
                        Pricing
                    </a>
                </li>

                <li class="mb-1">
                    <a href="../main/frontend-contactpage.html"
                        class="px-0 fs-4 d-block w-100 py-2 text-dark link-primary">
                        Contact
                    </a>
                </li>
                <li class="mt-3">
                    <a href="../main/authentication-login.html" class="btn btn-primary w-100">Log In</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- ------------------------------------- -->
    <!-- Responsive Sidebar End -->
    <!-- ------------------------------------- -->

    <div class="main-wrapper overflow-hidden">
        <!-- ------------------------------------- -->
        <!-- banner Start -->
        <!-- ------------------------------------- -->

        <!-- ------------------------------------- -->
        <!-- banner End -->
        <!-- ------------------------------------- -->

        <!-- ------------------------------------- -->
        <!-- List Start -->
        <!-- ------------------------------------- -->
        <section class="pt-5 pt-md-14 pt-lg-12 pb-4 pb-md-5 pb-lg-14">
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
                                                    <span class="bs-stepper-label">Kondisi Fisik</span>
                                                </button>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#step-4">
                                                <button class="step-trigger">
                                                    <span class="bs-stepper-circle">4</span>
                                                    <span class="bs-stepper-label">Data Ayah</span>
                                                </button>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#step-5">
                                                <button class="step-trigger">
                                                    <span class="bs-stepper-circle">5</span>
                                                    <span class="bs-stepper-label">Data Ibu</span>
                                                </button>
                                            </div>
                                            <div class="line"></div>

                                            <div class="step" data-target="#step-6">
                                                <button class="step-trigger">
                                                    <span class="bs-stepper-circle">6</span>
                                                    <span class="bs-stepper-label">Data Wali</span>
                                                </button>
                                            </div>

                                        </div>

                                        <form method="POST" action="/register">
                                            @csrf

                                            <div class="bs-stepper-content">

                                                <div id="step-1" class="content">
                                                    <div class="mb-3">
                                                        <label class="mr-sm-2 mb-3" for="inlineFormCustomSelect">Jenis
                                                            Kelamin</label>
                                                        <select class="form-select mr-sm-2"
                                                            id="inlineFormCustomSelect">
                                                            <option selected>Pilih ..</option>
                                                            <option value="1">Laki - laki</option>
                                                            <option value="2">perempuan</option>

                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mr-sm-2 mb-3"
                                                            for="inlineFormCustomSelect">Tempat Lahir</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mr-sm-2 mb-3"
                                                            for="inlineFormCustomSelect">Tenggal lahir</label>
                                                        <input type="date" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mr-sm-2 mb-3"
                                                            for="inlineFormCustomSelect">Agama</label>
                                                        <select class="form-select mr-sm-2"
                                                            id="inlineFormCustomSelect">
                                                            <option selected>Pilih ..</option>
                                                            <option value="1">Islam</option>
                                                            <option value="2">Lain lain</option>

                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mr-sm-2 mb-3" for="inlineFormCustomSelect">Anak
                                                            ke</label>
                                                        <input type="number" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mr-sm-2 mb-3" for="inlineFormCustomSelect">Dari
                                                            berapa bersaudara</label>
                                                        <input type="number" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mr-sm-2 mb-3"
                                                            for="inlineFormCustomSelect">Jumlah Saudara tiri</label>
                                                        <input type="number" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mr-sm-2 mb-3"
                                                            for="inlineFormCustomSelect">Jumlah Saudara Angkat</label>
                                                        <input type="number" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mr-sm-2 mb-3"
                                                            for="inlineFormCustomSelect">Status Keluarga</label>
                                                        <select class="form-select mr-sm-2"
                                                            id="inlineFormCustomSelect">
                                                            <option selected>Pilih ..</option>
                                                            <option value="1">Islam</option>
                                                            <option value="2">Lain lain</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mr-sm-2 mb-3"
                                                            for="inlineFormCustomSelect">Bahasa Sehari hari</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mr-sm-2 mb-3"
                                                            for="inlineFormCustomSelect">telp</label>
                                                        <input type="tel" class="form-control"
                                                            value="1-(444)-444-4445">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mr-sm-2 mb-3"
                                                            for="inlineFormCustomSelect">Tinggal</label>
                                                        <select class="form-select mr-sm-2"
                                                            id="inlineFormCustomSelect">
                                                            <option selected>Pilih ..</option>
                                                            <option value="1">Bersama Orangtua</option>
                                                            <option value="2">Tidak Dengan orang tua</option>
                                                        </select>
                                                    </div>
                                                   

                                                    <button type="button" class="btn btn-primary"
                                                        onclick="stepper.next()">
                                                        Lanjut
                                                    </button>
                                                </div>


                                                {{-- step 2 --}}


                                                <div id="step-2" class="content">
                                                    <div class="mb-3">
                                                        <label class="mr-sm-2 mb-3"
                                                            for="inlineFormCustomSelect">Provinsi</label>
                                                        <select class="form-select mr-sm-2"
                                                            id="inlineFormCustomSelect">
                                                            <option selected>Pilih ..</option>
                                                            <option value="1">Laki - laki</option>
                                                            <option value="2">perempuan</option>

                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mr-sm-2 mb-3"
                                                            for="inlineFormCustomSelect">kabupaten/Kota</label>
                                                        <select class="form-select mr-sm-2"
                                                            id="inlineFormCustomSelect">
                                                            <option selected>Pilih ..</option>
                                                            <option value="1">Laki - laki</option>
                                                            <option value="2">perempuan</option>

                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mr-sm-2 mb-3"
                                                            for="inlineFormCustomSelect">kecamatan</label>
                                                        <select class="form-select mr-sm-2"
                                                            id="inlineFormCustomSelect">
                                                            <option selected>Pilih ..</option>
                                                            <option value="1">Laki - laki</option>
                                                            <option value="2">perempuan</option>

                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mr-sm-2 mb-3"
                                                            for="inlineFormCustomSelect">Desa</label>
                                                        <select class="form-select mr-sm-2"
                                                            id="inlineFormCustomSelect">
                                                            <option selected>Pilih ..</option>
                                                            <option value="1">Laki - laki</option>
                                                            <option value="2">perempuan</option>

                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mr-sm-2 mb-3" for="inlineFormCustomSelect">Kode
                                                            pos</label>
                                                        <select class="form-select mr-sm-2"
                                                            id="inlineFormCustomSelect">
                                                            <option selected>Pilih ..</option>
                                                            <option value="1">Laki - laki</option>
                                                            <option value="2">perempuan</option>

                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mr-sm-2 mb-3" for="inlineFormCustomSelect">Jarak
                                                            Rumah ke Sekolah</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mr-sm-2 mb-3" for="inlineFormCustomSelect">Jarak
                                                            Rumah ke Sekolah</label>
                                                        <textarea class="form-control" rows="3"></textarea>
                                                    </div>
                                                    <button type="button" class="btn btn-secondary"
                                                        onclick="stepper.previous()">
                                                        Kembali
                                                    </button>

                                                    <button type="button" class="btn btn-primary"
                                                        onclick="stepper.next()">
                                                        Lanjut
                                                    </button>
                                                </div>

                                                {{-- step 3  --}}

                                                <div id="step-3" class="content">
                                                    <div class="mb-3">
                                                        <label class="mr-sm-2 mb-3"
                                                            for="inlineFormCustomSelect">Golongan Darah</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mr-sm-2 mb-3"
                                                            for="inlineFormCustomSelect">Penyakit Bawaan</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mr-sm-2 mb-3"
                                                            for="inlineFormCustomSelect">kelainan Jasmani</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mr-sm-2 mb-3"
                                                            for="inlineFormCustomSelect">Tinggi Badan</label>
                                                        <input type="number" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="mr-sm-2 mb-3" for="inlineFormCustomSelect">Berat
                                                            badan</label>
                                                        <input type="number" class="form-control">
                                                    </div>
                                                    <button type="button" class="btn btn-secondary"
                                                        onclick="stepper.previous()">
                                                        Kembali
                                                    </button>
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="stepper.next()">
                                                        Lanjut
                                                    </button>
                                                </div>



                                                {{-- step 4 --}}
                                                <div id="step-4" class="content">
                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Nama Ayah</label>
                                                        <input type="text" name="nama" class="form-control"
                                                            placeholder="Nama lengkap">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Kewarganegaraan</label>
                                                        <input type="text" name="kewarganegaraan"
                                                            class="form-control" placeholder="Contoh: Indonesia">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Pendidikan</label>
                                                        <input type="text" name="pendidikan" class="form-control"
                                                            placeholder="Pendidikan terakhir">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Pekerjaan</label>
                                                        <input type="text" name="pekerjaan" class="form-control"
                                                            placeholder="Pekerjaan saat ini">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Penghasilan</label>
                                                        <input type="number" name="penghasilan" class="form-control"
                                                            placeholder="Penghasilan per bulan">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Alamat</label>
                                                        <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat lengkap"></textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Nomor Telepon</label>
                                                        <input type="number" name="telepon" class="form-control"
                                                            placeholder="08xxxxxxxxxx">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Status</label>
                                                        <input type="text" name="status" class="form-control"
                                                            placeholder="Contoh: Menikah / Belum Menikah">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Keadaan</label>
                                                        <input type="text" name="keadaan" class="form-control"
                                                            placeholder="Keterangan kondisi saat ini">
                                                    </div>
                                                    <button type="button" class="btn btn-secondary"
                                                        onclick="stepper.previous()">
                                                        Kembali
                                                    </button>

                                                    <button type="button" class="btn btn-primary"
                                                        onclick="stepper.next()">
                                                        Lanjut
                                                    </button>
                                                </div>


                                                {{-- step 5 --}}
                                                <div id="step-5" class="content">
                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Nama Ibu</label>
                                                        <input type="text" name="ibu_nama" class="form-control"
                                                            placeholder="Nama lengkap ibu">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Kewarganegaraan</label>
                                                        <input type="text" name="ibu_kewarganegaraan"
                                                            class="form-control" placeholder="Contoh: Indonesia">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Pendidikan</label>
                                                        <input type="text" name="ibu_pendidikan"
                                                            class="form-control" placeholder="Pendidikan terakhir">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Pekerjaan</label>
                                                        <input type="text" name="ibu_pekerjaan"
                                                            class="form-control" placeholder="Pekerjaan saat ini">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Penghasilan</label>
                                                        <input type="number" name="ibu_penghasilan"
                                                            class="form-control" placeholder="Penghasilan per bulan">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Alamat</label>
                                                        <textarea name="ibu_alamat" class="form-control" rows="3" placeholder="Alamat lengkap"></textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Nomor Telepon</label>
                                                        <input type="text" name="ibu_telepon" class="form-control"
                                                            placeholder="08xxxxxxxxxx">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Status</label>
                                                        <input type="text" name="ibu_status" class="form-control"
                                                            placeholder="Contoh: Menikah / Janda">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Keadaan</label>
                                                        <input type="text" name="ibu_keadaan" class="form-control"
                                                            placeholder="Keterangan kondisi saat ini">
                                                    </div>
                                                    <button type="button" class="btn btn-secondary"
                                                        onclick="stepper.previous()">
                                                        Kembali
                                                    </button>

                                                    <button type="button" class="btn btn-primary"
                                                        onclick="stepper.next()">
                                                        Lanjut
                                                    </button>
                                                </div>


                                                {{-- step 6 --}}
                                                <div id="step-6" class="content">
                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Nama Wali</label>
                                                        <input type="text" name="wali_nama" class="form-control"
                                                            placeholder="Nama lengkap wali">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Kewarganegaraan</label>
                                                        <input type="text" name="wali_kewarganegaraan"
                                                            class="form-control" placeholder="Contoh: Indonesia">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Pendidikan</label>
                                                        <input type="text" name="wali_pendidikan"
                                                            class="form-control" placeholder="Pendidikan terakhir">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Pekerjaan</label>
                                                        <input type="text" name="wali_pekerjaan"
                                                            class="form-control" placeholder="Pekerjaan saat ini">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Penghasilan</label>
                                                        <input type="number" name="wali_penghasilan"
                                                            class="form-control" placeholder="Penghasilan per bulan">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Alamat</label>
                                                        <textarea name="wali_alamat" class="form-control" rows="3" placeholder="Alamat lengkap"></textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Nomor Telepon</label>
                                                        <input type="text" name="wali_telepon"
                                                            class="form-control" placeholder="08xxxxxxxxxx">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Status</label>
                                                        <input type="text" name="wali_status" class="form-control"
                                                            placeholder="Contoh: Paman / Bibi / Saudara">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label mb-2">Keadaan</label>
                                                        <input type="text" name="wali_keadaan"
                                                            class="form-control"
                                                            placeholder="Keterangan kondisi saat ini">
                                                    </div>

                                                    <button type="button" class="btn btn-secondary"
                                                        onclick="stepper.previous()">
                                                        Kembali
                                                    </button>

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

</body>

</html>
