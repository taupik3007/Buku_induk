<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SMA Nusantara Unggul — Sekolah Terbaik untuk Generasi Penerus</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
  :root {
    --blue-deep: #0A2463;
    --blue-mid: #1B4FD8;
    --blue-light: #3B82F6;
    --blue-pale: #EFF6FF;
    --white: #FFFFFF;
    --gray-soft: #F8FAFC;
    --gray-text: #64748B;
    --gray-dark: #1E293B;
    --accent: #F59E0B;
  }

  * { margin: 0; padding: 0; box-sizing: border-box; }

  html { scroll-behavior: smooth; }

  body {
    font-family: 'DM Sans', sans-serif;
    color: var(--gray-dark);
    background: var(--white);
    overflow-x: hidden;
  }

  /* ── NAV ── */
  nav {
    position: fixed; top: 0; width: 100%; z-index: 100;
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(10,36,99,0.08);
    display: flex; align-items: center; justify-content: space-between;
    padding: 18px 6%;
    transition: box-shadow 0.3s;
  }
  nav.scrolled { box-shadow: 0 4px 30px rgba(10,36,99,0.1); }

  .nav-logo {
    display: flex; align-items: center; gap: 12px; text-decoration: none;
  }
  .nav-logo .logo-icon {
    width: 40px; height: 40px; background: var(--blue-deep);
    border-radius: 10px; display: flex; align-items: center; justify-content: center;
    font-family: 'Playfair Display', serif; color: var(--white); font-size: 18px; font-weight: 700;
  }
  .nav-logo span { font-weight: 600; color: var(--blue-deep); font-size: 15px; line-height: 1.2; }
  .nav-logo small { display: block; color: var(--gray-text); font-size: 11px; font-weight: 400; }

  .nav-links { display: flex; gap: 36px; list-style: none; }
  .nav-links a { text-decoration: none; color: var(--gray-dark); font-size: 14px; font-weight: 500; transition: color 0.2s; }
  .nav-links a:hover { color: var(--blue-mid); }

  .nav-cta {
    background: var(--blue-mid); color: var(--white);
    padding: 10px 22px; border-radius: 8px; text-decoration: none;
    font-size: 14px; font-weight: 500; transition: background 0.2s, transform 0.2s;
  }
  .nav-cta:hover { background: var(--blue-deep); transform: translateY(-1px); }

  /* ── HERO ── */
  .hero {
    min-height: 100vh;
    background: var(--blue-deep);
    display: flex; align-items: center;
    padding: 120px 6% 80px;
    position: relative; overflow: hidden;
  }

  .hero::before {
    content: '';
    position: absolute; top: -100px; right: -100px;
    width: 600px; height: 600px;
    background: radial-gradient(circle, rgba(27,79,216,0.4) 0%, transparent 70%);
    border-radius: 50%;
  }
  .hero::after {
    content: '';
    position: absolute; bottom: -150px; left: 30%;
    width: 400px; height: 400px;
    background: radial-gradient(circle, rgba(59,130,246,0.2) 0%, transparent 70%);
    border-radius: 50%;
  }

  .hero-grid {
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 60px; align-items: center;
    max-width: 1200px; margin: 0 auto; width: 100%;
    position: relative; z-index: 1;
  }

  .hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2);
    color: var(--white); padding: 6px 14px; border-radius: 100px;
    font-size: 12px; font-weight: 500; margin-bottom: 24px;
    opacity: 0; animation: fadeUp 0.8s 0.2s forwards;
  }
  .hero-badge::before { content: '✦'; color: var(--accent); }

  .hero h1 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(38px, 5vw, 58px);
    color: var(--white); line-height: 1.15; margin-bottom: 20px;
    opacity: 0; animation: fadeUp 0.8s 0.4s forwards;
  }
  .hero h1 em { color: var(--accent); font-style: normal; }

  .hero p {
    color: rgba(255,255,255,0.7); font-size: 16px; line-height: 1.7;
    max-width: 460px; margin-bottom: 36px;
    opacity: 0; animation: fadeUp 0.8s 0.6s forwards;
  }

  .hero-btns {
    display: flex; gap: 14px; flex-wrap: wrap;
    opacity: 0; animation: fadeUp 0.8s 0.8s forwards;
  }
  .btn-primary {
    background: var(--accent); color: var(--blue-deep);
    padding: 14px 28px; border-radius: 10px; text-decoration: none;
    font-weight: 600; font-size: 15px; transition: transform 0.2s, box-shadow 0.2s;
  }
  .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(245,158,11,0.4); }
  .btn-outline {
    border: 1px solid rgba(255,255,255,0.35); color: var(--white);
    padding: 14px 28px; border-radius: 10px; text-decoration: none;
    font-weight: 500; font-size: 15px; transition: background 0.2s;
  }
  .btn-outline:hover { background: rgba(255,255,255,0.1); }

  .hero-stats {
    display: flex; gap: 32px; margin-top: 48px; padding-top: 36px;
    border-top: 1px solid rgba(255,255,255,0.1);
    opacity: 0; animation: fadeUp 0.8s 1s forwards;
  }
  .stat { text-align: center; }
  .stat strong { display: block; font-family: 'Playfair Display', serif; font-size: 32px; color: var(--white); }
  .stat small { color: rgba(255,255,255,0.5); font-size: 12px; }

  /* Hero visual */
  .hero-visual {
    display: flex; flex-direction: column; gap: 16px;
    opacity: 0; animation: fadeRight 0.9s 0.5s forwards;
  }
  .card-float {
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 16px; padding: 24px;
    backdrop-filter: blur(10px);
  }
  .card-float h3 { color: var(--white); font-size: 14px; font-weight: 600; margin-bottom: 8px; }
  .card-float p { color: rgba(255,255,255,0.6); font-size: 13px; line-height: 1.6; }
  .tags { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 12px; }
  .tag {
    background: rgba(59,130,246,0.25); color: rgba(255,255,255,0.85);
    padding: 4px 12px; border-radius: 100px; font-size: 11px;
  }

  /* ── SECTION UTILS ── */
  section { padding: 90px 6%; }
  .section-label {
    font-size: 12px; font-weight: 600; letter-spacing: 3px;
    text-transform: uppercase; color: var(--blue-light); margin-bottom: 12px;
  }
  .section-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(28px, 4vw, 42px); color: var(--blue-deep);
    line-height: 1.2; margin-bottom: 16px;
  }
  .section-sub { color: var(--gray-text); font-size: 16px; max-width: 540px; line-height: 1.7; }
  .center { text-align: center; }
  .center .section-sub { margin: 0 auto; }

  /* ── PROFIL ── */
  .profil { background: var(--gray-soft); }
  .profil-grid {
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 80px; align-items: center;
    max-width: 1200px; margin: 60px auto 0;
  }
  .profil-img {
    background: var(--blue-deep);
    border-radius: 20px; overflow: hidden; position: relative;
    aspect-ratio: 4/3;
  }
  .profil-img-inner {
    width: 100%; height: 100%;
    background: linear-gradient(135deg, var(--blue-deep) 0%, var(--blue-mid) 50%, var(--blue-light) 100%);
    display: flex; align-items: center; justify-content: center;
    flex-direction: column; gap: 12px;
  }
  .school-emblem {
    width: 100px; height: 100px;
    background: rgba(255,255,255,0.1); border: 3px solid rgba(255,255,255,0.3);
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    font-family: 'Playfair Display', serif; font-size: 36px; color: var(--white);
  }
  .profil-img span { color: rgba(255,255,255,0.6); font-size: 13px; }

  .badge-akreditasi {
    position: absolute; bottom: 20px; right: 20px;
    background: var(--accent); color: var(--blue-deep);
    border-radius: 12px; padding: 10px 16px; font-weight: 700; font-size: 13px;
    box-shadow: 0 4px 20px rgba(245,158,11,0.4);
  }

  .profil-list { list-style: none; margin-top: 28px; display: flex; flex-direction: column; gap: 16px; }
  .profil-list li {
    display: flex; align-items: flex-start; gap: 14px;
    padding: 16px; background: var(--white);
    border-radius: 12px; border-left: 3px solid var(--blue-mid);
  }
  .profil-list li .icon {
    width: 36px; height: 36px; background: var(--blue-pale);
    border-radius: 8px; display: flex; align-items: center; justify-content: center;
    font-size: 16px; flex-shrink: 0;
  }
  .profil-list li strong { display: block; font-size: 13px; color: var(--blue-deep); margin-bottom: 3px; }
  .profil-list li span { font-size: 13px; color: var(--gray-text); }

  /* ── KEUNGGULAN ── */
  .keunggulan-grid {
    display: grid; grid-template-columns: repeat(3, 1fr);
    gap: 24px; margin-top: 56px;
    max-width: 1200px; margin-left: auto; margin-right: auto;
  }
  .keunggulan-card {
    background: var(--white);
    border: 1px solid rgba(10,36,99,0.08);
    border-radius: 18px; padding: 32px;
    transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
    cursor: default;
  }
  .keunggulan-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 50px rgba(10,36,99,0.12);
    border-color: var(--blue-light);
  }
  .kard-icon {
    width: 52px; height: 52px; border-radius: 14px;
    background: var(--blue-pale);
    display: flex; align-items: center; justify-content: center;
    font-size: 24px; margin-bottom: 20px;
    transition: background 0.3s;
  }
  .keunggulan-card:hover .kard-icon { background: var(--blue-mid); }
  .keunggulan-card h3 { font-size: 17px; font-weight: 600; color: var(--blue-deep); margin-bottom: 10px; }
  .keunggulan-card p { font-size: 14px; color: var(--gray-text); line-height: 1.7; }

  /* ── PROGRAM ── */
  .program { background: var(--blue-deep); }
  .program .section-label { color: var(--accent); }
  .program .section-title { color: var(--white); }
  .program .section-sub { color: rgba(255,255,255,0.6); }

  .program-grid {
    display: grid; grid-template-columns: repeat(3, 1fr);
    gap: 20px; margin-top: 56px;
    max-width: 1200px; margin-left: auto; margin-right: auto;
  }
  .program-card {
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 18px; padding: 32px;
    transition: background 0.3s, transform 0.3s;
  }
  .program-card:hover { background: rgba(255,255,255,0.1); transform: translateY(-4px); }
  .program-card .num {
    font-family: 'Playfair Display', serif;
    font-size: 36px; color: rgba(255,255,255,0.15); font-weight: 700;
    margin-bottom: 16px; line-height: 1;
  }
  .program-card h3 { font-size: 18px; color: var(--white); font-weight: 600; margin-bottom: 12px; }
  .program-card p { font-size: 14px; color: rgba(255,255,255,0.55); line-height: 1.7; margin-bottom: 18px; }
  .program-features { list-style: none; display: flex; flex-direction: column; gap: 8px; }
  .program-features li { font-size: 13px; color: rgba(255,255,255,0.7); padding-left: 16px; position: relative; }
  .program-features li::before { content: '→'; position: absolute; left: 0; color: var(--accent); }

  /* ── GALERI / FASILITAS ── */
  .fasilitas-grid {
    display: grid; grid-template-columns: repeat(4, 1fr);
    gap: 16px; margin-top: 56px;
    max-width: 1200px; margin-left: auto; margin-right: auto;
  }
  .fas-card {
    border-radius: 16px; overflow: hidden;
    background: var(--blue-pale);
    aspect-ratio: 1; display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    gap: 10px; cursor: default;
    transition: transform 0.3s;
    border: 1px solid rgba(10,36,99,0.06);
  }
  .fas-card:hover { transform: scale(1.03); }
  .fas-card .fas-icon { font-size: 32px; }
  .fas-card span { font-size: 13px; font-weight: 600; color: var(--blue-deep); }
  .fas-card.featured {
    grid-column: span 2; grid-row: span 2;
    background: var(--blue-mid);
  }
  .fas-card.featured span { color: var(--white); font-size: 16px; }

  /* ── TESTIMONI ── */
  .testimoni { background: var(--gray-soft); }
  .testi-grid {
    display: grid; grid-template-columns: repeat(3, 1fr);
    gap: 24px; margin-top: 56px;
    max-width: 1200px; margin-left: auto; margin-right: auto;
  }
  .testi-card {
    background: var(--white); border-radius: 18px; padding: 30px;
    border: 1px solid rgba(10,36,99,0.06);
    position: relative;
  }
  .testi-card::before {
    content: '"'; font-family: 'Playfair Display', serif;
    font-size: 80px; color: var(--blue-pale);
    position: absolute; top: 10px; right: 24px; line-height: 1;
  }
  .testi-card p { font-size: 14px; color: var(--gray-dark); line-height: 1.7; margin-bottom: 20px; }
  .testi-author { display: flex; align-items: center; gap: 12px; }
  .testi-avatar {
    width: 42px; height: 42px; border-radius: 50%;
    background: var(--blue-mid); display: flex; align-items: center;
    justify-content: center; color: var(--white); font-weight: 700; font-size: 15px;
  }
  .testi-author strong { display: block; font-size: 14px; color: var(--blue-deep); }
  .testi-author small { font-size: 12px; color: var(--gray-text); }
  .stars { color: var(--accent); font-size: 13px; margin-bottom: 14px; letter-spacing: 2px; }

  /* ── PENDAFTARAN ── */
  .pendaftaran {
    background: linear-gradient(135deg, var(--blue-deep) 0%, var(--blue-mid) 100%);
    text-align: center;
  }
  .pendaftaran .section-title { color: var(--white); }
  .pendaftaran .section-sub { color: rgba(255,255,255,0.65); max-width: 520px; margin: 0 auto 40px; }

  .daftar-steps {
    display: flex; gap: 0; justify-content: center;
    margin: 48px auto; max-width: 800px; flex-wrap: wrap;
  }
  .daftar-step {
    display: flex; flex-direction: column; align-items: center;
    flex: 1; min-width: 120px;
  }
  .step-num {
    width: 48px; height: 48px; border-radius: 50%;
    background: rgba(255,255,255,0.15);
    border: 2px solid rgba(255,255,255,0.3);
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; color: var(--white); font-size: 18px;
    position: relative; z-index: 1;
  }
  .daftar-step:not(:last-child) .step-num::after {
    content: ''; position: absolute;
    top: 50%; left: 100%; width: 100%; height: 1px;
    background: rgba(255,255,255,0.2); z-index: 0;
  }
  .daftar-step span { font-size: 12px; color: rgba(255,255,255,0.65); margin-top: 10px; text-align: center; }

  .pendaftaran-form {
    display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; margin-top: 16px;
  }
  .pendaftaran-form input {
    padding: 14px 20px; border-radius: 10px; border: none;
    font-family: 'DM Sans', sans-serif; font-size: 14px;
    width: 260px; background: rgba(255,255,255,0.1);
    color: var(--white); outline: none;
    border: 1px solid rgba(255,255,255,0.2);
  }
  .pendaftaran-form input::placeholder { color: rgba(255,255,255,0.4); }
  .pendaftaran-form input:focus { border-color: rgba(255,255,255,0.5); }
  .btn-daftar {
    background: var(--accent); color: var(--blue-deep);
    padding: 14px 28px; border-radius: 10px; border: none;
    font-weight: 700; font-size: 15px; cursor: pointer;
    font-family: 'DM Sans', sans-serif;
    transition: transform 0.2s, box-shadow 0.2s;
  }
  .btn-daftar:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(245,158,11,0.4); }

  /* ── KONTAK ── */
  .kontak { background: var(--white); }
  .kontak-grid {
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 80px; align-items: start;
    max-width: 1200px; margin: 56px auto 0;
  }
  .kontak-item { display: flex; gap: 16px; align-items: flex-start; margin-bottom: 28px; }
  .kontak-ico {
    width: 44px; height: 44px; background: var(--blue-pale);
    border-radius: 12px; display: flex; align-items: center;
    justify-content: center; font-size: 20px; flex-shrink: 0;
  }
  .kontak-item strong { display: block; font-size: 13px; color: var(--gray-text); font-weight: 400; margin-bottom: 4px; }
  .kontak-item span { font-size: 15px; color: var(--blue-deep); font-weight: 500; }
  .kontak-item a { color: var(--blue-mid); text-decoration: none; font-size: 15px; font-weight: 500; }
  .kontak-item a:hover { text-decoration: underline; }

  .map-placeholder {
    background: var(--blue-pale); border-radius: 20px;
    height: 300px; display: flex; flex-direction: column;
    align-items: center; justify-content: center; gap: 12px;
    border: 2px dashed rgba(10,36,99,0.15);
  }
  .map-placeholder .map-icon { font-size: 48px; }
  .map-placeholder p { font-size: 14px; color: var(--gray-text); }
  .map-placeholder a {
    background: var(--blue-mid); color: var(--white);
    padding: 10px 22px; border-radius: 8px; text-decoration: none;
    font-size: 13px; font-weight: 500; margin-top: 8px;
    transition: background 0.2s;
  }
  .map-placeholder a:hover { background: var(--blue-deep); }

  /* ── FOOTER ── */
  footer {
    background: var(--blue-deep); padding: 60px 6% 30px;
    color: rgba(255,255,255,0.6);
  }
  .footer-grid {
    display: grid; grid-template-columns: 2fr 1fr 1fr 1fr;
    gap: 48px; max-width: 1200px; margin: 0 auto 48px;
  }
  .footer-brand p { font-size: 14px; line-height: 1.7; margin-top: 14px; max-width: 260px; }
  .footer-logo {
    display: flex; align-items: center; gap: 10px;
  }
  .footer-logo .logo-icon {
    width: 36px; height: 36px; background: rgba(255,255,255,0.1);
    border-radius: 8px; display: flex; align-items: center; justify-content: center;
    font-family: 'Playfair Display', serif; color: var(--white); font-size: 16px;
  }
  .footer-logo span { color: var(--white); font-weight: 600; font-size: 14px; }

  .footer-col h4 { color: var(--white); font-size: 14px; font-weight: 600; margin-bottom: 18px; }
  .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 10px; }
  .footer-col ul li a { color: rgba(255,255,255,0.6); text-decoration: none; font-size: 14px; transition: color 0.2s; }
  .footer-col ul li a:hover { color: var(--white); }

  .footer-bottom {
    border-top: 1px solid rgba(255,255,255,0.08);
    padding-top: 24px; text-align: center; font-size: 13px;
    max-width: 1200px; margin: 0 auto;
  }

  /* ── ANIMATIONS ── */
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(24px); }
    to { opacity: 1; transform: translateY(0); }
  }
  @keyframes fadeRight {
    from { opacity: 0; transform: translateX(24px); }
    to { opacity: 1; transform: translateX(0); }
  }

  .reveal {
    opacity: 0; transform: translateY(30px);
    transition: opacity 0.7s ease, transform 0.7s ease;
  }
  .reveal.visible { opacity: 1; transform: translateY(0); }

  /* ── RESPONSIVE ── */
  @media (max-width: 900px) {
    .hero-grid, .profil-grid, .kontak-grid { grid-template-columns: 1fr; gap: 40px; }
    .keunggulan-grid, .program-grid, .testi-grid { grid-template-columns: 1fr; }
    .fasilitas-grid { grid-template-columns: repeat(2,1fr); }
    .fas-card.featured { grid-column: span 2; grid-row: span 1; }
    .footer-grid { grid-template-columns: 1fr 1fr; }
    .nav-links { display: none; }
  }
