@extends('teacher.master')

@push('link')
<link rel="stylesheet" href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">

<style>

.requirement-card{
    position:relative;
    border-radius:18px;
    overflow:hidden;
    transition:.35s;
}

.requirement-card.saved{
    border:2px solid #22c55e;
    box-shadow:0 0 25px rgba(34,197,94,.25);
}

.loading-overlay{
    position:absolute;
    inset:0;
    background:rgba(255,255,255,.75);
    display:flex;
    justify-content:center;
    align-items:center;
    opacity:0;
    visibility:hidden;
    transition:.25s;
    z-index:99;
}

.loading-overlay.show{
    opacity:1;
    visibility:visible;
}

.preview-image{
    max-width:100%;
    border-radius:10px;
    border:1px solid #ddd;
}

.progress{
    height:12px;
    border-radius:30px;
}

.progress-bar{
    transition:.5s;
}

</style>
@endpush


@section('title')
SIMaput | Persyaratan Guru
@endsection


@section('content')

<div class="container-fluid">

<div class="card shadow border-0 mb-4">

<div class="card-body">

<div class="d-flex justify-content-between align-items-center">

<div>

<h3 class="fw-bold mb-1">
Persyaratan Pendaftaran
</h3>

<p class="text-muted mb-0">
Lengkapi seluruh persyaratan sebelum mengirim pendaftaran.
</p>

</div>

<div class="text-end">

<h3
id="completedText"
class="fw-bold text-primary">

{{ $completed }} /  {{ $totalRequirement }}

</h3>

<small class="text-muted">
Persyaratan Selesai
</small>

</div>

</div>

@php


$percent = $totalRequirement == 0
    ? 0
    : round(($completed / $totalRequirement) * 100);

@endphp

<div class="progress mt-4">

<div
id="progressBar"
class="progress-bar bg-success"
style="width:{{ $percent }}%">

</div>

</div>

<div
id="progressText"
class="small text-muted mt-2">

Progress {{ $percent }}%

</div>

</div>

</div>



<div class="row">
    @foreach($requirements as $requirement)

    @php
        $answer = $teacherRequirement[$requirement->tcq_id] ?? null;
    @endphp
    
    <div class="col-lg-6 mb-4">
    
    <div class="card requirement-card shadow border-0 h-100">
    
        <div class="loading-overlay">
            <div class="spinner-border text-primary"></div>
        </div>
    
        <div class="card-body">
    
            <div class="d-flex justify-content-between align-items-center mb-3">
    
                <div>
    
                    <h5 class="fw-bold mb-1">
                        {{ $requirement->tcq_name }}
                    </h5>
    
                    <small class="text-muted">
                        Jenis :
                        {{ ucfirst($requirement->tcq_type) }}
                    </small>
    
                </div>
    
                <span class="badgeStatus badge {{ $answer ? 'bg-success' : 'bg-warning text-dark' }}">
                    {{ $answer ? 'Sudah Diisi' : 'Belum Diisi' }}
                </span>
    
            </div>
    
            <hr>
    
            <form
                class="requirementForm"
                action="{{ route('teacher.teacherRequirement.store') }}"
                method="POST"
                enctype="multipart/form-data">
    
                @csrf
    
                <input
                    type="hidden"
                    name="tcq_id"
                    value="{{ $requirement->tcq_id }}">
    
                @if($requirement->tcq_type=='text')
    
                    <input
                        type="text"
                        name="value"
                        class="form-control"
                        value="{{ $answer->tsb_value ?? '' }}"
                        placeholder="Masukkan jawaban">
    
                @elseif($requirement->tcq_type=='number')
    
                    <input
                        type="number"
                        name="value"
                        class="form-control"
                        value="{{ $answer->tsb_value ?? '' }}">
    
                @elseif($requirement->tcq_type=='date')
    
                    <input
                        type="date"
                        name="value"
                        class="form-control"
                        value="{{ $answer->tsb_value ?? '' }}">
    
                @elseif($requirement->tcq_type=='file')
    
                    <input
                        type="file"
                        name="value"
                        class="form-control">
    
                @endif
    
    
                <div class="preview-wrapper mt-3">
    
                    @if($answer)
    
                        @php
                            $ext = strtolower(pathinfo($answer->tsb_value,PATHINFO_EXTENSION));
                        @endphp
    
                        @if(in_array($ext,['jpg','jpeg','png','webp']))
    
                            <img
                                src="{{ asset('storage/'.$answer->tsb_value) }}"
                                class="preview-image">
    
                        @elseif($ext=="pdf")
    
                            <a
                                href="{{ asset('storage/'.$answer->tsb_value) }}"
                                target="_blank"
                                class="btn btn-danger btn-sm">
    
                                <i class="ti ti-file-type-pdf"></i>
    
                                Lihat PDF
    
                            </a>
    
                        @else
    
                            <a
                                href="{{ asset('storage/'.$answer->tsb_value) }}"
                                target="_blank"
                                class="btn btn-primary btn-sm">
    
                                Download File
    
                            </a>
    
                        @endif
    
                    @endif
    
                </div>
    
                <div class="mt-4">
    
                    <button
                        type="submit"
                        class="btnSave btn btn-primary w-100">
    
                        <i class="ti ti-device-floppy"></i>
    
                        <span>
    
                            {{ $answer ? 'Update Persyaratan' : 'Simpan Persyaratan' }}
    
                        </span>
    
                    </button>
    
                </div>
    
            </form>
    
        </div>
    
    </div>
    
    </div>
    
    @endforeach
    
    </div>
    <!-- Toast -->
