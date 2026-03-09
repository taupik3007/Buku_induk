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
</head>

<body>

    <div class="preloader">
        <img src="{{ asset('assets/images/logos/favicon.png') }}" alt="loader" class="lds-ripple img-fluid" />
    </div>

    <header class="header-fp p-0 w-100">
        <nav class="navbar navbar-expand-lg bg-primary-subtle py-2 py-lg-10">
            <div class="custom-container d-flex align-items-center justify-content-between">
                <a href="../main/frontend-landingpage.html" class="text-nowrap logo-img">
                    <img src="../assets/images/logos/dark-logo.svg" class="dark-logo" alt="Logo-Dark" />
                    <img src="../assets/images/logos/light-logo.svg" class="light-logo" alt="Logo-light" />
                </a>

                <ul class="navbar-nav d-none d-lg-flex flex-row gap-2 ms-auto">
                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 rounded fw-semibold" href="/prospective-student/biodata">
                            Biodata
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 rounded fw-semibold active" href="/prospective-student/ppdb-registration">
                            PPDB
                        </a>
                    </li>
                </ul>

                <button class="navbar-toggler border-0 p-0 shadow-none ms-3" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <i class="ti ti-menu-2 fs-8"></i>
                </button>
            </div>
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
                    <a class="nav-link px-3 py-2 rounded fw-semibold" href="/prospective-student/biodata">
                        Biodata
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded fw-semibold" href="/prospective-student/ppdb">
                        PPDB
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-wrapper overflow-hidden">
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
                                                    <span class="bs-stepper-label">Sekolah Asal</span>
                                                </button>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#step-2">
                                                <button class="step-trigger">
                                                    <span class="bs-stepper-circle">2</span>
                                                    <span class="bs-stepper-label">Persyaratan</span>
                                                </button>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#step-3">
                                                <button class="step-trigger">
                                                    <span class="bs-stepper-circle">3</span>
                                                    <span class="bs-stepper-label">Jurusan</span>
                                                </button>
                                            </div>
                                        </div>

                                        <form method="POST" action="/prospective-student/ppdb">
                                            <input type="hidden" id="registration_id" value="">
                                            @csrf

                                            <div class="bs-stepper-content">

                                                {{-- Step 1: Sekolah Asal --}}
                                                <div id="step-1" class="content">
                                                    <div class="row g-3 mt-2">
                                                        <div class="col-12">
                                                            <h5 class="fw-semibold mb-1">Data Sekolah Asal</h5>
                                                            <p class="text-muted mb-3">Isi informasi sekolah asal kamu</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Nama Sekolah Asal <span class="text-danger">*</span></label>
                                                            <input type="text" name="nama_sekolah" class="form-control" placeholder="Contoh: SMP Negeri 1 Jakarta" required />
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">NPSN Sekolah</label>
                                                            <input type="text" name="npsn" class="form-control" placeholder="Nomor Pokok Sekolah Nasional" />
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Jenis Sekolah <span class="text-danger">*</span></label>
                                                            <select name="jenis_sekolah" class="form-select select2" required>
                                                                <option value="" disabled selected>Pilih Jenis Sekolah</option>
                                                                <option value="SMP">SMP</option>
                                                                <option value="MTs">MTs</option>
                                                                <option value="Paket B">Paket B</option>
                                                                <option value="Lainnya">Lainnya</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Tahun Lulus <span class="text-danger">*</span></label>
                                                            <select name="tahun_lulus" class="form-select select2" required>
                                                                <option value="" disabled selected>Pilih Tahun Lulus</option>
                                                                @for ($y = date('Y'); $y >= date('Y') - 5; $y--)
                                                                    <option value="{{ $y }}">{{ $y }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Nomor Ijazah</label>
                                                            <input type="text" name="no_ijazah" class="form-control" placeholder="Masukkan nomor ijazah" />
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Nilai Rata-rata Ijazah</label>
                                                            <input type="number" name="nilai_ijazah" class="form-control" placeholder="Contoh: 85.50" step="0.01" min="0" max="100" />
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label fw-semibold">Alamat Sekolah</label>
                                                            <textarea name="alamat_sekolah" class="form-control" rows="2" placeholder="Alamat lengkap sekolah asal"></textarea>
                                                        </div>
                                                        <div class="col-12 d-flex justify-content-end mt-3">
                                                            <button type="button" class="btn btn-primary px-5" onclick="saveStep(1)">
                                                                Selanjutnya <i class="ti ti-arrow-right ms-1"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Step 2: Persyaratan --}}
                                                <div id="step-2" class="content">
                                                    <div class="row g-3 mt-2">
                                                        <div class="col-12">
                                                            <h5 class="fw-semibold mb-1">Upload Persyaratan</h5>
                                                            <p class="text-muted mb-3">Upload dokumen persyaratan pendaftaran (format: PDF/JPG/PNG, maks. 2MB)</p>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Foto 3x4 <span class="text-danger">*</span></label>
                                                            <input type="file" name="foto" class="form-control" accept="image/*" required />
                                                            <small class="text-muted">Format: JPG/PNG, maks. 500KB</small>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Scan Ijazah / SKL <span class="text-danger">*</span></label>
                                                            <input type="file" name="ijazah" class="form-control" accept=".pdf,image/*" required />
                                                            <small class="text-muted">Format: PDF/JPG/PNG, maks. 2MB</small>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Kartu Keluarga <span class="text-danger">*</span></label>
                                                            <input type="file" name="kartu_keluarga" class="form-control" accept=".pdf,image/*" required />
                                                            <small class="text-muted">Format: PDF/JPG/PNG, maks. 2MB</small>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Akta Kelahiran <span class="text-danger">*</span></label>
                                                            <input type="file" name="akta_kelahiran" class="form-control" accept=".pdf,image/*" required />
                                                            <small class="text-muted">Format: PDF/JPG/PNG, maks. 2MB</small>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Rapor SMP (Semester 1-5)</label>
                                                            <input type="file" name="rapor" class="form-control" accept=".pdf,image/*" />
                                                            <small class="text-muted">Format: PDF/JPG/PNG, maks. 2MB</small>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Sertifikat Prestasi (Opsional)</label>
                                                            <input type="file" name="sertifikat" class="form-control" accept=".pdf,image/*" />
                                                            <small class="text-muted">Format: PDF/JPG/PNG, maks. 2MB</small>
                                                        </div>

                                                        <div class="col-12 d-flex justify-content-between mt-3">
                                                            <button type="button" class="btn btn-outline-secondary px-5" onclick="stepper.previous()">
                                                                <i class="ti ti-arrow-left me-1"></i> Sebelumnya
                                                            </button>
                                                            <button type="button" class="btn btn-primary px-5" onclick="saveStep(2)">
                                                                Selanjutnya <i class="ti ti-arrow-right ms-1"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Step 3: Jurusan --}}
                                                <div id="step-3" class="content">
                                                    <div class="row g-3 mt-2">
                                                        <div class="col-12">
                                                            <h5 class="fw-semibold mb-1">Pilih Jurusan</h5>
                                                            <p class="text-muted mb-3">Pilih jurusan pilihan pertama dan kedua</p>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Pilihan Jurusan 1 <span class="text-danger">*</span></label>
                                                            <select name="jurusan_1" class="form-select select2" required>
                                                                <option value="" disabled selected>Pilih Jurusan</option>
                                                                <option value="TKJ">Teknik Komputer dan Jaringan (TKJ)</option>
                                                                <option value="RPL">Rekayasa Perangkat Lunak (RPL)</option>
                                                                <option value="MM">Multimedia (MM)</option>
                                                                <option value="AK">Akuntansi (AK)</option>
                                                                <option value="PM">Pemasaran (PM)</option>
                                                                <option value="AP">Administrasi Perkantoran (AP)</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Pilihan Jurusan 2</label>
                                                            <select name="jurusan_2" class="form-select select2">
                                                                <option value="" selected>Pilih Jurusan (Opsional)</option>
                                                                <option value="TKJ">Teknik Komputer dan Jaringan (TKJ)</option>
                                                                <option value="RPL">Rekayasa Perangkat Lunak (RPL)</option>
                                                                <option value="MM">Multimedia (MM)</option>
                                                                <option value="AK">Akuntansi (AK)</option>
                                                                <option value="PM">Pemasaran (PM)</option>
                                                                <option value="AP">Administrasi Perkantoran (AP)</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-12">
                                                            <label class="form-label fw-semibold">Alasan Memilih Jurusan</label>
                                                            <textarea name="alasan_jurusan" class="form-control" rows="3" placeholder="Ceritakan alasan kamu memilih jurusan tersebut..."></textarea>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-check mt-2">
                                                                <input class="form-check-input" type="checkbox" id="pernyataan" name="pernyataan" required />
                                                                <label class="form-check-label" for="pernyataan">
                                                                    Saya menyatakan bahwa semua data yang saya isi adalah <strong>benar dan dapat dipertanggungjawabkan</strong>.
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 d-flex justify-content-between mt-3">
                                                            <button type="button" class="btn btn-outline-secondary px-5" onclick="stepper.previous()">
                                                                <i class="ti ti-arrow-left me-1"></i> Sebelumnya
                                                            </button>
                                                            <button type="submit" class="btn btn-success px-5">
                                                                <i class="ti ti-check me-1"></i> Kirim Pendaftaran
                                                            </button>
                                                        </div>
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
    </div>

    <a href="javascript:void(0)"
        class="top-btn btn btn-primary d-flex align-items-center justify-content-center round-54 p-0 rounded-circle">
        <i class="ti ti-arrow-up fs-7"></i>
    </a>

    <script>
        function saveStep(step) {
            let formData = new FormData(document.querySelector('form'));
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('registration_id', document.getElementById('registration_id').value);

            fetch(`/prospective-student/ppdb/step/${step}`, {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        document.getElementById('registration_id').value = res.id;
                        stepper.next();
                    }
                });
        }
    </script>

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

</body>
</html>