</style>
</head>
<body>

<!-- NAV -->
<nav id="navbar">
  <a class="nav-logo" href="#">
    <div class="logo-icon">N</div>
    <div>
      <span>SMA Nusantara Unggul</span>
      <small>Terakreditasi A — Sejak 1990</small>
    </div>
  </a>
  <ul class="nav-links">
    <li><a href="#profil">Profil</a></li>
    <li><a href="#keunggulan">Keunggulan</a></li>
    <li><a href="#program">Program</a></li>
    <li><a href="#fasilitas">Fasilitas</a></li>
    <li><a href="#kontak">Kontak</a></li>
  </ul>
  <a class="nav-cta" href="#pendaftaran">Daftar Sekarang</a>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="hero-grid">
    <div>
      <div class="hero-badge">Penerimaan Siswa Baru 2025/2026 Telah Dibuka</div>
      <h1>Membentuk <em>Generasi</em> Unggul & Berkarakter</h1>
      <p>SMA Nusantara Unggul hadir sebagai institusi pendidikan yang menjunjung keunggulan akademik, karakter mulia, dan kesiapan menghadapi tantangan global.</p>
      <div class="hero-btns">
        <a class="btn-primary" href="#pendaftaran">Daftar Sekarang</a>
        <a class="btn-outline" href="#profil">Pelajari Lebih Lanjut</a>
      </div>
      <div class="hero-stats">
        <div class="stat"><strong>98%</strong><small>Tingkat Kelulusan</small></div>
        <div class="stat"><strong>1.200+</strong><small>Siswa Aktif</small></div>
        <div class="stat"><strong>85+</strong><small>Tenaga Pendidik</small></div>
        <div class="stat"><strong>30+</strong><small>Prestasi/Tahun</small></div>
      </div>
    </div>
    <div class="hero-visual">
      <div class="card-float">
        <h3>🏆 Prestasi Terkini</h3>
        <p>Juara 1 Olimpiade Sains Nasional Bidang Matematika 2024 — mewakili Provinsi Jawa Barat.</p>
        <div class="tags">
          <span class="tag">OSN 2024</span>
          <span class="tag">Matematika</span>
          <span class="tag">Juara 1</span>
        </div>
      </div>
      <div class="card-float">
        <h3>🎓 Lulusan Diterima di</h3>
        <p>UI, ITB, UGM, UNPAD, dan berbagai universitas ternama dalam & luar negeri setiap tahunnya.</p>
        <div class="tags">
          <span class="tag">PTN Favorit</span>
          <span class="tag">Beasiswa</span>
          <span class="tag">Luar Negeri</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PROFIL -->
