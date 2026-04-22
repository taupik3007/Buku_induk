@extends('administration.master')

@push('link')
    <link rel="stylesheet" href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endpush

@section('title')
    SiMAPUT | Pembagian Kelas
@endsection

@section('content')
    <style>
        .stat-card {
            border-radius: 12px;
            border: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12) !important;
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .jurusan-card {
            border-radius: 12px;
            border: 1px solid #e9ecef;
            transition: all 0.2s ease;
        }

        .jurusan-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .jurusan-header {
            border-radius: 10px 10px 0 0;
            padding: 16px 20px;
        }

        .badge-kelas {
            font-size: 11px;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 600;
        }

        .progress-thin {
            height: 6px;
            border-radius: 10px;
        }

        .step-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 12px 0;
            border-bottom: 1px dashed #e9ecef;
        }

        .step-item:last-child {
            border-bottom: none;
        }

        .step-num {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .alert-info-soft {
            background: #e8f4fd;
            border: 1px solid #b8d9f5;
            border-radius: 10px;
            color: #1565c0;
        }

        .btn-process {
            background: linear-gradient(135deg, #1976d2, #1565c0);
            border: none;
            border-radius: 10px;
            padding: 12px 28px;
            font-weight: 600;
            font-size: 15px;
            letter-spacing: 0.3px;
            box-shadow: 0 4px 14px rgba(25, 118, 210, 0.4);
            transition: all 0.2s ease;
        }

        .btn-process:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(25, 118, 210, 0.5);
        }

        .btn-finalize {
            background: linear-gradient(135deg, #2e7d32, #1b5e20);
            border: none;
            border-radius: 10px;
            padding: 12px 28px;
            font-weight: 600;
            font-size: 15px;
            box-shadow: 0 4px 14px rgba(46, 125, 50, 0.35);
            transition: all 0.2s ease;
        }

        .btn-finalize:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 125, 50, 0.45);
        }

        .status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 6px;
        }

        .table-preview th {
            background: #f0f4ff;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #5c6bc0;
            font-weight: 700;
            border: none;
        }

        .table-preview td {
            font-size: 13px;
            vertical-align: middle;
            border-color: #f0f0f0;
        }

        .empty-state {
            padding: 40px 20px;
            text-align: center;
        }

        .empty-state i {
            font-size: 48px;
            color: #dee2e6;
            margin-bottom: 12px;
        }
    </style>

    {{-- Breadcrumb --}}
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">PEMBAGIAN KELAS</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted text-decoration-none"
                                    href="/administration/classes">Daftar Kelas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pembagian Kelas</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('assets/images/breadcrumb/ChatBc.png') }}" alt="modernize-img"
                            class="img-fluid mb-n4" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- STAT CARDS --}}
    <div class="row g-3 mb-4">
        <div class="col-xl-4 col-sm-6">
            <div class="card stat-card shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background:#e3f2fd;">
                        <i class="ti ti-users text-primary"></i>
                    </div>
                    <div>
                        <div class="text-muted" style="font-size:12px;">Total Siswa Diterima</div>
                        {{-- Static value --}}
                        <div class="fw-bold fs-4">{{$studentCount}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6">
            <div class="card stat-card shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background:#fff3e0;">
                        <i class="ti ti-stack-2 text-warning"></i>
                    </div>
                    <div>
                        <div class="text-muted" style="font-size:12px;">Total Jurusan</div>
                        <div class="fw-bold fs-4">{{ $major->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6">
            <div class="card stat-card shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background:#fce4ec;">
                        <i class="ti ti-check text-danger"></i>
                    </div>
                    <div>
                        <div class="text-muted" style="font-size:12px;">Status Pembagian</div>
                        <div class="fw-bold" style="font-size:15px;">
                            <span class="status-dot bg-warning"></span>Belum Diproses
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<form method="POST" action="{{ route('administration.classAssignment.process') }}">
    @csrf

    <input type="hidden" name="ppd_id" value="{{ $selectedPpdb->ppd_id }}">
    <div class="row g-3">

        {{-- LEFT: Jumlah Siswa Per Jurusan --}}
        <div class="col-xl-8">
            <div class="card shadow-sm" style="border-radius:12px;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h5 class="card-title mb-1">Siswa Per Jurusan</h5>
                            <p class="text-muted mb-0" style="font-size:13px;">Distribusi siswa yang diterima berdasarkan
                                jurusan</p>
                        </div>
                        <span class="badge bg-primary-subtle text-primary"
                            style="border-radius:20px;padding:6px 14px;font-size:12px;">
                            Tahun Ajaran 2024/2025
                        </span>
                    </div>

                    {{-- Static jurusan cards --}}
                    @php
                        $colors = [
                            ['color' => '#1976d2', 'bg' => '#e3f2fd', 'icon' => 'ti ti-code'],
                            ['color' => '#2e7d32', 'bg' => '#e8f5e9', 'icon' => 'ti ti-network'],
                            ['color' => '#e65100', 'bg' => '#fff3e0', 'icon' => 'ti ti-palette'],
                            ['color' => '#6a1b9a', 'bg' => '#f3e5f5', 'icon' => 'ti ti-school'],
                            ['color' => '#00838f', 'bg' => '#e0f7fa', 'icon' => 'ti ti-atom'],
                        ];
                    @endphp

                    <div class="row g-3">
                        @foreach ($major as $i => $jur)
                            @php
                                $c = $colors[$i % count($colors)];
                                $jumlahKelas = old('jumlah_kelas.' . $jur->mjr_id, 2);
                                $totalKapasitas = $jumlahKelas * 40;
                                $siswa = $jur->accepted_students_count ?? 0;
                                $pct = $totalKapasitas > 0 ? min(round(($siswa / $totalKapasitas) * 100), 100) : 0;
                            @endphp
                            <div class="col-12">
                                <div class="jurusan-card">
                                    <div class="jurusan-header" style="background:{{ $c['bg'] }};">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <div
                                                    style="background:{{ $c['color'] }}20; color:{{ $c['color'] }}; width:40px; height:40px; font-size:18px; border-radius:10px; display:flex; align-items:center; justify-content:center;">
                                                    <i class="{{ $c['icon'] }}"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold"
                                                        style="color:{{ $c['color'] }}; font-size:14px;">
                                                        {{ $jur->mjr_name }}</div>
                                                    <div class="text-muted" style="font-size:12px;">{{ $jur->mjr_abbr }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <div class="fw-bold fs-4" style="color:{{ $c['color'] }};">
                                                    {{ $siswa }}</div>
                                                <div class="text-muted" style="font-size:11px;">siswa diterima</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-3">
                                        {{-- Input jumlah kelas --}}
                                        <div class="d-flex align-items-center gap-3 mb-3 p-2 rounded"
                                            style="background:#f8f9fa; border:1px dashed #dee2e6;">
                                            <label class="text-muted mb-0 fw-semibold"
                                                style="font-size:12px; white-space:nowrap;">
                                                <i class="ti ti-door me-1"></i>Jumlah Kelas:
                                            </label>
                                            <div class="d-flex align-items-center gap-2">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-secondary px-2 py-0 kelas-minus"
                                                    data-id="{{ $jur->mjr_id }}"
                                                    style="border-radius:6px; line-height:1.6;">
                                                    <i class="ti ti-minus" style="font-size:11px;"></i>
                                                </button>
                                                <input type="number" name="jumlah_kelas[{{ $jur->mjr_id }}]"
                                                    id="kelas_{{ $jur->mjr_id }}"
                                                    class="form-control form-control-sm text-center kelas-input"
                                                    data-id="{{ $jur->mjr_id }}" data-siswa="{{ $siswa }}"
                                                    data-abbr="{{ $jur->mjr_abbr }}" value="{{ $jumlahKelas }}"
                                                    min="1" max="20"
                                                    style="width:55px; border-radius:6px; font-weight:600;">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-secondary px-2 py-0 kelas-plus"
                                                    data-id="{{ $jur->mjr_id }}"
                                                    style="border-radius:6px; line-height:1.6;">
                                                    <i class="ti ti-plus" style="font-size:11px;"></i>
                                                </button>
                                            </div>
                                            <span class="text-muted ms-auto" style="font-size:11px;">
                                                maks. kapasitas <span class="fw-semibold kapasitas-total"
                                                    id="kapasitas_{{ $jur->mjr_id }}">{{ $totalKapasitas }}</span> siswa
                                            </span>
                                        </div>

                                        {{-- Progress --}}
                                        <div class="d-flex justify-content-between mb-1" style="font-size:12px;">
                                            <span class="text-muted">Kapasitas terisi</span>
                                            <span class="fw-semibold">
                                                {{ $siswa }} / <span class="kapasitas-label"
                                                    id="kapasitas_label_{{ $jur->mjr_id }}">{{ $totalKapasitas }}</span>
                                            </span>
                                        </div>
                                        <div class="progress progress-thin">
                                            <div class="progress-bar kapasitas-bar" id="bar_{{ $jur->mjr_id }}"
                                                style="width:{{ $pct }}%; background:{{ $c['color'] }}; border-radius:10px; transition:width 0.3s ease;">
                                            </div>
                                        </div>

                                        {{-- Badge kelas preview --}}
                                        <div class="d-flex flex-wrap gap-2 mt-2 kelas-badges"
                                            id="badges_{{ $jur->mjr_id }}">
                                            @for ($k = 1; $k <= $jumlahKelas; $k++)
                                                <span class="badge-kelas"
                                                    style="background:{{ $c['color'] }}18; color:{{ $c['color'] }};">
                                                    {{ $jur->mjr_abbr }}-{{ $k }}
                                                </span>
                                            @endfor
                                            <span class="ms-auto text-muted pct-label" id="pct_{{ $jur->mjr_id }}"
                                                style="font-size:11px;">{{ $pct }}% terisi</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @push('script')
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Plus button
                                document.querySelectorAll('.kelas-plus').forEach(btn => {
                                    btn.addEventListener('click', function() {
                                        const id = this.dataset.id;
                                        const input = document.getElementById('kelas_' + id);
                                        input.value = Math.min(parseInt(input.value) + 1, 20);
                                        updateKelas(input);
                                    });
                                });

                                // Minus button
                                document.querySelectorAll('.kelas-minus').forEach(btn => {
                                    btn.addEventListener('click', function() {
                                        const id = this.dataset.id;
                                        const input = document.getElementById('kelas_' + id);
                                        input.value = Math.max(parseInt(input.value) - 1, 1);
                                        updateKelas(input);
                                    });
                                });

                                // Manual input change
                                document.querySelectorAll('.kelas-input').forEach(input => {
                                    input.addEventListener('change', function() {
                                        this.value = Math.min(Math.max(parseInt(this.value) || 1, 1), 20);
                                        updateKelas(this);
                                    });
                                });

                                function updateKelas(input) {
                                    const id = input.dataset.id;
                                    const abbr = input.dataset.abbr;
                                    const siswa = parseInt(input.dataset.siswa);
                                    const jumlah = parseInt(input.value);
                                    const kapasitas = jumlah * 40;
                                    const pct = Math.min(Math.round((siswa / kapasitas) * 100), 100);

                                    // Update kapasitas text
                                    document.getElementById('kapasitas_' + id).textContent = kapasitas;
                                    document.getElementById('kapasitas_label_' + id).textContent = kapasitas;

                                    // Update progress bar
                                    document.getElementById('bar_' + id).style.width = pct + '%';
                                    document.getElementById('pct_' + id).textContent = pct + '% terisi';

                                    // Update badges
                                    const badgeContainer = document.getElementById('badges_' + id);
                                    const pctSpan = badgeContainer.querySelector('.pct-label');
                                    // Remove old badges
                                    badgeContainer.querySelectorAll('.badge-kelas').forEach(b => b.remove());
                                    // Re-add badges
                                    for (let k = 1; k <= jumlah; k++) {
                                        const span = document.createElement('span');
                                        span.className = 'badge-kelas';
                                        span.style.cssText = badgeContainer.closest('.jurusan-card')
                                            .querySelector('.badge-kelas') ?
                                            badgeContainer.closest('.jurusan-card').querySelector('.badge-kelas').style.cssText :
                                            '';
                                        span.textContent = abbr + '-' + k;
                                        badgeContainer.insertBefore(span, pctSpan);
                                    }
                                    pctSpan.textContent = pct + '% terisi';
                                }
                            });
                        </script>
                    @endpush
                </div>
            </div>
        </div>

        {{-- RIGHT: Panel Proses --}}
        <div class="col-xl-4">

            {{-- Panduan --}}
            <div class="card shadow-sm mb-3" style="border-radius:12px;">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="ti ti-info-circle text-primary me-2"></i>Panduan Pembagian
                    </h5>
                    <div class="step-item">
                        <div class="step-num" style="background:#e3f2fd; color:#1976d2;">1</div>
                        <div>
                            <div class="fw-semibold" style="font-size:13px;">Pastikan Kelas Tersedia</div>
                            <div class="text-muted" style="font-size:12px;">Tiap jurusan harus sudah memiliki kelas yang
                                dibuat</div>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-num" style="background:#e8f5e9; color:#2e7d32;">2</div>
                        <div>
                            <div class="fw-semibold" style="font-size:13px;">Klik Proses Pembagian</div>
                            <div class="text-muted" style="font-size:12px;">Sistem akan membagi otomatis berdasarkan abjad
                                per jurusan</div>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-num" style="background:#fff3e0; color:#e65100;">3</div>
                        <div>
                            <div class="fw-semibold" style="font-size:13px;">Review Hasil Preview</div>
                            <div class="text-muted" style="font-size:12px;">Cek hasil pembagian sebelum disimpan permanen
                            </div>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-num" style="background:#fce4ec; color:#c62828;">4</div>
                        <div>
                            <div class="fw-semibold" style="font-size:13px;">Finalisasi</div>
                            <div class="text-muted" style="font-size:12px;">Simpan permanen, siswa bisa melihat kelas
                                mereka</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Aksi --}}
            <div class="card shadow-sm" style="border-radius:12px;">
                <div class="card-body">
                    <h5 class="card-title mb-1">Proses Pembagian</h5>
                    <p class="text-muted mb-3" style="font-size:13px;">Pilih tahun ajaran lalu jalankan pembagian kelas
                    </p>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:13px;">Tahun Ajaran</label>
                        <select class="form-select form-select-sm" style="border-radius:8px;"
                            onchange="window.location='?ppd_id='+this.value">
                            @foreach ($ppdbList as $ppdb)
                                <option value="{{ $ppdb->ppd_id }}"
                                    {{ $selectedPpdb->ppd_id == $ppdb->ppd_id ? 'selected' : '' }}>
                                    {{ $ppdb->academic->acy_year }} - {{$ppdb->academic->acy_year+1}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="alert-info-soft p-3 mb-3" style="font-size:12px;">
                        <i class="ti ti-alert-circle me-1"></i>
                        Pembagian kelas dilakukan <strong>otomatis</strong> berdasarkan urutan abjad nama siswa per jurusan.
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-process text-white">
                            <i class="ti ti-refresh me-2"></i>Proses Pembagian Kelas
                        </button>
                        <button class="btn btn-finalize text-white"
                            onclick="window.location='/administration/class-assignment/finalize'" disabled>
                            <i class="ti ti-check me-2"></i>Finalisasi Pembagian
                        </button>
                        <button class="btn btn-outline-danger btn-sm" style="border-radius:8px;" disabled>
                            <i class="ti ti-rotate me-2"></i>Reset Pembagian
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>

    {{-- Preview Table (static, akan muncul setelah diproses) --}}
    <div class="card shadow-sm mt-3" style="border-radius:12px;">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h5 class="card-title mb-1">Preview Hasil Pembagian</h5>
                    <p class="text-muted mb-0" style="font-size:13px;">Hasil akan tampil di sini setelah proses pembagian
                        dijalankan</p>
                </div>
                <span class="badge bg-warning-subtle text-warning"
                    style="border-radius:20px;padding:6px 14px;font-size:12px;">
                    <span class="status-dot bg-warning"></span>Belum Diproses
                </span>
            </div>

            {{-- Empty state --}}
            <div class="empty-state">
                <i class="ti ti-layout-grid-add d-block"></i>
                <h6 class="text-muted">Pembagian Kelas Belum Diproses</h6>
                <p class="text-muted" style="font-size:13px;">Klik tombol <strong>"Proses Pembagian Kelas"</strong> di
                    atas untuk memulai pembagian otomatis</p>
            </div>

            {{-- Table (hidden, akan tampil setelah proses) --}}
            {{-- Uncomment ini setelah ada data --}}

            <div class="table-responsive">
                <table class="table table-preview">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Jurusan</th>
                            <th>Kelas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Ahmad Fauzi</td>
                            <td><span class="badge bg-primary-subtle text-primary">RPL</span></td>
                            <td>RPL-1</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-advanced.init.js') }}"></script>
@endpush
