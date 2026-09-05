<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
    <link rel="stylesheet" href="{{ asset('assets/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}" />
    <title>Pendaftaran Biodata</title>

    <style>
        :root {
            --nav-blue: #2f5cf0;
            --bio-a: #6a8dff;
            --bio-b: #3d5df2;
        }

        body { background: #f6f8fc; }

        /* ===== NAVBAR (sama kayak halaman lain) ===== */
        .app-header {
            background: #ffffff;
            border-bottom: 1px solid #eef1f7;
            box-shadow: 0 2px 10px rgba(16, 40, 100, 0.05);
        }
        .app-navbar {
            width: 100%;
            padding: 0.65rem 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .app-logo { display: flex; align-items: center; position: relative; overflow: visible; }
        .app-logo img { width: 60px !important; height: auto !important; }
        .simapput-text {
            margin-left: 8px; font-size: 22px; font-weight: 700; letter-spacing: 1px;
            color: var(--nav-blue);
            opacity: 0; transform: translateX(-20px);
            animation: simapputSlide 0.8s ease forwards;
        }
        @keyframes simapputSlide { to { opacity: 1; transform: translateX(0); } }
        .leaf-popup {
            margin-left: 5px; font-size: 22px;
            opacity: 0; transform: scale(0) rotate(-30deg);
            animation: leafPop 0.6s ease 0.7s forwards;
        }
        @keyframes leafPop {
            0% { opacity: 0; transform: scale(0) rotate(-30deg); }
            70% { opacity: 1; transform: scale(1.3) rotate(10deg); }
            100% { opacity: 1; transform: scale(1) rotate(0); }
        }
        .app-nav-link {
            color: #4b5768; font-weight: 500; font-size: 0.9rem;
            padding: 0.45rem 0.9rem !important; border-radius: 8px; transition: all .15s ease;
        }
        .app-nav-link:hover { background: #eef3ff; color: var(--nav-blue); }
        .app-nav-link.active { background: var(--nav-blue); color: #fff !important; }
        .app-nav-logout { color: #d64545 !important; }
        .app-nav-logout:hover { background: #fdeaea !important; color: #b93030 !important; }

        /* ===== PAGE HEADER ===== */
        .bio-hero { max-width: 720px; margin: 0 auto; text-align: center; }
        .bio-hero h2 { font-weight: 800; font-size: 1.5rem; color: #26314a; margin-bottom: 0.25rem; }
        .bio-hero p { font-size: 0.88rem; color: #7a8296; }

        /* ===== WRAPPER FORM ===== */
        .bio-wrapper { max-width: 640px; margin: 0 auto; }
        .bio-card {
            background: #ffffff; border: none; border-radius: 22px;
            box-shadow: 0 10px 30px rgba(16, 40, 100, 0.08);
            padding: 2rem 1.75rem;
        }

        /* ===== RESKIN BS-STEPPER (sama struktur, warna biru) ===== */
        .bs-stepper-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 2.2rem;
            padding: 0;
            flex-wrap: nowrap;
        }
        .bs-stepper .step { flex: 1; min-width: 0; }
        .bs-stepper .step-trigger {
            background: none; border: none;
            display: flex; flex-direction: column; align-items: center; gap: 0.4rem;
            padding: 0; width: 100%;
        }
        .bs-stepper-circle {
            width: 32px; height: 32px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.8rem; font-weight: 700;
            background: #eceff5 !important; color: #9aa4bb !important;
            transition: all .25s ease; margin: 0;
        }
        .bs-stepper-label {
            font-size: 0.66rem; font-weight: 600; color: #9aa4bb;
            text-align: center; margin-top: 0.3rem; line-height: 1.2;
        }
        .step.active .bs-stepper-circle {
            background: linear-gradient(135deg, var(--bio-a), var(--bio-b)) !important;
            color: #fff !important;
            box-shadow: 0 4px 12px rgba(61, 93, 242, 0.35);
        }
        .step.active .bs-stepper-label { color: var(--bio-b); }
        .step.crossed .bs-stepper-circle {
            background: #22c55e !important; color: #fff !important;
        }
        .step.crossed .bs-stepper-label { color: #22c55e; }

        .bs-stepper-header .line {
            flex: 1; height: 3px; background: #eceff5; border-radius: 3px;
            margin: 16px 4px 0; min-width: 12px; transition: background .25s ease;
        }
        .step.crossed + .line, .line.crossed {
            background: linear-gradient(90deg, var(--bio-a), var(--bio-b));
        }

        /* ===== FORM ELEMENTS ===== */
        .bio-wrapper .form-label {
            font-size: 0.83rem; font-weight: 600; color: #384056; margin-bottom: 0.35rem;
        }
        .bio-wrapper .form-control,
        .bio-wrapper .form-select {
            border: 1.5px solid #e7eaf2; border-radius: 12px; padding: 0.6rem 0.9rem;
            font-size: 0.88rem; background: #fbfcfe; transition: all .15s ease;
        }
        .bio-wrapper .form-control:focus,
        .bio-wrapper .form-select:focus {
            border-color: var(--bio-b);
            box-shadow: 0 0 0 3px rgba(61, 93, 242, 0.12);
            background: #fff;
        }
        .bio-wrapper .form-text { font-size: 0.74rem; }
        .bio-field { margin-bottom: 1.1rem; }

        /* ===== BUTTONS ===== */
        .bio-btn-next, .bio-btn-submit {
            border: none; border-radius: 12px; padding: 0.65rem 1.4rem;
            font-weight: 700; font-size: 0.85rem; color: #fff;
            background: linear-gradient(135deg, var(--bio-a), var(--bio-b));
            display: inline-flex; align-items: center; gap: 0.4rem;
            transition: transform .15s ease, filter .15s ease;
        }
        .bio-btn-next:hover, .bio-btn-submit:hover {
            transform: translateY(-2px); filter: brightness(1.05); color: #fff;
        }
        .bio-btn-back {
            border: 1.5px solid #e7eaf2; background: #fff; border-radius: 12px;
            padding: 0.65rem 1.4rem; font-weight: 700; font-size: 0.85rem;
            color: #6b7488; transition: all .15s ease;
        }
        .bio-btn-back:hover { background: #f4f6fb; color: #384056; }
        .bio-actions {
            display: flex; justify-content: space-between; align-items: center; margin-top: 1.6rem;
        }
        /* Ratakan tinggi label di baris "Data Saudara" khusus desktop */
@media (min-width: 768px) {
    .saudara-row {
        display: flex;
        align-items: stretch;
    }

    .saudara-row .form-label {
        min-height: 2.6rem;
        display: flex;
        align-items: flex-end;
    }
}
    </style>
</head>

<body>

    <div class="preloader">
        <img src="{{ asset('assets/images/logos/favicon.png') }}" alt="loader" class="lds-ripple img-fluid" />
    </div>

    <header class="app-header w-100">
        <nav class="navbar navbar-expand-lg app-navbar">
            <a href="../main/frontend-landingpage.html" class="app-logo text-nowrap">
                <img src="{{ asset('assets/images/logos/1.png') }}" class="dark-logo" alt="Logo-Dark" />
                <img src="{{ asset('assets/images/logos/1.png') }}" class="light-logo" alt="Logo-light" />
                <span class="simapput-text">SIMAPPUT</span>
                <span class="leaf-popup">🍃</span>
            </a>

            <ul class="navbar-nav d-none d-lg-flex flex-row align-items-center gap-1 mb-0">
                <li class="nav-item">
                    <a class="nav-link app-nav-link active" href="/prospective-student/biodata">Biodata</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link app-nav-link app-nav-logout"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>

                @if ($ppdb && $isComplited )
                    <li class="nav-item">
                        <a class="nav-link app-nav-link" href="/prospective-student/ppdb-registration">
                            PPDB
                        </a>
                    </li>
                @endif
            </ul>

            <button class="navbar-toggler border-0 p-0 shadow-none d-lg-none" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                <i class="ti ti-menu-2 fs-6"></i>
            </button>
        </nav>
    </header>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav gap-1">
                <li class="nav-item">
                    <a class="nav-link app-nav-link" href="/prospective-student/biodata">Biodata</a>
                </li>
                @if ($ppdb && $isComplited == null)
                    <li class="nav-item">
                        <a class="nav-link app-nav-link" href="/prospective-student/ppdb-registration">PPDB</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>

    <div class="main-wrapper overflow-hidden">
        <section class="pt-5 pt-md-8 pt-lg-8 pb-4 pb-md-5 pb-lg-10">
            <div class="container-fluid">

                <div class="bio-hero mb-4">
                    <h2>🧑‍🎓 Lengkapi Biodata</h2>
                    <p>Isi data diri kamu langkah demi langkah, jangan sampai ada yang terlewat ya!</p>
                </div>

                <div class="bio-wrapper">
                    <div class="bio-card">

                        <div id="stepper" class="bs-stepper">
                            <div class="bs-stepper-header" role="tablist">
                                <div class="step" data-target="#step-1">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label">Data Diri</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#step-2">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">Alamat</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#step-3">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">Fisik</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#step-4">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">4</span>
                                        <span class="bs-stepper-label">Ayah</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#step-5">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">5</span>
                                        <span class="bs-stepper-label">Ibu</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#step-6">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">6</span>
                                        <span class="bs-stepper-label">Wali</span>
                                    </button>
                                </div>
                            </div>

                            <form method="POST" action="/register">
                                <input type="hidden" id="registration_id" value="">
                                @csrf

                                <div class="bs-stepper-content">
                                    @include('prospectiveStudent.step-one')
                                    @include('prospectiveStudent.step-two')
                                    @include('prospectiveStudent.step-three')
                                    @include('prospectiveStudent.step-four')
                                    @include('prospectiveStudent.step-five')
                                    @include('prospectiveStudent.step-six')
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </section>
    </div>

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
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme/app.init.js') }}"></script>
    <script src="{{ asset('assets/js/theme/theme.js') }}"></script>
    <script src="{{ asset('assets/js/theme/app.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <script src="{{ asset('assets/libs/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/frontend-landingpage/homepage.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
    <script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/forms/select2.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>