<section class="profil" id="profil">
  <div style="max-width:1200px;margin:0 auto;">
    <div class="section-label">Tentang Kami</div>
    <div class="section-title">Profil Sekolah</div>
    <p class="section-sub">Lebih dari tiga dekade mendidik generasi penerus bangsa dengan standar akademik tinggi dan nilai-nilai luhur.</p>
  </div>
  <div class="profil-grid reveal">
    <div class="profil-img">
      <div class="profil-img-inner">
        <div class="school-emblem">N</div>
        <span>SMA Nusantara Unggul</span>
      </div>
      <div class="badge-akreditasi">⭐ Akreditasi A</div>
    </div>
    <div>
      <p style="font-size:15px;color:var(--gray-text);line-height:1.8;margin-bottom:28px;">
        SMA Nusantara Unggul berdiri pada tahun 1990 di Kota Bandung, Jawa Barat. Selama lebih dari 30 tahun, kami berkomitmen menghadirkan pendidikan berkualitas yang memadukan penguasaan ilmu pengetahuan, pembentukan karakter, dan pengembangan bakat siswa secara menyeluruh.
      </p>
      <ul class="profil-list">
        <li>
          <div class="icon">🏫</div>
          <div>
            <strong>Nama Sekolah</strong>
            <span>SMA Nusantara Unggul</span>
          </div>
        </li>
        <li>
          <div class="icon">📋</div>
          <div>
            <strong>NPSN</strong>
            <span>20234567</span>
          </div>
        </li>
        <li>
          <div class="icon">📅</div>
          <div>
            <strong>Tahun Berdiri</strong>
            <span>1990</span>
          </div>
        </li>
        <li>
          <div class="icon">👤</div>
          <div>
            <strong>Kepala Sekolah</strong>
            <span>Dr. Ahmad Fauzi, M.Pd.</span>
          </div>
        </li>
        <li>
          <div class="icon">🏛️</div>
          <div>
            <strong>Status</strong>
            <span>Sekolah Swasta — Yayasan Nusantara Maju</span>
          </div>
        </li>
      </ul>
    </div>
  </div>
