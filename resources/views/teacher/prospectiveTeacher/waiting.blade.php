@extends('teacher.master')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card border-0 shadow-lg">

                <div class="card-body text-center p-5">

                    <div style="font-size:70px">
                        ⏳
                    </div>

                    <h2 class="fw-bold mt-3">
                        Lamaran Berhasil Dikirim
                    </h2>

                    <p class="text-muted mt-3">

                        Terima kasih telah melakukan pendaftaran sebagai
                        <strong>Calon Guru.</strong>

                        <br><br>

                        Data Anda sedang diperiksa oleh Tim Administrasi.

                    </p>

                    <div class="alert alert-warning mt-4">

                        <strong>Status :</strong>

                        <span class="badge bg-warning text-dark">

                            Menunggu Verifikasi

                        </span>

                    </div>

                    <div class="d-grid gap-3 mt-4">

                        {{-- <a href="{{ route('teacher.application') }}" --}}
                        <a href="{{ route('teacher.prospectiveTeacher.preview') }}" class="btn btn-primary">
                            <i class="ti ti-file-text"></i>
                             Lihat Data Lamaran
                            </a>

                        {{-- <a href="{{ route('teacher.prospectiveTeacher.edit') }}" --}}
                        @if($biodata->tcb_status == 'pending')
                            <a href="{{ route('teacher.prospectiveTeacher.biodata') }}"
                            class="btn btn-warning">
                                Perbaiki Data
                            </a>
                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection