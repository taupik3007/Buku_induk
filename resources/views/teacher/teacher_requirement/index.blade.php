@extends('teacher.master')

@section('title')
SIMaput | Persyaratan Guru
@endsection

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h3 class="fw-bold mb-1">
                        Persyaratan Pendaftaran
                    </h3>

                    <p class="text-muted mb-0">
                        Lengkapi seluruh persyaratan sebelum mengirim lamaran.
                    </p>

                </div>

                <div class="text-end">

                    <h4 class="fw-bold text-primary mb-0">
                        {{ $completed }} / {{ $totalRequirement }}
                    </h4>

                    <small class="text-muted">
                        Persyaratan Selesai
                    </small>

                </div>

            </div>

            <div class="progress mt-4" style="height:12px">

                <div
                    class="progress-bar bg-success"
                    role="progressbar"
                    style="width:{{ $percent }}%">
                </div>

            </div>

            <small class="text-muted">
                Progress {{ $percent }}%
            </small>

        </div>

    </div>


    <div class="row justify-content-center">

        <div class="col-lg-5">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center p-2">

                    <i class="ti ti-file-check text-primary"
                       style="font-size:70px;"></i>

                    <h3 class="fw-bold mt-3">

                        Persyaratan Guru

                    </h3>

                    <p class="text-muted">

                        Silakan lengkapi seluruh persyaratan yang dibutuhkan
                        sebelum mengirimkan pendaftaran.

                    </p>

                    <div class="my-4">

                        <h2 class="fw-bold text-primary">

                            {{ $completed }}

                            /

                            {{ $totalRequirement }}

                        </h2>

                        <small class="text-muted">

                            Persyaratan Selesai

                        </small>

                    </div>

                    <div class="progress mb-4"
                         style="height:12px;">

                        <div
                            class="progress-bar bg-success"
                            style="width:{{ $percent }}%">
                        </div>

                    </div>

                    <a
                        href="{{ route('teacher.teacherRequirement.create') }}"
                        class="btn btn-primary btn-lg w-100">

                        <i class="ti ti-upload me-2"></i>

                        Lengkapi Persyaratan

                    </a>

                </div>

            </div>

        </div>

    </div>


    @if($completed == $totalRequirement && $totalRequirement > 0)

        <div class="card border-success shadow-sm mt-4">

            <div class="card-body text-center">

                <h3 class="text-success">

                    🎉 Seluruh persyaratan telah lengkap

                </h3>

                <p class="text-muted">

                    Anda sudah dapat mengirim pendaftaran.

                </p>

                <a
                    href="#"
                    class="btn btn-success btn-lg">

                    <i class="ti ti-send me-2"></i>

                    Kirim Pendaftaran

                </a>

            </div>

        </div>

    @endif

</div>

@endsection