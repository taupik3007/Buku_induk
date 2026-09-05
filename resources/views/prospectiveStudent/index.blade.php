<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />
    <title>Dashboard Pendaftaran</title>

    <style>
        :root {
            --nav-blue: #2f5cf0;
            --biodata-a: #6a8dff;
            --biodata-b: #3d5df2;
            --ppdb-a: #ff9a5a;
            --ppdb-b: #ff6f4d;
        }
    
        body {
            background: #f2f5fc;
        }
    
        /* ===== NAVBAR ===== */
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
    
        .app-logo img {
            height: 32px;
        }
    
        .app-nav-link {
            color: #4b5768;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 0.45rem 0.9rem !important;
            border-radius: 8px;
            transition: all .15s ease;
        }
    
        .app-nav-link:hover {
            background: #eef3ff;
            color: var(--nav-blue);
        }
    
        .app-nav-link.active {
            background: var(--nav-blue);
            color: #fff !important;
        }
    
        .app-nav-logout {
            color: #d64545 !important;
        }
    
        .app-nav-logout:hover {
            background: #fdeaea !important;
            color: #b93030 !important;
        }
    
        /* ===== HERO GREETING ===== */
        .hero-greeting {
            max-width: 880px;
            margin: 0 auto;
        }
    
        .hero-greeting h2 {
            font-weight: 800;
            font-size: 1.5rem;
        }
    
        .hero-emoji {
            display: inline-block;
            animation: wave 1.8s infinite;
            transform-origin: 70% 70%;
        }
    
        @keyframes wave {
            0%, 60%, 100% { transform: rotate(0deg); }
            10% { transform: rotate(14deg); }
            20% { transform: rotate(-8deg); }
            30% { transform: rotate(14deg); }
            40% { transform: rotate(-4deg); }
            50% { transform: rotate(10deg); }
        }
    
        /* ===== FUN CARD (compact + aligned buttons) ===== */
        .cards-row {
            max-width: 800px;
            margin: 0 auto;
        }
    
        .fun-card {
            border: none;
            border-radius: 18px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 8px 22px rgba(16, 40, 100, 0.09);
            transition: transform .25s ease, box-shadow .25s ease;
            max-width: 380px;
            display: flex;
            flex-direction: column;
        }
    
        .fun-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 14px 28px rgba(16, 40, 100, 0.15);
        }
    
        .fun-card-header {
            padding: 1rem 1.1rem 2.4rem;
            color: #fff;
            position: relative;
            overflow: hidden;
            flex-shrink: 0;
        }
    
        .fun-card-header.biodata {
            background: linear-gradient(135deg, var(--biodata-a), var(--biodata-b));
        }
    
        .fun-card-header.ppdb {
            background: linear-gradient(135deg, var(--ppdb-a), var(--ppdb-b));
        }
    
        .fun-card-header .blob {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.15);
        }
    
        .fun-card-header .blob-1 {
            width: 90px; height: 90px;
            top: -30px; right: -25px;
        }
    
        .fun-card-header .blob-2 {
            width: 50px; height: 50px;
            bottom: -15px; right: 45px;
        }
    
        .fun-card-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: rgba(255,255,255,0.22);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }
    
        .fun-card-title {
            font-weight: 800;
            font-size: 1.02rem;
            margin: 0.5rem 0 0.1rem;
        }
    
        .fun-card-sub {
            font-size: 0.74rem;
            opacity: 0.9;
        }
    
        .ring-wrap {
            position: absolute;
            right: 1.1rem;
            bottom: -24px;
            width: 50px;
            height: 50px;
        }
    
        .progress-ring {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            box-shadow: 0 5px 12px rgba(16, 40, 100, 0.18);
        }
    
        .progress-ring::before {
            content: '';
            position: absolute;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: conic-gradient(var(--ring-color, #2f5cf0) calc(var(--pct, 0) * 1%), #e9edf7 0);
            -webkit-mask: radial-gradient(farthest-side, transparent calc(100% - 5px), #000 calc(100% - 5px));
            mask: radial-gradient(farthest-side, transparent calc(100% - 5px), #000 calc(100% - 5px));
        }
    
        .progress-ring span {
            position: relative;
            font-weight: 800;
            font-size: 0.7rem;
            color: #26314a;
        }
    
        /* body ngisi sisa tinggi card, checklist yang "makan" ruang kosong,
           tombol otomatis kedorong rata bawah */
        .fun-card-body {
            padding: 1.9rem 1.1rem 1.1rem;
            display: flex;
            flex-direction: column;
            flex: 1;
        }
    
        .checklist-wrap {
            display: flex;
            flex-direction: column;
            gap: 0.15rem;
            flex: 1;
            margin-bottom: 1rem;
        }
    
        .check-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.3rem 0.4rem;
            border-radius: 8px;
            font-size: 0.83rem;
            transition: background .15s ease;
        }
    
        .check-item:hover {
            background: #f4f6fb;
        }
    
        .check-dot {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.6rem;
            flex-shrink: 0;
        }
    
        .check-dot.done {
            background: #22c55e;
            color: #fff;
        }
    
        .check-dot.pending {
            background: #e9edf7;
            color: #9aa4bb;
            border: 1.5px dashed #cfd6e6;
        }
    
        .fun-btn {
            border: none;
            border-radius: 12px;
            padding: 0.55rem 1rem;
            font-weight: 700;
            font-size: 0.83rem;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            width: 100%;
            flex-shrink: 0;
            transition: transform .15s ease, filter .15s ease;
        }
    
        .fun-btn:hover {
            transform: translateY(-2px);
            filter: brightness(1.05);
            color: #fff;
        }
    
        .fun-btn.biodata-btn {
            background: linear-gradient(135deg, var(--biodata-a), var(--biodata-b));
        }
    
        .fun-btn.ppdb-btn {
            background: linear-gradient(135deg, var(--ppdb-a), var(--ppdb-b));
        }
    
        .fun-btn.disabled-btn {
            background: #e2e6ef;
            color: #9aa4bb;
            cursor: not-allowed;
        }
    
        .fun-btn .arrow {
            transition: transform .15s ease;
        }
    
        .fun-btn:hover .arrow {
            transform: translateX(3px);
        }
    
        .confetti-badge {
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            background: rgba(255,255,255,0.25);
            padding: 0.2rem 0.55rem;
            border-radius: 999px;
            font-size: 0.65rem;
            font-weight: 700;
        }
        .app-logo {
        display: flex;
        align-items: center;
        position: relative;
        overflow: visible;
    }
    
    .app-logo img {
        width: 60px !important;
        height: auto !important;
    }
    
    /* Tulisan SIMAPPUT */
    .simapput-text {
        margin-left: 8px;
        font-size: 22px;
        font-weight: 700;
        letter-spacing: 1px;
    
        opacity: 0;
        transform: translateX(-20px);
    
        animation: simapputSlide 0.8s ease forwards;
    }
    
    @keyframes simapputSlide {
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    /* Daun di ujung tulisan */
    .leaf-popup {
        margin-left: 5px;
        font-size: 22px;
    
        opacity: 0;
        transform: scale(0) rotate(-30deg);
    
        animation: leafPop 0.6s ease 0.7s forwards;
    }
    
    @keyframes leafPop {
        0% {
            opacity: 0;
            transform: scale(0) rotate(-30deg);
        }
    
        70% {
            opacity: 1;
            transform: scale(1.3) rotate(10deg);
        }
    
        100% {
            opacity: 1;
            transform: scale(1) rotate(0);
        }
    }
    </style>
</head>

<body>

    <div class="preloader">
        <img src="{{ asset('assets/images/logos/favicon.png') }}" alt="loader" class="lds-ripple img-fluid" />
    </div>

    {{-- ===== NAVBAR ===== --}}
    <header class="app-header w-100">
        <nav class="navbar navbar-expand-lg app-navbar">
            <a href="../main/frontend-landingpage.html" class="app-logo text-nowrap">
                <img src="{{ asset('assets/images/logos/1.png') }}" 
                     class="dark-logo" 
                     alt="Logo-Dark" />
            
                <img src="{{ asset('assets/images/logos/1.png') }}" 
                     class="light-logo" 
                     alt="Logo-light" />
            
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
                <li class="nav-item"><a class="nav-link app-nav-link" href="#">Dashboard</a></li>
                <li class="nav-item">
                    <a href="#" class="nav-link app-nav-link app-nav-logout"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-wrapper overflow-hidden">
        <section class="pt-5 pt-md-8 pt-lg-8 pb-4 pb-md-5 pb-lg-10">
            <div class="container-fluid">

                {{-- HERO GREETING --}}
                <div class="hero-greeting mb-4 text-center">
                    <h2 class="mb-1"><span class="hero-emoji">👋</span> Halo, Calon Siswa!</h2>
                    <p class="text-muted mb-0" style="font-size:0.9rem;">Yuk lengkapi data kamu selangkah demi selangkah, biar makin dekat ke sekolah impian ✨</p>
                </div>

                <div class="row g-3 justify-content-center cards-row align-items-stretch">

                    {{-- CARD BIODATA --}}
                    <div class="col-sm-6 col-lg-5 d-flex justify-content-center">
                        <div class="fun-card w-100">
                            <div class="fun-card-header biodata">
                                <div class="blob blob-1"></div>
                                <div class="blob blob-2"></div>
                                @if($biodataProgress == 100)
                                    <div class="confetti-badge">🎉 Lengkap!</div>
                                @endif
                                <div class="fun-card-icon">🧑‍🎓</div>
                                <div class="fun-card-title">Biodata Diri</div>
                                <div class="fun-card-sub">Data pribadi, alamat, & keluarga</div>

                                <div class="ring-wrap">
                                    <div class="progress-ring" style="--pct: {{ $biodataProgress }}; --ring-color: #3d5df2;">
                                        <span>{{ $biodataProgress }}%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="fun-card-body">
                                <div class="checklist-wrap">
                                    @foreach ($biodataChecklist as $label => $isDone)
                                        <div class="check-item">
                                            <span class="check-dot {{ $isDone ? 'done' : 'pending' }}">
                                                @if($isDone)
                                                    <i class="ti ti-check"></i>
                                                @endif
                                            </span>
                                            <span class="{{ $isDone ? 'fw-semibold' : 'text-muted' }}">{{ $label }}</span>
                                        </div>
                                    @endforeach
                                </div>

                                <a href="/prospective-student/biodata" class="fun-btn biodata-btn">
                                    {{ $biodataProgress == 100 ? 'Lihat / Ubah Biodata' : 'Lengkapi Biodata' }}
                                    <span class="arrow">→</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- CARD PPDB --}}
                    <div class="col-sm-6 col-lg-5 d-flex justify-content-center">
                        <div class="fun-card w-100">
                            <div class="fun-card-header ppdb">
                                <div class="blob blob-1"></div>
                                <div class="blob blob-2"></div>
                                @if($ppdbProgress == 100)
                                    <div class="confetti-badge">🎉 Lengkap!</div>
                                @elseif(!$ppdbOpen)
                                    <div class="confetti-badge">🔒 Belum Buka</div>
                                @endif
                                <div class="fun-card-icon">🏫</div>
                                <div class="fun-card-title">PPDB / SPMB</div>
                                <div class="fun-card-sub">Sekolah asal, persyaratan, & jurusan</div>

                                <div class="ring-wrap">
                                    <div class="progress-ring" style="--pct: {{ $ppdbProgress }}; --ring-color: #ff6f4d;">
                                        <span>{{ $ppdbProgress }}%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="fun-card-body">
                                <div class="checklist-wrap">
                                    @foreach ($ppdbChecklist as $label => $isDone)
                                        <div class="check-item">
                                            <span class="check-dot {{ $isDone ? 'done' : 'pending' }}">
                                                @if($isDone)
                                                    <i class="ti ti-check"></i>
                                                @endif
                                            </span>
                                            <span class="{{ $isDone ? 'fw-semibold' : 'text-muted' }}">{{ $label }}</span>
                                        </div>
                                    @endforeach
                                </div>

                                @if ($ppdbOpen)
                                    <a href="/prospective-student/ppdb-registration" class="fun-btn ppdb-btn">
                                        {{ $ppdbProgress == 100 ? 'Lihat / Ubah PPDB' : 'Lengkapi PPDB' }}
                                        <span class="arrow">→</span>
                                    </a>
                                @else
                                    <button class="fun-btn disabled-btn" disabled>
                                        🔒 SPMB Belum Dibuka
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme/app.init.js') }}"></script>
    <script src="{{ asset('assets/js/theme/theme.js') }}"></script>
    <script src="{{ asset('assets/js/theme/app.min.js') }}"></script>

</body>

</html>