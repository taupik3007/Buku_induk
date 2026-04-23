<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SMA Negeri Nusantara — Sekolah Unggulan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=DM+Serif+Display:ital@0;1&display=swap"
        rel="stylesheet" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        serif: ['DM Serif Display', 'serif'],
                    },
                    colors: {
                        blue: {
                            50: '#EFF6FF',
                            100: '#DBEAFE',
                            200: '#BFDBFE',
                            300: '#93C5FD',
                            400: '#60A5FA',
                            500: '#3B82F6',
                            600: '#2563EB',
                            700: '#1D4ED8',
                            800: '#1E40AF',
                            900: '#1E3A8A',
                            950: '#172554',
                        },
                    },
                },
            },
        }
    </script>
    <style>
        html {
            scroll-behavior: smooth;
        }

        .hero-bg {
            background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 40%, #2563eb 70%, #1e40af 100%);
        }

        .glass {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .card-hover {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(37, 99, 235, 0.15);
        }

        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #60a5fa;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .section-label {
            letter-spacing: 0.15em;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            color: #2563eb;
        }

        .stat-num {
            font-family: 'DM Serif Display', serif;
            font-size: 2.8rem;
            line-height: 1;
            color: #1e3a8a;
        }

        .tab-btn {
            transition: all 0.2s;
        }

        .tab-btn.active {
            background: #1d4ed8;
            color: #fff;
        }

        .tab-btn:not(.active) {
            background: #eff6ff;
            color: #1d4ed8;
        }

        .fade-in {
            animation: fadeUp 0.6s ease both;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .divider {
            width: 48px;
            height: 3px;
            background: #2563eb;
            border-radius: 99px;
        }

        .badge {
            background: #dbeafe;
            color: #1e40af;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            padding: 3px 10px;
            border-radius: 99px;
        }

        .avatar {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .person-card {
            transition: box-shadow 0.2s;
        }

        .person-card:hover {
            box-shadow: 0 8px 24px rgba(37, 99, 235, 0.12);
        }

        input[type="text"],
        input[type="email"],
        textarea,
        select {
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }
    </style>
</head>

<body class="font-sans text-slate-800 bg-white">

    <!-- ───────────── NAVBAR ───────────── -->
    <nav id="navbar"
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-blue-950/95 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-6 flex items-center justify-between h-16">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-blue-400 rounded-lg flex items-center justify-content-center">
                    <svg viewBox="0 0 36 36" width="36" height="36" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect width="36" height="36" rx="8" fill="#1d4ed8" />
                        <path d="M18 8L28 13V23L18 28L8 23V13L18 8Z" stroke="white" stroke-width="1.5" fill="none" />
                        <path d="M18 8V18M18 18L28 13M18 18L8 13" stroke="white" stroke-width="1.5" opacity="0.6" />
                        <circle cx="18" cy="18" r="2.5" fill="white" />
                    </svg>
                </div>
                <div>
                    <p class="text-white font-bold text-sm leading-tight">SMKS MAHAPUTRA CERDAS UTAMA</p>
                    <p class="text-blue-300 text-xs leading-tight">Terakreditasi A — Sejak 1990</p>
                </div>
            </div>
            <div class="hidden md:flex items-center gap-8">
                <a href="#tentang" class="nav-link text-blue-100 hover:text-white text-sm font-medium">Tentang</a>
                <a href="#program" class="nav-link text-blue-100 hover:text-white text-sm font-medium">Program</a>
                <a href="#fasilitas" class="nav-link text-blue-100 hover:text-white text-sm font-medium">Fasilitas</a>
                <a href="#warga" class="nav-link text-blue-100 hover:text-white text-sm font-medium">Warga Sekolah</a>
                <a href="#pengumuman" class="nav-link text-blue-100 hover:text-white text-sm font-medium">Pengumuman</a>
                <a href="#kontak" class="nav-link text-blue-100 hover:text-white text-sm font-medium">Kontak</a>
            </div>
            <a href="#ppdb"
                class="hidden md:block bg-blue-400 hover:bg-blue-300 text-blue-950 font-semibold text-sm px-5 py-2 rounded-lg transition-colors">
                Daftar PPDB
            </a>
            <!-- hamburger -->
            <button id="menuBtn" class="md:hidden text-white"
                onclick="document.getElementById('mobileMenu').classList.toggle('hidden')">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="3" y1="6" x2="21" y2="6" />
                    <line x1="3" y1="12" x2="21" y2="12" />
                    <line x1="3" y1="18" x2="21" y2="18" />
                </svg>
            </button>
        </div>
        <div id="mobileMenu" class="hidden md:hidden bg-blue-950 px-6 pb-4 flex flex-col gap-3">
            <a href="#tentang" class="text-blue-100 text-sm py-1">Tentang</a>
            <a href="#program" class="text-blue-100 text-sm py-1">Program</a>
            <a href="#fasilitas" class="text-blue-100 text-sm py-1">Fasilitas</a>
            <a href="#warga" class="text-blue-100 text-sm py-1">Warga Sekolah</a>
            <a href="#pengumuman" class="text-blue-100 text-sm py-1">Pengumuman</a>
            <a href="#kontak" class="text-blue-100 text-sm py-1">Kontak</a>
            <a href="#ppdb"
                class="bg-blue-400 text-blue-950 font-semibold text-sm px-4 py-2 rounded-lg text-center mt-1">Daftar
                PPDB</a>
        </div>
    </nav>

    <!-- ───────────── HERO ───────────── -->
    <section
        class="min-h-screen flex items-center relative overflow-hidden pt-16 text-white
bg-[linear-gradient(120deg,rgba(10,36,99,0.9),rgba(37,99,235,0.6)),url('https://i.ytimg.com/vi/MEmt8iI9vA4/maxresdefault.jpg')]
bg-cover bg-center">

        <!-- decorative shapes -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-400/10 rounded-full -translate-y-1/2 translate-x-1/3">
        </div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-blue-800/30 rounded-full translate-y-1/3 -translate-x-1/4">
        </div>
        <div
            class="absolute top-1/2 left-1/2 w-[600px] h-[600px] bg-blue-600/5 rounded-full -translate-x-1/2 -translate-y-1/2">
        </div>

        <div class="max-w-7xl mx-auto px-6 py-24 grid md:grid-cols-2 gap-12 items-center relative z-10">

            <!-- LEFT -->
            <div>
                <span
                    class="inline-block bg-white/10 backdrop-blur text-blue-100 text-xs font-semibold tracking-widest uppercase px-4 py-1.5 rounded-full mb-6 border border-white/20">
                    Sekolah Unggulan Nasional
                </span>

                <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6">
                    Membangun<br>
                    <span class="text-blue-300">Generasi</span><br>
                    Unggul Bangsa
                </h1>

                <p class="text-blue-100 text-base md:text-lg leading-relaxed mb-8 max-w-md">
                    SMA Negeri Nusantara menghadirkan pendidikan berkualitas tinggi dengan kurikulum modern,
                    tenaga pengajar berpengalaman, dan lingkungan belajar inspiratif.
                </p>

                <div class="flex flex-wrap gap-4">
                    <a href="#ppdb"
                        class="bg-white text-blue-900 hover:bg-blue-50 font-semibold px-6 py-3 rounded-xl text-sm transition shadow-lg">
                        Pendaftaran 2025/2026 →
                    </a>

                    <a href="#tentang"
                        class="bg-white/10 backdrop-blur border border-white/20 text-white hover:bg-white/20 px-6 py-3 rounded-xl text-sm transition">
                        Selengkapnya
                    </a>
                </div>

                <!-- stats -->
                <div class="flex gap-8 mt-12 pt-8 border-t border-white/10">
                    <div>
                        <div class="text-3xl font-bold">1.240</div>
                        <div class="text-blue-200 text-xs mt-1">Siswa Aktif</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold">98%</div>
                        <div class="text-blue-200 text-xs mt-1">Kelulusan</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold">47+</div>
                        <div class="text-blue-200 text-xs mt-1">Penghargaan</div>
                    </div>
                </div>
            </div>

            <!-- RIGHT CARD -->
            <div class="hidden md:block">
                <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8 shadow-2xl">

                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-blue-400 rounded-xl flex items-center justify-center">
                            <svg width="20" height="20" fill="none" stroke="white" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-white font-semibold text-sm">Sekolah Terbaik</p>
                            <p class="text-blue-200 text-xs">Provinsi Jawa Barat 2024</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="bg-white/10 rounded-xl px-4 py-3 flex justify-between items-center">
                            <span class="text-blue-100 text-sm">Akreditasi</span>
                            <span class="bg-green-400 text-green-900 text-xs font-bold px-2 py-1 rounded">A</span>
                        </div>

                        <div class="bg-white/10 rounded-xl px-4 py-3 flex justify-between items-center">
                            <span class="text-blue-100 text-sm">Kurikulum</span>
                            <span class="text-white text-sm font-medium">Merdeka</span>
                        </div>

                        <div class="bg-white/10 rounded-xl px-4 py-3 flex justify-between items-center">
                            <span class="text-blue-100 text-sm">Tahun Berdiri</span>
                            <span class="text-white text-sm font-medium">1987</span>
                        </div>

                        <div class="bg-white/10 rounded-xl px-4 py-3 flex justify-between items-center">
                            <span class="text-blue-100 text-sm">Rasio</span>
                            <span class="text-white text-sm font-medium">1 : 18</span>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center gap-2">
                        <div class="flex -space-x-2">
                            <div
                                class="w-8 h-8 rounded-full bg-blue-400 border border-white/20 flex items-center justify-center text-xs font-bold">
                                A</div>
                            <div
                                class="w-8 h-8 rounded-full bg-indigo-400 border border-white/20 flex items-center justify-center text-xs font-bold">
                                B</div>
                            <div
                                class="w-8 h-8 rounded-full bg-sky-400 border border-white/20 flex items-center justify-center text-xs font-bold">
                                C</div>
                        </div>
                        <span class="text-blue-200 text-xs">+1.237 siswa tahun ini</span>
                    </div>

                </div>
            </div>
        </div>

        <!-- scroll indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
            <svg width="20" height="20" fill="none" stroke="rgba(255,255,255,0.5)" stroke-width="2"
                viewBox="0 0 24 24">
                <path d="M6 9l6 6 6-6" />
            </svg>
        </div>

    </section>




    <!-- ───────────── TENTANG ───────────── -->
    <section id="tentang" class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div>
                    <p class="section-label mb-3">Tentang Kami</p>
                    <div class="divider mb-6"></div>
                    <h2 class="font-serif text-4xl text-blue-950 leading-snug mb-6">
                        Lebih dari Sekadar<br />Tempat Belajar
                    </h2>
                    <p class="text-slate-600 leading-relaxed mb-5">
                        SMA Negeri Nusantara berdiri sejak 1987 dan telah mencetak ribuan alumni yang sukses di berbagai
                        bidang. Kami percaya bahwa pendidikan terbaik lahir dari lingkungan yang mendukung, guru yang
                        berdedikasi, dan kurikulum yang relevan dengan kebutuhan zaman.
                    </p>
                    <p class="text-slate-600 leading-relaxed mb-8">
                        Dengan mengusung nilai <strong class="text-blue-700">Integritas, Inovasi, dan
                            Inspirasi</strong>, kami berkomitmen untuk terus menjadi yang terdepan dalam dunia
                        pendidikan Indonesia.
                    </p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white rounded-2xl p-5 border border-blue-100 card-hover">
                            <div class="stat-num">37</div>
                            <p class="text-slate-500 text-sm mt-1">Tahun Berpengalaman</p>
                        </div>
                        <div class="bg-white rounded-2xl p-5 border border-blue-100 card-hover">
                            <div class="stat-num">12k+</div>
                            <p class="text-slate-500 text-sm mt-1">Alumni Sukses</p>
                        </div>
                        <div class="bg-white rounded-2xl p-5 border border-blue-100 card-hover">
                            <div class="stat-num">86</div>
                            <p class="text-slate-500 text-sm mt-1">Tenaga Pendidik</p>
                        </div>
                        <div class="bg-white rounded-2xl p-5 border border-blue-100 card-hover">
                            <div class="stat-num">24</div>
                            <p class="text-slate-500 text-sm mt-1">Ekstra Kurikuler</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-blue-600 rounded-3xl p-8 text-white">
                        <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mb-4">
                            <svg width="24" height="24" fill="none" stroke="white" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z" />
                                <path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-lg mb-2">Visi</h3>
                        <p class="text-blue-100 text-sm leading-relaxed">Menjadi penyelenggara pendidikan kejuruan
                            berkarakter religius yang melahirkan tenaga ahli, terampil, kreatif, inovatif dan
                            berpengetahuan yang ramah lingkungan.</p>
                    </div>
                    <div class="bg-white rounded-3xl p-8 border border-blue-100">
                        <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center mb-4">
                            <svg width="24" height="24" fill="none" stroke="#1d4ed8" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-lg text-blue-900 mb-2">Misi</h3>
                        <ul class="text-slate-600 text-sm space-y-2">
                            <li class="flex gap-2"><span class="text-blue-500 mt-1">•</span> Menyelenggarakan
                                pendidikan kejuruan berkarakter religius</li>
                            <li class="flex gap-2"><span class="text-blue-500 mt-1">•</span> Melahirkan tenaga ahli
                                tingkat menengah berakhlakul kharimah</li>
                            <li class="flex gap-2"><span class="text-blue-500 mt-1">•</span> Mewujudkan tenaga
                                terampil, kreatif, inovatif dan berpengetahuan</li>
                            <li class="flex gap-2"><span class="text-blue-500 mt-1">•</span> Membangun perilaku yang
                                peduli lingkungan</li>
                            <li class="flex gap-2"><span class="text-blue-500 mt-1">•</span> enjalin kerjasama dengan
                                lembaga akademik dan non akademik di tingkat lokal dan internasional</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ───────────── PROGRAM ───────────── -->
    <section id="program" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-14">
                <p class="section-label mb-3">Program Unggulan</p>
                <div class="divider mx-auto mb-6"></div>
                <h2 class="font-serif text-4xl text-blue-950">Jurusan & Program Studi</h2>
                <p class="text-slate-500 mt-3 max-w-xl mx-auto text-sm">Tiga jurusan utama dengan pendekatan
                    pembelajaran modern yang mempersiapkan siswa menuju perguruan tinggi terbaik.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                <!-- IPA -->
                <div class="rounded-3xl overflow-hidden border border-blue-100 card-hover bg-white">
                    <div class="bg-gradient-to-br from-blue-600 to-blue-800 p-8">
                        <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center mb-4">
                            <svg width="28" height="28" fill="none" stroke="white" stroke-width="1.8"
                                viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="3" />
                                <path
                                    d="M12 2v3M12 19v3M4.22 4.22l2.12 2.12M17.66 17.66l2.12 2.12M2 12h3M19 12h3M4.22 19.78l2.12-2.12M17.66 6.34l2.12-2.12" />
                            </svg>
                        </div>
                        <h3 class="text-white font-bold text-xl">IPA</h3>
                        <p class="text-blue-200 text-sm mt-1">Ilmu Pengetahuan Alam</p>
                    </div>
                    <div class="p-6">
                        <p class="text-slate-600 text-sm leading-relaxed mb-4">Memperdalam ilmu Fisika, Kimia, Biologi,
                            dan Matematika dengan laboratorium modern dan pembelajaran berbasis riset.</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="badge">Fisika</span>
                            <span class="badge">Kimia</span>
                            <span class="badge">Biologi</span>
                            <span class="badge">Matematika</span>
                        </div>
                        <div class="flex justify-between text-xs text-slate-500 pt-4 border-t border-slate-100">
                            <span>6 Rombel</span>
                            <span>216 Siswa</span>
                        </div>
                    </div>
                </div>
                <!-- IPS -->
                <div class="rounded-3xl overflow-hidden border border-blue-100 card-hover bg-white">
                    <div class="bg-gradient-to-br from-indigo-500 to-blue-700 p-8">
                        <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center mb-4">
                            <svg width="28" height="28" fill="none" stroke="white" stroke-width="1.8"
                                viewBox="0 0 24 24">
                                <rect x="2" y="3" width="20" height="14" rx="2" />
                                <path d="M8 21h8M12 17v4" />
                                <path d="M7 8h10M7 12h6" />
                            </svg>
                        </div>
                        <h3 class="text-white font-bold text-xl">IPS</h3>
                        <p class="text-blue-200 text-sm mt-1">Ilmu Pengetahuan Sosial</p>
                    </div>
                    <div class="p-6">
                        <p class="text-slate-600 text-sm leading-relaxed mb-4">Mengkaji ekonomi, sosiologi, geografi,
                            dan sejarah dengan pendekatan analitis dan kontekstual terhadap isu global.</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="badge">Ekonomi</span>
                            <span class="badge">Sosiologi</span>
                            <span class="badge">Geografi</span>
                            <span class="badge">Sejarah</span>
                        </div>
                        <div class="flex justify-between text-xs text-slate-500 pt-4 border-t border-slate-100">
                            <span>5 Rombel</span>
                            <span>180 Siswa</span>
                        </div>
                    </div>
                </div>
                <!-- Bahasa -->
                <div class="rounded-3xl overflow-hidden border border-blue-100 card-hover bg-white">
                    <div class="bg-gradient-to-br from-sky-500 to-blue-600 p-8">
                        <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center mb-4">
                            <svg width="28" height="28" fill="none" stroke="white" stroke-width="1.8"
                                viewBox="0 0 24 24">
                                <path d="M5 8l4 4-4 4M11 12h8" />
                                <rect x="2" y="4" width="20" height="16" rx="2" />
                            </svg>
                        </div>
                        <h3 class="text-white font-bold text-xl">Bahasa</h3>
                        <p class="text-blue-200 text-sm mt-1">Program Bahasa & Sastra</p>
                    </div>
                    <div class="p-6">
                        <p class="text-slate-600 text-sm leading-relaxed mb-4">Mendalami linguistik, sastra, dan
                            komunikasi lintas budaya untuk menjadi generasi yang komunikatif dan berbudaya.</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="badge">Inggris</span>
                            <span class="badge">Jepang</span>
                            <span class="badge">Sastra</span>
                            <span class="badge">Jurnalistik</span>
                        </div>
                        <div class="flex justify-between text-xs text-slate-500 pt-4 border-t border-slate-100">
                            <span>3 Rombel</span>
                            <span>108 Siswa</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ───────────── FASILITAS ───────────── -->
    <section id="fasilitas" class="py-24 bg-blue-950 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5">
            <div
                class="absolute top-0 right-0 w-[500px] h-[500px] rounded-full bg-blue-400 translate-x-1/3 -translate-y-1/3">
            </div>
            <div
                class="absolute bottom-0 left-0 w-[400px] h-[400px] rounded-full bg-blue-300 -translate-x-1/3 translate-y-1/3">
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center mb-14">
                <p class="text-blue-400 text-xs font-semibold tracking-widest uppercase mb-3">Fasilitas</p>
                <div class="w-12 h-0.5 bg-blue-400 mx-auto mb-6"></div>
                <h2 class="font-serif text-4xl text-white">Sarana Penunjang<br />Belajar Terbaik</h2>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="glass rounded-2xl p-6 card-hover">
                    <div class="w-12 h-12 bg-blue-400/20 rounded-xl flex items-center justify-center mb-4">
                        <svg width="22" height="22" fill="none" stroke="#93c5fd" stroke-width="2"
                            viewBox="0 0 24 24">
                            <rect x="2" y="3" width="20" height="14" rx="1" />
                            <path d="M8 21h8M12 17v4" />
                        </svg>
                    </div>
                    <h3 class="text-white font-semibold mb-2">Lab Komputer</h3>
                    <p class="text-blue-300 text-xs leading-relaxed">3 ruang lab komputer dengan 120 unit PC terkini
                        dan koneksi internet cepat.</p>
                </div>
                <div class="glass rounded-2xl p-6 card-hover">
                    <div class="w-12 h-12 bg-blue-400/20 rounded-xl flex items-center justify-center mb-4">
                        <svg width="22" height="22" fill="none" stroke="#93c5fd" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                    </div>
                    <h3 class="text-white font-semibold mb-2">Laboratorium Sains</h3>
                    <p class="text-blue-300 text-xs leading-relaxed">Lab Fisika, Kimia, dan Biologi berstandar nasional
                        dengan peralatan lengkap.</p>
                </div>
                <div class="glass rounded-2xl p-6 card-hover">
                    <div class="w-12 h-12 bg-blue-400/20 rounded-xl flex items-center justify-center mb-4">
                        <svg width="22" height="22" fill="none" stroke="#93c5fd" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z" />
                            <path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z" />
                        </svg>
                    </div>
                    <h3 class="text-white font-semibold mb-2">Perpustakaan</h3>
                    <p class="text-blue-300 text-xs leading-relaxed">Koleksi lebih dari 25.000 buku fisik dan akses
                        digital ke ribuan jurnal ilmiah.</p>
                </div>
                <div class="glass rounded-2xl p-6 card-hover">
                    <div class="w-12 h-12 bg-blue-400/20 rounded-xl flex items-center justify-center mb-4">
                        <svg width="22" height="22" fill="none" stroke="#93c5fd" stroke-width="2"
                            viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 8v4l3 3" />
                        </svg>
                    </div>
                    <h3 class="text-white font-semibold mb-2">Aula & Gedung Serbaguna</h3>
                    <p class="text-blue-300 text-xs leading-relaxed">Kapasitas 600 orang untuk seminar, wisuda, dan
                        kegiatan seni budaya.</p>
                </div>
                <div class="glass rounded-2xl p-6 card-hover">
                    <div class="w-12 h-12 bg-blue-400/20 rounded-xl flex items-center justify-center mb-4">
                        <svg width="22" height="22" fill="none" stroke="#93c5fd" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M18 8h1a4 4 0 010 8h-1" />
                            <path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z" />
                            <line x1="6" y1="1" x2="6" y2="4" />
                            <line x1="10" y1="1" x2="10" y2="4" />
                            <line x1="14" y1="1" x2="14" y2="4" />
                        </svg>
                    </div>
                    <h3 class="text-white font-semibold mb-2">Kantin Sehat</h3>
                    <p class="text-blue-300 text-xs leading-relaxed">Menu bergizi dengan standar kebersihan tinggi dan
                        harga terjangkau untuk siswa.</p>
                </div>
                <div class="glass rounded-2xl p-6 card-hover">
                    <div class="w-12 h-12 bg-blue-400/20 rounded-xl flex items-center justify-center mb-4">
                        <svg width="22" height="22" fill="none" stroke="#93c5fd" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                    </div>
                    <h3 class="text-white font-semibold mb-2">Lapangan Olahraga</h3>
                    <p class="text-blue-300 text-xs leading-relaxed">Lapangan basket, voli, futsal, dan lintasan
                        atletik standar kompetisi.</p>
                </div>
                <div class="glass rounded-2xl p-6 card-hover">
                    <div class="w-12 h-12 bg-blue-400/20 rounded-xl flex items-center justify-center mb-4">
                        <svg width="22" height="22" fill="none" stroke="#93c5fd" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                        </svg>
                    </div>
                    <h3 class="text-white font-semibold mb-2">Ruang BK & Konseling</h3>
                    <p class="text-blue-300 text-xs leading-relaxed">Layanan bimbingan belajar dan konseling psikologi
                        oleh tenaga ahli bersertifikat.</p>
                </div>
                <div class="glass rounded-2xl p-6 card-hover">
                    <div class="w-12 h-12 bg-blue-400/20 rounded-xl flex items-center justify-center mb-4">
                        <svg width="22" height="22" fill="none" stroke="#93c5fd" stroke-width="2"
                            viewBox="0 0 24 24">
                            <rect x="3" y="3" width="18" height="18" rx="2" />
                            <path d="M3 9h18M9 21V9" />
                        </svg>
                    </div>
                    <h3 class="text-white font-semibold mb-2">Smart Classroom</h3>
                    <p class="text-blue-300 text-xs leading-relaxed">36 ruang kelas ber-AC dengan proyektor interaktif
                        dan sistem audio modern.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- ───────────── PENGUMUMAN ───────────── -->
    <section id="pengumuman" class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-16 items-start">
                <div>
                    <p class="section-label mb-3">Berita Terkini</p>
                    <div class="divider mb-6"></div>
                    <h2 class="font-serif text-4xl text-blue-950 mb-8">Pengumuman &<br />Berita Sekolah</h2>
                    <div class="space-y-4">
                        <div class="bg-white rounded-2xl p-5 border border-blue-50 card-hover">
                            <div class="flex gap-4 items-start">
                                <div class="bg-blue-600 text-white rounded-xl px-3 py-2 text-center min-w-[52px]">
                                    <p class="text-lg font-bold leading-none">14</p>
                                    <p class="text-blue-200 text-xs">Jun</p>
                                </div>
                                <div>
                                    <span class="badge mb-2 inline-block">PPDB</span>
                                    <h4 class="font-semibold text-sm text-blue-900 mb-1">Penerimaan Peserta Didik Baru
                                        T.A 2025/2026 Dibuka</h4>
                                    <p class="text-slate-500 text-xs leading-relaxed">Pendaftaran PPDB gelombang
                                        pertama telah dibuka mulai 14 Juni hingga 28 Juni 2025. Daftarkan diri segera.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-2xl p-5 border border-blue-50 card-hover">
                            <div class="flex gap-4 items-start">
                                <div class="bg-blue-500 text-white rounded-xl px-3 py-2 text-center min-w-[52px]">
                                    <p class="text-lg font-bold leading-none">02</p>
                                    <p class="text-blue-200 text-xs">Jun</p>
                                </div>
                                <div>
                                    <span class="badge mb-2 inline-block">Prestasi</span>
                                    <h4 class="font-semibold text-sm text-blue-900 mb-1">Juara 1 Olimpiade Matematika
                                        Tingkat Nasional</h4>
                                    <p class="text-slate-500 text-xs leading-relaxed">Selamat kepada Daffa Rizky (XII
                                        IPA 2) yang meraih medali emas pada OSN Matematika 2025 di Jakarta.</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-2xl p-5 border border-blue-50 card-hover">
                            <div class="flex gap-4 items-start">
                                <div class="bg-sky-500 text-white rounded-xl px-3 py-2 text-center min-w-[52px]">
                                    <p class="text-lg font-bold leading-none">20</p>
                                    <p class="text-blue-200 text-xs">Mei</p>
                                </div>
                                <div>
                                    <span class="badge mb-2 inline-block">Kegiatan</span>
                                    <h4 class="font-semibold text-sm text-blue-900 mb-1">Gelar Karya Projek Penguatan
                                        Profil Pelajar Pancasila</h4>
                                    <p class="text-slate-500 text-xs leading-relaxed">Ratusan karya inovatif siswa
                                        dipamerkan dalam acara P5 Expo yang dihadiri orang tua dan mitra industri.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="section-label mb-3">Jadwal</p>
                    <div class="divider mb-6"></div>
                    <h2 class="font-serif text-4xl text-blue-950 mb-8">Agenda Mendatang</h2>
                    <div class="space-y-3">
                        <div class="flex items-center gap-4 p-4 bg-blue-600 rounded-2xl text-white">
                            <div
                                class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg width="18" height="18" fill="none" stroke="white" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                    <line x1="16" y1="2" x2="16" y2="6" />
                                    <line x1="8" y1="2" x2="8" y2="6" />
                                    <line x1="3" y1="10" x2="21" y2="10" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-sm">Ujian Kenaikan Kelas</p>
                                <p class="text-blue-200 text-xs">10 – 20 Juni 2025</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-4 bg-white rounded-2xl border border-blue-100">
                            <div
                                class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg width="18" height="18" fill="none" stroke="#2563eb" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-sm text-blue-900">Rapat Wali Murid Semester Genap</p>
                                <p class="text-slate-500 text-xs">Sabtu, 7 Juni 2025 | 08.00 WIB</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-4 bg-white rounded-2xl border border-blue-100">
                            <div
                                class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg width="18" height="18" fill="none" stroke="#2563eb" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M12 8v4l3 3" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-sm text-blue-900">Pembagian Rapor Semester Genap</p>
                                <p class="text-slate-500 text-xs">Sabtu, 21 Juni 2025 | 07.30 WIB</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-4 bg-white rounded-2xl border border-blue-100">
                            <div
                                class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg width="18" height="18" fill="none" stroke="#2563eb" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-sm text-blue-900">Wisuda Kelas XII Angkatan 2025</p>
                                <p class="text-slate-500 text-xs">Sabtu, 28 Juni 2025 | 08.00 WIB</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ───────────── PPDB FORM ───────────── -->
   
    <section id="register" class="py-32 bg-gradient-to-br from-blue-700 to-blue-500 relative overflow-hidden">

        <!-- decorative blur -->
        <div class="absolute -top-20 -right-20 w-[400px] h-[400px] bg-blue-300/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-[300px] h-[300px] bg-blue-900/30 rounded-full blur-3xl"></div>

        <div class="max-w-6xl mx-auto px-6 relative z-10">

            <!-- Header -->
            <div class="mb-16 max-w-2xl">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-[2px] bg-white/60"></div>
                    <span class="text-xs font-semibold tracking-widest uppercase text-white/70">
                        Penerimaan Baru
                    </span>
                </div>

                <h2 class="text-4xl md:text-5xl font-bold text-white leading-tight mb-4">
                    Bergabung Bersama <br>Kami
                </h2>

                <p class="text-white/70 text-sm leading-relaxed">
                    Pilih jalur pendaftaran sesuai dengan peran Anda. Proses mudah, cepat,
                    dan seluruhnya dapat dilakukan secara online.
                </p>
            </div>

            <!-- Grid -->
            <div class="grid md:grid-cols-3 gap-8">

                <!-- CARD -->
                <a href="/ppdb/register"
                    class="group bg-white/95 backdrop-blur rounded-2xl p-8 transition-all duration-300 hover:-translate-y-3 hover:shadow-2xl relative overflow-hidden">

                    <div
                        class="absolute bottom-0 left-0 h-[3px] w-0 bg-gradient-to-r from-blue-600 to-blue-400 transition-all duration-300 group-hover:w-full">
                    </div>

                    <div
                        class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center mb-6 group-hover:bg-blue-600 transition">
                        <svg class="w-6 h-6 stroke-blue-600 group-hover:stroke-white" fill="none"
                            stroke-width="1.8" viewBox="0 0 24 24">
                            <path d="M12 14c-4 0-8 2-8 4v1h16v-1c0-2-4-4-8-4z" />
                            <circle cx="12" cy="8" r="4" />
                        </svg>
                    </div>

                    <div class="text-xs font-semibold tracking-widest uppercase text-blue-600 mb-2">
                        Peserta Didik Baru
                    </div>

                    <h3 class="text-xl font-semibold text-gray-800 mb-3">
                        Daftar sebagai Calon Siswa
                    </h3>

                    <p class="text-sm text-gray-500 leading-relaxed mb-6">
                        Ikuti proses PPDB online. Lengkapi data diri dan pantau status pendaftaran Anda.
                    </p>

                    <div class="flex items-center gap-2 text-sm font-semibold text-blue-600 uppercase tracking-wide">
                        Mulai Daftar
                        <svg class="w-4 h-4 transition group-hover:translate-x-1" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>

                <!-- CARD -->
                <a href="/recruitment/guru"
                    class="group bg-white/95 backdrop-blur rounded-2xl p-8 transition-all duration-300 hover:-translate-y-3 hover:shadow-2xl relative overflow-hidden">

                    <div
                        class="absolute bottom-0 left-0 h-[3px] w-0 bg-gradient-to-r from-blue-600 to-blue-400 transition-all duration-300 group-hover:w-full">
                    </div>

                    <div
                        class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center mb-6 group-hover:bg-blue-600 transition">
                        <svg class="w-6 h-6 stroke-blue-600 group-hover:stroke-white" fill="none"
                            stroke-width="1.8" viewBox="0 0 24 24">
                            <rect x="2" y="7" width="20" height="14" rx="1" />
                            <path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                            <line x1="12" y1="12" x2="12" y2="16" />
                            <line x1="10" y1="14" x2="14" y2="14" />
                        </svg>
                    </div>

                    <div class="text-xs font-semibold tracking-widest uppercase text-blue-600 mb-2">
                        Tenaga Pengajar
                    </div>

                    <h3 class="text-xl font-semibold text-gray-800 mb-3">
                        Lamar sebagai Calon Guru
                    </h3>

                    <p class="text-sm text-gray-500 leading-relaxed mb-6">
                        Bergabung dengan tim pengajar profesional kami dan kembangkan karir Anda.
                    </p>

                    <div class="flex items-center gap-2 text-sm font-semibold text-blue-600 uppercase tracking-wide">
                        Kirim Lamaran
                        <svg class="w-4 h-4 transition group-hover:translate-x-1" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>

                <!-- CARD -->
                <a href="/recruitment/pegawai"
                    class="group bg-white/95 backdrop-blur rounded-2xl p-8 transition-all duration-300 hover:-translate-y-3 hover:shadow-2xl relative overflow-hidden">

                    <div
                        class="absolute bottom-0 left-0 h-[3px] w-0 bg-gradient-to-r from-blue-600 to-blue-400 transition-all duration-300 group-hover:w-full">
                    </div>

                    <div
                        class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center mb-6 group-hover:bg-blue-600 transition">
                        <svg class="w-6 h-6 stroke-blue-600 group-hover:stroke-white" fill="none"
                            stroke-width="1.8" viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </div>

                    <div class="text-xs font-semibold tracking-widest uppercase text-blue-600 mb-2">
                        Tenaga Kependidikan
                    </div>

                    <h3 class="text-xl font-semibold text-gray-800 mb-3">
                        Lamar sebagai Pegawai
                    </h3>

                    <p class="text-sm text-gray-500 leading-relaxed mb-6">
                        Kesempatan bagi staf administrasi dan tenaga kependidikan lainnya.
                    </p>

                    <div class="flex items-center gap-2 text-sm font-semibold text-blue-600 uppercase tracking-wide">
                        Lihat Lowongan
                        <svg class="w-4 h-4 transition group-hover:translate-x-1" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>

            </div>
        </div>
    </section>

    <!-- ───────────── KONTAK ───────────── -->
    <section id="kontak" class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12">
                <p class="section-label mb-3">Hubungi Kami</p>
                <div class="divider mx-auto mb-6"></div>
                <h2 class="font-serif text-4xl text-blue-950">Informasi Kontak</h2>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="bg-white rounded-2xl p-6 border border-blue-50 card-hover text-center">
                    <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg width="20" height="20" fill="none" stroke="#2563eb" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                    </div>
                    <h4 class="font-semibold text-sm text-blue-900 mb-1">Alamat</h4>
                    <p class="text-slate-500 text-xs leading-relaxed">Jl. Pendidikan No. 1, Kec. Kebayoran, Jakarta
                        Selatan, DKI Jakarta 12110</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-blue-50 card-hover text-center">
                    <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg width="20" height="20" fill="none" stroke="#2563eb" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path
                                d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 13a19.79 19.79 0 01-3.07-8.67A2 2 0 012 2.18L5.08 2a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L5.91 9.91a16 16 0 006.18 6.18l1.28-1.32a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z" />
                        </svg>
                    </div>
                    <h4 class="font-semibold text-sm text-blue-900 mb-1">Telepon</h4>
                    <p class="text-slate-500 text-xs">(021) 7812-3456</p>
                    <p class="text-slate-500 text-xs mt-1">Senin – Jumat, 07.00–15.30</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-blue-50 card-hover text-center">
                    <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg width="20" height="20" fill="none" stroke="#2563eb" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                            <polyline points="22,6 12,13 2,6" />
                        </svg>
                    </div>
                    <h4 class="font-semibold text-sm text-blue-900 mb-1">Email</h4>
                    <p class="text-slate-500 text-xs">info@smannusantara.sch.id</p>
                    <p class="text-slate-500 text-xs mt-1">ppdb@smannusantara.sch.id</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-blue-50 card-hover text-center">
                    <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg width="20" height="20" fill="none" stroke="#2563eb" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path
                                d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z" />
                        </svg>
                    </div>
                    <h4 class="font-semibold text-sm text-blue-900 mb-1">Media Sosial</h4>
                    <p class="text-slate-500 text-xs">@smannusantara</p>
                    <p class="text-slate-500 text-xs mt-1">Instagram · YouTube · TikTok</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ───────────── FOOTER ───────────── -->
    <footer class="bg-blue-950 py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-10 mb-10">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <svg viewBox="0 0 36 36" width="36" height="36" fill="none">
                            <rect width="36" height="36" rx="8" fill="#1d4ed8" />
                            <path d="M18 8L28 13V23L18 28L8 23V13L18 8Z" stroke="white" stroke-width="1.5"
                                fill="none" />
                            <circle cx="18" cy="18" r="2.5" fill="white" />
                        </svg>
                        <div>
                            <p class="text-white font-bold">SMA Negeri Nusantara</p>
                            <p class="text-blue-400 text-xs">Unggul · Berkarakter · Berprestasi</p>
                        </div>
                    </div>
                    <p class="text-blue-300 text-xs leading-relaxed max-w-xs">Sekolah menengah atas negeri terbaik yang
                        berkomitmen menciptakan generasi penerus bangsa yang cerdas, berkarakter, dan berdaya saing
                        global.</p>
                </div>
                <div>
                    <h5 class="text-white font-semibold text-sm mb-4">Tautan Cepat</h5>
                    <ul class="space-y-2">
                        <li><a href="#tentang" class="text-blue-300 hover:text-white text-xs transition-colors">Profil
                                Sekolah</a></li>
                        <li><a href="#program"
                                class="text-blue-300 hover:text-white text-xs transition-colors">Program Studi</a></li>
                        <li><a href="#fasilitas"
                                class="text-blue-300 hover:text-white text-xs transition-colors">Fasilitas</a></li>
                        <li><a href="#warga" class="text-blue-300 hover:text-white text-xs transition-colors">Warga
                                Sekolah</a></li>
                        <li><a href="#ppdb" class="text-blue-300 hover:text-white text-xs transition-colors">PPDB
                                2025/2026</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-white font-semibold text-sm mb-4">Layanan</h5>
                    <ul class="space-y-2">
                        <li><a href="#"
                                class="text-blue-300 hover:text-white text-xs transition-colors">E-Learning</a></li>
                        <li><a href="#" class="text-blue-300 hover:text-white text-xs transition-colors">Sistem
                                Informasi Sekolah</a></li>
                        <li><a href="#" class="text-blue-300 hover:text-white text-xs transition-colors">Portal
                                Orang Tua</a></li>
                        <li><a href="#"
                                class="text-blue-300 hover:text-white text-xs transition-colors">Perpustakaan
                                Digital</a></li>
                        <li><a href="#kontak" class="text-blue-300 hover:text-white text-xs transition-colors">Kontak
                                & Pengaduan</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-blue-800/50 pt-6 flex flex-col sm:flex-row justify-between items-center gap-3">
                <p class="text-blue-400 text-xs">© 2025 SMA Negeri Nusantara. Hak Cipta Dilindungi.</p>
                <p class="text-blue-500 text-xs">NPSN: 20101234 · NSS: 301016301001</p>
            </div>
        </div>
    </footer>


</body>

</html>
