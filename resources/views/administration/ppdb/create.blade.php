@extends('administration.master')

@push('link')
@endpush

@section('title')
    SiMaput | Kelas
@endsection

@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">PPDB</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="/administration/ppdb">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Daftar PPDB</li>
                            <li class="breadcrumb-item" aria-current="page">Tambah PPDB</li>


                        </ol>
                    </nav>
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{asset('assets/images/breadcrumb/ChatBc.png')}}" alt="modernize-img" class="img-fluid mb-n4" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="px-4 py-3 border-bottom">
                    <h4 class="card-title mb-0">Tambah PPDB</h4>
                </div>
                <form action="" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="mb-4 row align-items-center">
                            <label for="exampleInputText1" class="form-label col-sm-3 col-form-label">Tahun Ajaran</label>
                            <div class="col-sm-9">
                                <select class="form-select mr-sm-2"  name="ppd_academic_id"
                                    oninvalid="this.setCustomValidity('Jurusan wajib diisi')"
                                    onchange="this.setCustomValidity('')" required>
                                    <option selected value="">Pilih...</option>
                                    @foreach ($academic as $acy)
                                        <option value="{{ $acy->acy_id }}">{{ $acy->academic_year }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('cls_acy_id')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4 row align-items-center">
                            <label for="exampleInputText2" class="form-label col-sm-3 col-form-label">Tanggal Mulai</label>
                            <div class="col-sm-9">
                                <input type="date" name="ppd_start_date" class="form-control" id="exampleInputText2"
                                    placeholder="" required oninvalid="this.setCustomValidity('Singkatan Wajib Diisi')"
                                    onchange="this.setCustomValidity('')">
                            </div>
                            @error('mjr_prefix')
                                <div>error</div>
                            @enderror
                        </div>
                        <div class="mb-4 row align-items-center">
                            <label for="exampleInputText2" class="form-label col-sm-3 col-form-label">Tanggal Berakhir</label>
                            <div class="col-sm-9">
                                <input type="date" name="ppd_end_date" class="form-control" id="exampleInputText2"
                                    placeholder="" required oninvalid="this.setCustomValidity('Singkatan Wajib Diisi')"
                                    onchange="this.setCustomValidity('')">
                            </div>
                            @error('mjr_prefix')
                                <div>error</div>
                            @enderror
                        </div>
                        <div class="mb-4 row align-items-center">
                            <label for="exampleInputText2" class="form-label col-sm-3 col-form-label">Biaya Awal</label>
                            <div class="col-sm-9">
                                <input type="text" name="ppd_entry_fee" class="form-control" id="ppd_entry_fee"
                                    placeholder="" required oninvalid="this.setCustomValidity('Singkatan Wajib Diisi')"
                                    onchange="this.setCustomValidity('')">
                            </div>
                            @error('mjr_prefix')
                                <div>error</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <input type="submit" class="btn btn-primary" value="Kirim" id="">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection



@push('script')
<script>
    const input = document.getElementById('ppd_entry_fee');
    
    input.addEventListener('keyup', function(e) {
        let value = this.value.replace(/[^0-9]/g, '');
    
        if(value){
            this.value = 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
        }else{
            this.value = '';
        }
    });
    
    document.querySelector("form").addEventListener("submit", function(){
        input.value = input.value.replace(/[^0-9]/g, '');
    });
    </script>
@endpush