</section>

<!-- KEUNGGULAN -->
<section id="keunggulan" style="background:var(--white);padding:90px 6%;">
  <div style="max-width:1200px;margin:0 auto;" class="center">
    <div class="section-label">Mengapa Kami</div>
    <div class="section-title">Keunggulan Kami</div>
    <p class="section-sub">Kami hadir dengan berbagai keistimewaan yang dirancang untuk mendukung tumbuh kembang siswa secara optimal.</p>
  </div>
  <div class="keunggulan-grid">
    <div class="keunggulan-card reveal">
      <div class="kard-icon">📚</div>
      <h3>Kurikulum Terpadu</h3>
      <p>Menggabungkan Kurikulum Merdeka dengan program pengayaan akademik internasional, menyiapkan siswa untuk kompetisi nasional dan global.</p>
    </div>
    <div class="keunggulan-card reveal">
      <div class="kard-icon">👩‍🏫</div>
      <h3>Guru Berpengalaman</h3>
      <p>85+ tenaga pendidik berpendidikan S2 dan S3, bersertifikat, dan berpengalaman lebih dari 10 tahun di bidangnya.</p>
    </div>
    <div class="keunggulan-card reveal">
      <div class="kard-icon">🔬</div>
      <h3>Laboratorium Modern</h3>
      <p>Fasilitas lab Fisika, Kimia, Biologi, dan Komputer dengan peralatan terkini yang mendukung pembelajaran berbasis riset.</p>
    </div>
    <div class="keunggulan-card reveal">
      <div class="kard-icon">🌐</div>
      <h3>Program Internasional</h3>
      <p>Kerjasama dengan sekolah mitra di Jepang, Australia, dan Malaysia untuk program pertukaran pelajar dan joint-study.</p>
    </div>
    <div class="keunggulan-card reveal">
      <div class="kard-icon">🏆</div>
      <h3>Rekam Prestasi Gemilang</h3>
      <p>Lebih dari 30 penghargaan nasional per tahun di bidang akademik, seni, olahraga, dan teknologi.</p>
    </div>
    <div class="keunggulan-card reveal">
      <div class="kard-icon">❤️</div>
      <h3>Pembinaan Karakter</h3>
      <p>Program mentoring, pesantren kilat, dan kegiatan sosial yang membentuk siswa berjiwa pemimpin dan berempati tinggi.</p>
    </div>
  </div>