<div class="position-fixed top-0 end-0 p-3" style="z-index:9999">

    <div
    class="toast align-items-center text-bg-success border-0"
    id="toastSuccess">
    
    <div class="d-flex">
    
    <div class="toast-body">
    
    <i class="ti ti-circle-check me-2"></i>
    
    Persyaratan berhasil disimpan.
    
    </div>
    
    <button
    type="button"
    class="btn-close btn-close-white me-2 m-auto"
    data-bs-dismiss="toast">
    
    </button>
    
    </div>
    
    </div>
    
    </div>
    
    @endsection
    
    
    @push('script')
    
    <script>
    
    $(function(){
    
    $('.requirementForm').submit(function(e){
    
    e.preventDefault();
    
    let form=$(this);
    
    let card=form.closest('.requirement-card');
    
    let btn=form.find('.btnSave');
    
    let badge=card.find('.badgeStatus');
    
    let overlay=card.find('.loading-overlay');
    
    let formData=new FormData(this);
    
    overlay.addClass('show');
    
    btn.prop('disabled',true);
    
    $.ajax({
    
    url:form.attr('action'),
    
    type:"POST",
    
    data:formData,
    
    processData:false,
    
    contentType:false,
    
    headers:{
    'X-CSRF-TOKEN':
    $('meta[name="csrf-token"]').attr('content')
    },
    
    success:function(res){
    
    overlay.removeClass('show');
    
    btn.prop('disabled',false);
    
    card.addClass('saved');
    
    setTimeout(function(){
    
    card.removeClass('saved');
    
    },1500);
    
    badge
    .removeClass('bg-warning text-dark')
    .addClass('bg-success')
    .text('Sudah Diisi');
    
    $('#completedText').text(
    res.completed+' / '+res.total
    );
    
    let percent=Math.round(
    (res.completed/res.total)*100
    );
    
    $('#progressBar').css(
    'width',
    percent+'%'
    );
    
    $('#progressText').text(
    'Progress '+percent+'%'
    );
    
    bootstrap.Toast
    .getOrCreateInstance(
    document.getElementById('toastSuccess')
    )
    .show();
    
    btn
    .removeClass('btn-primary')
    .addClass('btn-success');
    
    btn.find('span')
    .text('Berhasil Disimpan');
    
    setTimeout(function(){
    
    btn
    .removeClass('btn-success')
    .addClass('btn-primary');
    
    btn.find('span')
    .text('Update Persyaratan');
    
    },1500);
    
    let input=form.find('input[type=file]')[0];
    
    if(input && input.files.length){
    
    let reader=new FileReader();
    
    reader.onload=function(ev){
    
    let img=card.find('.preview-image');
    
    if(img.length==0){
    
    card.find('.preview-wrapper').html(
    
    '<img class="preview-image img-fluid rounded border shadow-sm mt-2">'
    
    );
    
    img=card.find('.preview-image');
    
    }
    
    img.attr('src',ev.target.result);
    
    };
    
    reader.readAsDataURL(input.files[0]);
    
    }
    
    },
    
    error:function(xhr){
    
    overlay.removeClass('show');
    
    btn.prop('disabled',false);
    
    if(xhr.status==422){
    
    let err=Object.values(xhr.responseJSON.errors)[0][0];
    
    bootstrap.Toast.getOrCreateInstance(
    document.getElementById('toastSuccess')
    ).hide();
    
    alert(err);
    
    }else{
    
    alert('Terjadi kesalahan server.');
    
    }
    
    }
    
    });
    
    });
    
    });
    
    </script>
    
    @endpush