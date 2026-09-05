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
    <title>PPDB - Pendaftaran Peserta Didik Baru</title>

    <style>
        :root {
            --nav-blue: #2f5cf0;
            --ppdb-a: #ff9a5a;
            --ppdb-b: #ff6f4d;
        }
    
        body { background: #f6f8fc; }
    
        /* ===== NAVBAR (tetap) ===== */
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
        .ppdb-hero { max-width: 720px; margin: 0 auto; text-align: center; }
        .ppdb-hero h2 { font-weight: 800; font-size: 1.5rem; color: #26314a; margin-bottom: 0.25rem; }
        .ppdb-hero p { font-size: 0.88rem; color: #7a8296; }
    
        /* ===== WRAPPER FORM ===== */
        .ppdb-wrapper { max-width: 640px; margin: 0 auto; }
        .ppdb-card {
            background: #ffffff; border: none; border-radius: 22px;
            box-shadow: 0 10px 30px rgba(16, 40, 100, 0.08);
            padding: 2rem 1.75rem;
        }
    
        /* ===== RESKIN BS-STEPPER (pakai struktur & class aslinya) ===== */
        .bs-stepper-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 2.2rem;
            padding: 0;
        }
    
        .bs-stepper .step {
            flex: 1;
        }
    
        .bs-stepper .step-trigger {
            background: none;
            border: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.4rem;
            padding: 0;
            width: 100%;
        }
    
        .bs-stepper-circle {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            font-weight: 700;
            background: #eceff5 !important;
            color: #9aa4bb !important;
            transition: all .25s ease;
            margin: 0;
        }
    
        .bs-stepper-label {
            font-size: 0.72rem;
            font-weight: 600;
            color: #9aa4bb;
            text-align: center;
            margin-top: 0.35rem;
        }
    
        .step.active .bs-stepper-circle {
            background: linear-gradient(135deg, var(--ppdb-a), var(--ppdb-b)) !important;
            color: #fff !important;
            box-shadow: 0 4px 12px rgba(255, 111, 77, 0.35);
        }
    
        .step.active .bs-stepper-label { color: #ff6f4d; }
    
        .step.crossed .bs-stepper-circle {
            background: #22c55e !important;
            color: #fff !important;
        }
    
        .step.crossed .bs-stepper-label { color: #22c55e; }
    
        /* garis penghubung antar step */
        .bs-stepper-header .line {
            flex: 1;
            height: 3px;
            background: #eceff5;
            border-radius: 3px;
            margin: 17px 6px 0;
            min-width: 20px;
            transition: background .25s ease;
        }
    
        .step.crossed + .line,
        .line.crossed {
            background: linear-gradient(90deg, var(--ppdb-a), var(--ppdb-b));
        }
    
        /* ===== FORM ELEMENTS ===== */
        .ppdb-wrapper .form-label {
            font-size: 0.83rem; font-weight: 600; color: #384056; margin-bottom: 0.35rem;
        }
        .ppdb-wrapper .form-control,
        .ppdb-wrapper .form-select {
            border: 1.5px solid #e7eaf2; border-radius: 12px; padding: 0.6rem 0.9rem;
            font-size: 0.88rem; background: #fbfcfe; transition: all .15s ease;
        }
        .ppdb-wrapper .form-control:focus,
        .ppdb-wrapper .form-select:focus {
            border-color: var(--ppdb-b);
            box-shadow: 0 0 0 3px rgba(255, 111, 77, 0.12);
            background: #fff;
        }
        .ppdb-wrapper .form-text { font-size: 0.74rem; }
        .ppdb-field { margin-bottom: 1.15rem; }
    
        /* ===== BUTTONS ===== */
        .ppdb-btn-next, .ppdb-btn-submit {
            border: none; border-radius: 12px; padding: 0.65rem 1.4rem;
            font-weight: 700; font-size: 0.85rem; color: #fff;
            background: linear-gradient(135deg, var(--ppdb-a), var(--ppdb-b));
            display: inline-flex; align-items: center; gap: 0.4rem;
            transition: transform .15s ease, filter .15s ease;
        }
        .ppdb-btn-next:hover, .ppdb-btn-submit:hover {
            transform: translateY(-2px); filter: brightness(1.05); color: #fff;
        }
        .ppdb-btn-back {
            border: 1.5px solid #e7eaf2; background: #fff; border-radius: 12px;
            padding: 0.65rem 1.4rem; font-weight: 700; font-size: 0.85rem;
            color: #6b7488; transition: all .15s ease;
        }
        .ppdb-btn-back:hover { background: #f4f6fb; color: #384056; }
        .ppdb-actions {
            display: flex; justify-content: space-between; align-items: center; margin-top: 1.6rem;
        }
    
        /* ===== REQUIREMENT CARD (step 2) ===== */
        .req-item {
            border: 1.5px solid #eef0f6; border-radius: 14px;
            padding: 1rem 1.1rem; margin-bottom: 0.9rem; background: #fbfcfe;
        }
        .req-item .form-label { display: flex; align-items: center; gap: 0.4rem; }
        .req-item .form-label::before { content: '📄'; font-size: 0.8rem; }
    
        /* ===== AGREEMENT BOX (step 3) ===== */
        .agreement-box {
            background: #fff7f2; border: 1.5px dashed #ffc9a8; border-radius: 14px;
            padding: 0.9rem 1rem; margin-top: 0.5rem;
        }
        .agreement-box .form-check-label { font-size: 0.82rem; color: #4b5768; }
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
                    <a class="nav-link app-nav-link active" href="/prospective-student/">Dashboard</a>
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
                    <a class="nav-link px-3 py-2 rounded fw-semibold" href="/prospective-student/biodata">Biodata</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded fw-semibold" href="/prospective-student/ppdb">PPDB</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-wrapper overflow-hidden">
        <section class="pt-5 pt-md-8 pt-lg-8 pb-4 pb-md-5 pb-lg-10">
            <div class="container-fluid">

                <div class="ppdb-hero mb-4">
                    <h2>🎒 Pendaftaran PPDB</h2>
                    <p>Lengkapi 3 langkah mudah ini untuk menyelesaikan pendaftaranmu</p>
                </div>

                <div class="ppdb-wrapper">
                    <div class="ppdb-card">
                
                        <div id="stepper" class="bs-stepper">
                            <div class="bs-stepper-header" role="tablist">
                                <div class="step" data-target="#step-1">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label">Sekolah Asal</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#step-2">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">Persyaratan</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#step-3">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">Jurusan</span>
                                    </button>
                                </div>
                            </div>
                
                            <form method="POST" action="/prospective-student/ppdb">
                                <input type="hidden" id="registration_id" value="">
                                @csrf
                
                                <div class="bs-stepper-content">
                                    @include('prospectiveStudent.ppdb_registration.step-one')
                                    @include('prospectiveStudent.ppdb_registration.step-two')
                                    @include('prospectiveStudent.ppdb_registration.step-three')
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
            window.stepper = new Stepper(document.querySelector('#stepper'));

            const steps = document.querySelectorAll('.elegant-step');
            const lineFill = document.getElementById('stepperLineFill');

            function updateStepperUI(index) {
                steps.forEach((el, i) => {
                    el.classList.remove('active', 'done');
                    if (i < index) el.classList.add('done');
                    if (i === index) el.classList.add('active');
                });
                let pct = (index / (steps.length - 1)) * 100;
                lineFill.style.width = pct + '%';
            }

            document.querySelector('#stepper').addEventListener('shown.bs-stepper', function(e) {
                updateStepperUI(e.detail.indexStep);
            });

            updateStepperUI(0);
        });
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