</section>

<!-- PROGRAM -->
<section class="program" id="program">
  <div style="max-width:1200px;margin:0 auto;" class="center">
    <div class="section-label">Pilihan Kami</div>
    <div class="section-title">Program Unggulan</div>
    <p class="section-sub">Tiga jalur program dirancang untuk memenuhi kebutuhan dan potensi unik setiap siswa.</p>
  </div>
  <div class="program-grid">
    <div class="program-card reveal">
      <div class="num">01</div>
      <h3>Program MIPA</h3>
      <p>Fokus pada ilmu Matematika, Fisika, Kimia, dan Biologi dengan pendekatan eksperimen dan pemecahan masalah kompleks.</p>
      <ul class="program-features">
        <li>Kelas olimpiade sains</li>
        <li>Praktikum intensif setiap minggu</li>
        <li>Bimbingan masuk PTN favorit</li>
        <li>Magang di lembaga riset</li>
      </ul>
    </div>
    <div class="program-card reveal">
      <div class="num">02</div>
      <h3>Program IPS</h3>
      <p>Mengembangkan pemahaman mendalam tentang Ekonomi, Sejarah, Geografi, dan Sosiologi untuk calon pemimpin masa depan.</p>
      <ul class="program-features">
        <li>Simulasi bisnis & investasi</li>
        <li>Debat nasional & internasional</li>
        <li>Kunjungan industri reguler</li>
        <li>Klub kewirausahaan siswa</li>
      </ul>
    </div>
    <div class="program-card reveal">
      <div class="num">03</div>
      <h3>Program Bahasa</h3>
      <p>Mendalami Bahasa Inggris, Bahasa Jepang, dan Bahasa Arab dengan pendekatan komunikatif dan budaya global.</p>
      <ul class="program-features">
        <li>Kelas bilingual penuh</li>
        <li>Persiapan TOEFL & IELTS</li>
        <li>Program pertukaran pelajar</li>
        <li>Lomba sastra nasional</li>
      </ul>
    </div>
  </div>
