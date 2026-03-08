@extends('administration.master')

@push('link')
    <link rel="stylesheet" href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
@endpush

@section('title')
    SIMaput | Persyaratan PPDB
@endsection

@section('content')
    <div class="datatables">
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Persayratan PPDB</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item" aria-current="page">Daftar Persyaratan PPDB</li>

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
        <div class="card">
            <div class="card-body">
                <div class="mb-5 position-relative d-flex align-items-center justify-content-between">
                    <h4 class="card-title mb-0">Daftar Persyaratan</h4>

                    <div class="d-flex align-items-center gap-2">
                        {{-- Dropdown pilih tahun ajaran --}}
                        <select id="ppdbSelect" class="form-select" style="min-width: 200px;">
                            @foreach ($ppdbList as $item)
                                <option value="{{ $item->ppd_id }}"
                                    {{ $ppdb && $ppdb->ppd_id == $item->ppd_id ? 'selected' : '' }}>
                                    {{ $item->ppd_name ?? ($item->ppd_year ?? 'PPDB ' . $item->ppd_id) }}
                                </option>
                            @endforeach
                        </select>

                        <a href="/administration/ppdb-requirement/create/{{ $ppdb->ppd_id }}" class="btn btn-primary">Tambah
                        </a>
                    </div>
                </div>
                <p class="card-subtitle mb-3">

                </p>
                <div class="table-responsive">
                    <table id="file_export" class="table w-100 table-striped table-bordered display text-nowrap">
                        <thead>
                            <!-- start row -->
                            <tr>
                                <th width="10%">No</th>
                                <th>Nama Persyaratan</th>
                                <th>Jenis Inputan</th>
                                <th>Aksi</th>

                            </tr>
                            <!-- end row -->
                        </thead>
                        <tbody>
                            <!-- start row -->
                            @foreach ($requirements as $no => $requirements)
                                <tr>

                                    <td>{{ $no + 1 }}</td>

                                    <td>{{ $requirements->pdr_name }}</td>
                                    <td>{{ $requirements->pdr_type }}</td>


                                    <td>
                                        <form action="/administration/ppdb-requirement/{{ $requirements->pdr_id }}/destroy" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus persyaratan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>



                                </tr>
                            @endforeach
                            <!-- end row -->

                        </tbody>
                        <tfoot>
                            <!-- start row -->


                            <tr>
                                <th width="10%">No</th>
                                <th>Nama Persyaratan</th>
                                <th>Jenis Inputan</th>
                                <th>Aksi</th>
                            </tr>
                            <!-- end row -->
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('script')
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <script src="{{ asset('assets/js/datatable/datatable-advanced.init.js') }}"></script>
    <script>
        $('#ppdbSelect').on('change', function() {
            const ppdbId = $(this).val();

            // Loading state
            $('#file_export tbody').html(`
        <tr>
            <td colspan="4" class="text-center py-4">
                <div class="spinner-border spinner-border-sm text-primary me-2"></div>
                Memuat data...
            </td>
        </tr>
    `);

            $.ajax({
                url: '/administration/ppdb-requirement/' + ppdbId + '/list',
                method: 'GET',
                success: function(data) {
                    let rows = '';

                    if (data.length === 0) {
                        rows =
                            `<tr><td colspan="4" class="text-center text-muted">Tidak ada persyaratan</td></tr>`;
                    } else {
                        data.forEach(function(item, index) {
                            rows += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.pdr_name}</td>
                            <td>${item.pdr_type}</td>
                            <td></td>
                        </tr>
                    `;
                        });
                    }

                    $('#file_export tbody').html(rows);
                },
                error: function() {
                    $('#file_export tbody').html(`
                <tr>
                    <td colspan="4" class="text-center text-danger">Gagal memuat data.</td>
                </tr>
            `);
                }
            });
        });
    </script>
@endpush
