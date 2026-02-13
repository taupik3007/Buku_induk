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
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 gap-xl-7 gap-8 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link fs-4 fw-bold text-dark link-primary"
                                href="../main/frontend-aboutpage.html">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fs-4 fw-bold text-dark link-primary"
                                href="../main/frontend-blogpage.html">Blog</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link fs-4 fw-bold text-dark link-primary d-flex gap-2"
                                href="../main/frontend-portfoliopage.html">Portfolio
                                <span class="badge text-primary bg-primary-subtle fs-2 fw-bolder hstack">New</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-4 fw-bold text-dark link-primary"
                                href="../main/index.html">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-4 fw-bold text-dark link-primary"
                                href="../main/frontend-pricingpage.html">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-4 fw-bold text-dark link-primary"
                                href="../main/frontend-contactpage.html">Contact</a>
                        </li>
                    </ul>
                    <div>
                        <a href="../main/authentication-login.html" class="btn btn-primary py-8 px-9">Log In</a>
                    </div>
                </div>
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
                                                    <input name="nama" class="form-control mb-3">
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="stepper.next()">
                                                        Lanjut
                                                    </button>
                                                </div>
                                                <div id="step-2" class="content">
                                                    <input name="alamat" class="form-control mb-3">
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="stepper.next()">
                                                        Lanjut
                                                    </button>
                                                </div>
                                                <div id="step-3" class="content">
                                                    <input name="alamat" class="form-control mb-3">
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="stepper.next()">
                                                        Lanjut
                                                    </button>
                                                </div>
                                                <div id="step-4" class="content">
                                                    <input name="alamat" class="form-control mb-3">
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="stepper.next()">
                                                        Lanjut
                                                    </button>
                                                </div>

                                                <div id="step-5" class="content">
                                                    <input name="alamat" class="form-control mb-3">
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