</section>

<!-- FASILITAS -->
<section id="fasilitas" style="background:var(--gray-soft);padding:90px 6%;">
  <div style="max-width:1200px;margin:0 auto;" class="center">
    <div class="section-label">Sarana & Prasarana</div>
    <div class="section-title">Fasilitas Lengkap</div>
    <p class="section-sub">Lingkungan belajar yang nyaman dan modern untuk menunjang setiap aspek perkembangan siswa.</p>
  </div>
  <div class="fasilitas-grid">
    <div class="fas-card featured reveal">
      <div class="fas-icon">🏟️</div>
      <span>Aula Serbaguna 1.500 Kursi</span>
    </div>
    <div class="fas-card reveal">
      <div class="fas-icon">🔬</div>
      <span>Laboratorium Sains</span>
    </div>
    <div class="fas-card reveal">
      <div class="fas-icon">💻</div>
      <span>Lab Komputer</span>
    </div>
    <div class="fas-card reveal">
      <div class="fas-icon">📚</div>
      <span>Perpustakaan Digital</span>
    </div>
    <div class="fas-card reveal">
      <div class="fas-icon">⚽</div>
      <span>Lapangan Olahraga</span>
    </div>
    <div class="fas-card reveal">
      <div class="fas-icon">🎨</div>
      <span>Studio Seni</span>
    </div>
    <div class="fas-card reveal">
      <div class="fas-icon">🍽️</div>
      <span>Kantin Sehat</span>
    </div>
    <div class="fas-card reveal">
      <div class="fas-icon">🏥</div>
      <span>UKS & Klinik</span>
    </div>
    <div class="fas-card reveal">
      <div class="fas-icon">🚌</div>
      <span>Bus Antar-Jemput</span>
    </div>
    <div class="fas-card reveal">
      <div class="fas-icon">🛕</div>
      <span>Mushola Besar</span>
    </div>
  </div>
