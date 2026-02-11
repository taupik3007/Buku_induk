@extends('student.master')

@push('link')
  <link rel="stylesheet" href="{{asset('assets/libs/owl.carousel/dist/assets/owl.carousel.min.css')}}" />
@endpush

@section('title')
    E-Laundry | Dashboard
@endsection

@section('content')
<div class="d-flex align-items-center gap-4 mb-4">
  <div class="position-relative">
    <div class="border border-2 border-primary rounded-circle">
      <img src="{{ asset('assets/images/profile/user-1.jpg')}}" class="rounded-circle m-1" alt="user1" width="60" />
    </div>
      <span class="visually-hidden">unread messages</span>
    </span>
  </div>
  <div>
    <h3 class="fw-semibold">Halooo</span></h3>
    <span>Terima kasih sudah menggunakan layanan laundry kami. Hemat waktu, biarkan kami yang bekerja untuk Anda✨
    </span>
  </div>
</div>


@endsection

@push('script')
  
@endpush
