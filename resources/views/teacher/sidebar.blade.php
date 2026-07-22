<aside class="left-sidebar with-vertical">
  <div><!-- ---------------------------------- -->
    <!-- Start Vertical Layout Sidebar -->
    <!-- ---------------------------------- -->
    <div class="brand-logo d-flex align-items-center justify-content-between">
    
      <a href="../main/index.html" class="text-nowrap logo-img d-flex align-items-center">
          
          <!-- Logo -->
          <img
              class="logo-icon"
              src="{{ asset('assets/images/logos/1.png') }}"
              width="45"
              alt="Logo">
  
          <!-- Text -->
          <span class="logo-text ms-2">
              Calon Guru
          </span>
  
      </a>
  
      <a href="javascript:void(0)"
          class="sidebartoggler ms-auto text-decoration-none fs-5 d-block d-xl-none">
          <i class="ti ti-x"></i>
      </a>
  
  </div>
  <style>
    /* Logo */
    .logo-icon {
        animation: logoZoom .5s ease;
    }
    
    /* Tulisan SIPKL */
    .logo-text {
        font-size: 22px;
        font-weight: 700;
        white-space: nowrap;
    
        opacity: 0;
        transform: translateX(-30px);
    
        animation: slideText .7s ease forwards;
        animation-delay: .35s;
    }
    
    /* Logo muncul dulu */
    @keyframes logoZoom {
        from {
            opacity: 0;
            transform: scale(.7);
        }
    
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    /* SIPKL keluar dari samping logo */
    @keyframes slideText {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
    
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    </style>


    <nav class="sidebar-nav scroll-sidebar" data-simplebar>
      <ul id="sidebarnav">
        <!-- ---------------------------------- -->
        <!-- Home -->
        <!-- ---------------------------------- -->
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Dashboard</span>
        </li>
        <!-- ---------------------------------- -->
        <!-- Dashboard -->
        <!-- ---------------------------------- -->
        <li class="sidebar-item">
          <a class="sidebar-link" href="/teacher/dashboard"  aria-expanded="false">
            <span>
              <i class="ti ti-aperture"></i>
            </span>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>
        <!-- ---------------------------------- -->
        <!-- akademik -->
        <!-- ---------------------------------- -->
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Lamaran</span>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link" href="/teacher/teacher-requirement"  aria-expanded="false">
            <span>
              <i class="ti ti-aperture"></i>
            </span>
            <span class="hide-sitemap">Persyaratan Lamaran</span>
          </a>
        </li>
        
        @php
        $teacher = \App\Models\Teacher::with('teacherBio')
            ->where('tcr_user_id', auth()->id())
            ->first();
    
        $status = $teacher?->teacherBio?->tcb_status;
    
        $url = match($status) {
            'pending'  => route('teacher.prospectiveTeacher.waiting'),
            'accepted' => route('teacher.dashboard.index'),
            default    => route('teacher.prospectiveTeacher.biodata'),
        };
    @endphp
    
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ $url }}">
            <span><i class="ti ti-user-exclamation"></i></span>
            <span class="hide-menu">Lamaran yang Diajukan</span>
        </a>
    </li>
        {{-- <li class="sidebar-item">
          <a class="sidebar-link" href="/administration/subject"  aria-expanded="false">
            <span>
              <i class="ti ti-users-group"></i>
            </span>
            <span class="hide-menu">Mata Pelajaran</span>
          </a>
        </li> --}}

        {{-- <li class="sidebar-item">
          <a class="sidebar-link" href="/administration/academic-years/"  aria-expanded="false">
            <span>
              <i class="ti ti-calendar-time"></i>
            </span>
            <span class="hide-menu">Tahun Ajaran</span>
          </a>
        </li>
 --}}

        {{-- <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Kepegawaian</span>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link" href="/administration/teacher/"  aria-expanded="false">
            <span>
              <i class="ti ti-user"></i>
            </span>
            <span class="hide-menu">Guru</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="/administration/employee/"  aria-expanded="false">
            <span>
              <i class="ti ti-user"></i>
            </span>
            <span class="hide-menu">Pegawai</span>
          </a>
        </li> --}}

        <!-- ---------------------------------- -->
        <!-- PPDB -->
        <!-- ---------------------------------- -->
       {{-- <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">MANAJEMEN SPMB</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="/administration/ppdb"  aria-expanded="false">
            <span>
              <i class="ti ti-tag-plus"></i>
            </span>
            <span class="hide-sitemap">SPMB</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="/administration/ppdb-requirement/0"  aria-expanded="false">
            <span>
              <i class="ti ti-list-check"></i>
            </span>
            <span class="hide-sitemap">Persyaratan</span>
          </a>
        </li> --}}
      <!-- ---------------------------------- -->
        <!-- PENERIMAAN PPDB -->
        <!-- ---------------------------------- -->


        {{-- <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">PENERIMAAN SPMB</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="/administration/ppdb-reception"  aria-expanded="false">
            <span>
              <i class="ti ti-user-exclamation"></i>
            </span>
            <span class="hide-sitemap">Daftar Calon Siswa</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="/administration/ppdb-reception/accepted"  aria-expanded="false">
            <span>
              <i class="ti ti-user-check"></i>
            </span>
            <span class="hide-sitemap">Daftar Diterima</span>
          </a>
          <li class="sidebar-item">
          <a class="sidebar-link" href="/administration/ppdb-reception/rejected"  aria-expanded="false">
            <span>
              <i class="ti ti-user-x"></i>
            </span>
            <span class="hide-sitemap">Daftar Ditolak</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="/administration/class-assignment/"  aria-expanded="false">
            <span>
              <i class="ti ti-users-group"></i>
            </span>
            <span class="hide-sitemap">Pembagian Kelas</span>
          </a>
        </li>
        </li>

        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">PENERIMAAN GURU</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="/administration/teacher-reception"  aria-expanded="false">
            <span>
              <i class="ti ti-user-exclamation"></i>
            </span>
            <span class="hide-sitemap">Daftar Calon Guru</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="/administration/teacher-reception/accepted"  aria-expanded="false">
            <span>
              <i class="ti ti-user-check"></i>
            </span>
            <span class="hide-sitemap">Daftar Diterima</span>
          </a>
          <li class="sidebar-item">
          <a class="sidebar-link" href="/administration/teacher-reception/rejected"  aria-expanded="false">
            <span>
              <i class="ti ti-user-x"></i>
            </span>
            <span class="hide-sitemap">Daftar Ditolak</span>
          </a>
        </li>
        </li> --}}
    </nav>

    <div class="fixed-profile p-3 mx-4 mb-2 bg-secondary-subtle rounded mt-3">
      <div class="hstack gap-3">
        <div class="john-img">
          <img src="../assets/images/profile/user-1.jpg" class="rounded-circle" width="40" height="40" alt="modernize-img" />
        </div>
        <div class="john-title">
          <h6 class="mb-0 fs-4 fw-semibold">Mathew</h6>
          <span class="fs-2">Designer</span>
        </div>
        <button class="border-0 bg-transparent text-primary ms-auto" tabindex="0" type="button" aria-label="logout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="logout">
          <i class="ti ti-power fs-6"></i>
        </button>
      </div>
    </div>

    <!-- ---------------------------------- -->
    <!-- Start Vertical Layout Sidebar -->
    <!-- ---------------------------------- -->
  </div>
</aside>