</section>

<!-- TESTIMONI -->
<section class="testimoni" id="testimoni">
  <div style="max-width:1200px;margin:0 auto;" class="center">
    <div class="section-label">Kata Mereka</div>
    <div class="section-title">Testimoni</div>
    <p class="section-sub">Dengarkan langsung pengalaman siswa, orang tua, dan alumni kami.</p>
  </div>
  <div class="testi-grid">
    <div class="testi-card reveal">
      <div class="stars">★★★★★</div>
      <p>Guru-gurunya sangat kompeten dan sabar. Anak saya yang awalnya takut matematika, sekarang justru jadi juara olimpiade. Luar biasa!</p>
      <div class="testi-author">
        <div class="testi-avatar">R</div>
        <div>
          <strong>Ratna Dewi</strong>
          <small>Orang Tua Siswa Kelas XI MIPA</small>
        </div>
      </div>
    </div>
    <div class="testi-card reveal">
      <div class="stars">★★★★★</div>
      <p>Tiga tahun di SMA Nusantara Unggul mengubah saya. Sekarang saya kuliah di ITB dengan beasiswa penuh. Terima kasih untuk semua pembinaan yang diberikan.</p>
      <div class="testi-author">
        <div class="testi-avatar">F</div>
        <div>
          <strong>Fariz Alhakim</strong>
          <small>Alumni 2023 — Mahasiswa ITB</small>
        </div>
      </div>
    </div>
    <div class="testi-card reveal">
      <div class="stars">★★★★★</div>
      <p>Fasilitas lengkap, guru ramah, dan lingkungan sekolah sangat kondusif. Pilihan terbaik untuk putra-putri Anda menggapai masa depan cerah.</p>
      <div class="testi-author">
        <div class="testi-avatar">S</div>
        <div>
          <strong>Sinta Maulida</strong>
          <small>Orang Tua Siswa — Angkatan 2024</small>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PENDAFTARAN -->
