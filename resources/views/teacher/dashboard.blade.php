@extends('teacher.master')

@push('link')
  <link rel="stylesheet" href="{{asset('assets/libs/owl.carousel/dist/assets/owl.carousel.min.css')}}" />
@endpush

@section('title')
    E-Laundry | Dashboard
@endsection

@section('content')
<style>
    .profile-card{

border-radius:22px;
overflow:hidden;

}

.profile-animation{

height:100%;
min-height:230px;

display:flex;
justify-content:center;
align-items:center;

background:linear-gradient(
    135deg,
    #eef4ff,
    #dbe8ff
);

}

.success-bg{

background:linear-gradient(
    135deg,
    #d9ffe9,
    #b5f5cf
);

}

.profile-animation lottie-player{

width:240px;
height:240px;

}
.progress-bar{

animation:pulse 2s infinite;

}

@keyframes pulse{

0%{
filter:brightness(100%);
}

50%{
filter:brightness(120%);
}

100%{
filter:brightness(100%);
}

}
</style>
<div class="d-flex align-items-center gap-4 mb-4">
  <div class="position-relative">
    <div class="border border-2 border-primary rounded-circle">
      <img src="{{ Auth::user()?->usr_photo
        ? asset('storage/'.Auth::user()->usr_photo)
        : asset('assets/images/profile/user-1.jpg') }}" class="rounded-circle m-1" alt="user1" width="60" />
    </div>
      <span class="visually-hidden">unread messages</span>
    </span>
  </div>
  <div>
    <h3 class="fw-semibold">Halo, {{ auth()->user()->usr_name }}</span></h3>
    <span>Terima kasih sudah menggunakan layanan laundry kami. Hemat waktu, biarkan kami yang bekerja untuk Anda✨
    </span>
  </div>
</div>

@if(!$user->usr_photo)

<div class="card profile-card shadow-sm border-0 mb-4">

    <div class="row g-0">

        <div class="col-lg-7">

            <div class="card-body p-4 h-100 d-flex flex-column justify-content-center">

                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3">
                    👋 Selamat Datang
                </span>

                <h3 class="fw-bold mb-3">
                    Lengkapi Foto Profil
                </h3>

                <p class="text-muted mb-4">

                    Tambahkan foto profil Anda sebagai salah satu
                    syarat pendaftaran PKL agar akun lebih profesional
                    dan mudah dikenali.

                </p>

                <div>

                    <a href="/teacher/profile"
                       class="btn btn-primary rounded-pill px-4">

                        Upload Foto

                    </a>

                </div>

            </div>

        </div>

        <div class="col-lg-5">

            <div class="profile-animation">

                <lottie-player
                src="{{ asset('assets/lottie/Sleeping.json') }}"
                background="transparent"
                speed="1"
                style="width:280px;height:280px"
                loop
                autoplay>
                </lottie-player>


            </div>

        </div>

    </div>

</div>

@endif
@if($user->usr_photo)

<div class="card profile-card shadow-sm border-0 mb-4">

    <div class="row g-0">

        <div class="col-lg-7">

            <div class="card-body p-4 h-100 d-flex flex-column justify-content-center">

                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3">
                    🎉 Selamat
                </span>

                <h3 class="fw-bold mb-3">

                    Foto Profil Berhasil Ditambahkan

                </h3>

                <p class="text-muted mb-4">

                    Terima kasih telah melengkapi foto profil.
                    Sekarang silakan melengkapi biodata,
                    pengalaman terbaik,
                    dan dokumen pendukung agar proses
                    pendaftaran berjalan lancar.

                </p>

                <div>
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

                    <a href="{{ $url }}"
                       class="btn btn-primary rounded-pill px-4">

                        Lengkapi Biodata

                    </a>

                </div>

            </div>

        </div>

        <div class="col-lg-5">

            <div class="profile-animation success-bg">

                <lottie-player
                src="{{ asset('assets/lottie/Mail Box.json') }}"
                {{-- src="https://assets10.lottiefiles.com/packages/lf20_jbrw3hcz.json" --}}
                background="transparent"
                speed="1"
                style="width:280px;height:280px"
                loop
                autoplay>
            </lottie-player>

            </div>

        </div>

    </div>

</div>

@endif

<div class="card border-0 shadow-sm mb-4">

    <div class="card-body p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-2">
                    📑 Persyaratan
                </span>

                <h4 class="fw-bold mb-1">
                    Persyaratan Pendaftaran
                </h4>

                <p class="text-muted mb-0">
                    Lengkapi seluruh dokumen agar proses pendaftaran dapat diproses.
                </p>

            </div>

            <div class="text-end">

                <h2 class="fw-bold text-primary mb-0">
                    {{ $completed }}/{{ $totalRequirement }}
                </h2>

                <small class="text-muted">
                    Persyaratan
                </small>

            </div>

        </div>

        @php
            $percent = $totalRequirement == 0
                ? 0
                : round(($completed / $totalRequirement) * 100);
        @endphp

        <div class="progress mb-3" style="height:12px; border-radius:30px;">

            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                 style="width: {{ $percent }}%">

            </div>

        </div>

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <span class="fw-semibold">
                    Progress {{ $percent }}%
                </span>

                <br>

                <small class="text-muted">

                    {{ $completed }}
                    dari
                    {{ $totalRequirement }}
                    persyaratan telah diisi.

                </small>

            </div>

            <a href="{{ route('teacher.teacherRequirement.create') }}"
               class="btn btn-primary rounded-pill px-4">

                <i class="ti ti-arrow-right me-1"></i>

                {{ $completed == $totalRequirement
                    ? 'Lihat Persyaratan'
                    : 'Lanjut Lengkapi'
                }}

            </a>

        </div>

    </div>

</div>


@endsection

@push('script')
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  
@endpush