<section class="pendaftaran" id="pendaftaran">
  <div class="section-label" style="color:var(--accent);">PSB 2025/2026</div>
  <div class="section-title">Daftar Sekarang</div>
  <p class="section-sub">Jangan lewatkan kesempatan emas bergabung dengan keluarga besar SMA Nusantara Unggul. Kuota terbatas!</p>

  <div class="daftar-steps">
    <div class="daftar-step">
      <div class="step-num">1</div>
      <span>Isi Formulir Online</span>
    </div>
    <div class="daftar-step">
      <div class="step-num">2</div>
      <span>Verifikasi Berkas</span>
    </div>
    <div class="daftar-step">
      <div class="step-num">3</div>
      <span>Tes Seleksi</span>
    </div>
    <div class="daftar-step">
      <div class="step-num">4</div>
      <span>Pengumuman</span>
    </div>
    <div class="daftar-step">
      <div class="step-num">5</div>
      <span>Registrasi Ulang</span>
    </div>
  </div>

  <div class="pendaftaran-form">
    <input type="text" placeholder="Nama Lengkap Calon Siswa">
    <input type="tel" placeholder="Nomor WhatsApp">
    <button class="btn-daftar" onclick="alert('Terima kasih! Tim kami akan menghubungi Anda segera.')">Kirim Minat →</button>
  </div>
  <p style="color:rgba(255,255,255,0.4);font-size:12px;margin-top:16px;">
    Atau hubungi kami via WhatsApp: <a href="https://wa.me/6281234567890" style="color:rgba(255,255,255,0.7);">+62 812-3456-7890</a>
  </p>
</section>

<!-- KONTAK -->
<section class="kontak" id="kontak">
  <div style="max-width:1200px;margin:0 auto;">
    <div class="section-label">Hubungi Kami</div>
    <div class="section-title">Informasi Kontak</div>
    <p class="section-sub">Kami siap menjawab setiap pertanyaan Anda tentang sekolah dan proses pendaftaran.</p>
  </div>
  <div class="kontak-grid">
    <div>
      <div class="kontak-item reveal">
        <div class="kontak-ico">📍</div>
        <div>
          <strong>Alamat</strong>
          <span>Jl. Pendidikan Raya No. 88, Kelurahan Sukasari,<br>Kecamatan Coblong, Kota Bandung 40133, Jawa Barat</span>
        </div>
      </div>
      <div class="kontak-item reveal">
        <div class="kontak-ico">📞</div>
        <div>
          <strong>Telepon</strong>
          <a href="tel:+62222345678">(022) 234-5678</a>
        </div>
      </div>
      <div class="kontak-item reveal">
        <div class="kontak-ico">📱</div>
        <div>
          <strong>WhatsApp</strong>
          <a href="https://wa.me/6281234567890">+62 812-3456-7890</a>
        </div>
      </div>
      <div class="kontak-item reveal">
        <div class="kontak-ico">📧</div>
        <div>
          <strong>Email</strong>
          <a href="mailto:info@smanusantaraunggul.sch.id">info@smanusantaraunggul.sch.id</a>
        </div>
      </div>
      <div class="kontak-item reveal">
        <div class="kontak-ico">🕐</div>
        <div>
          <strong>Jam Operasional</strong>
          <span>Senin – Sabtu: 07.00 – 16.00 WIB</span>
        </div>
      </div>
    </div>
    <div class="map-placeholder reveal">
      <div class="map-icon">🗺️</div>
      <p>SMA Nusantara Unggul<br>Jl. Pendidikan Raya No. 88, Bandung</p>
      <a href="https://maps.google.com" target="_blank">Lihat di Google Maps →</a>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="footer-grid">
    <div class="footer-brand">
      <div class="footer-logo">
        <div class="logo-icon">N</div>
        <span>SMA Nusantara Unggul</span>
      </div>
      <p>Mendidik generasi penerus bangsa dengan keunggulan akademik, karakter mulia, dan wawasan global sejak 1990.</p>
    </div>
    <div class="footer-col">
      <h4>Tautan Cepat</h4>
      <ul>
        <li><a href="#profil">Profil Sekolah</a></li>
        <li><a href="#keunggulan">Keunggulan</a></li>
        <li><a href="#program">Program</a></li>
        <li><a href="#fasilitas">Fasilitas</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Program</h4>
      <ul>
        <li><a href="#program">Program MIPA</a></li>
        <li><a href="#program">Program IPS</a></li>
        <li><a href="#program">Program Bahasa</a></li>
        <li><a href="#pendaftaran">Pendaftaran</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Kontak</h4>
      <ul>
        <li><a href="tel:+62222345678">(022) 234-5678</a></li>
        <li><a href="https://wa.me/6281234567890">WhatsApp</a></li>
        <li><a href="mailto:info@smanusantaraunggul.sch.id">Email Kami</a></li>
        <li><a href="#kontak">Lokasi</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <p>© 2025 SMA Nusantara Unggul — Yayasan Nusantara Maju. Seluruh hak dilindungi.</p>
  </div>
</footer>

<script>
  // Navbar scroll effect
  window.addEventListener('scroll', () => {
    document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 50);
  });

  // Reveal on scroll
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((e, i) => {
      if (e.isIntersecting) {
        setTimeout(() => e.target.classList.add('visible'), i * 80);
        observer.unobserve(e.target);
      }
    });
  }, { threshold: 0.1 });

  document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>
</body>
</html>