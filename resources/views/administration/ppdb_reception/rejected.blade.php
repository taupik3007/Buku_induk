@extends('administration.master')

@push('link')
    <link rel="stylesheet" href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
@endpush

@section('title')
    SIMaput | Calon Peserta Didik PPDB
@endsection

@section('content')
    <div class="datatables">
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Calon Peserta Didik PPDB</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item" aria-current="page">Daftar Calon Peserta Didik</li>
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
                    <h4 class="card-title mb-0">Daftar Calon Peserta Didik</h4>

                    <div class="d-flex align-items-center gap-2">
                        <select id="ppdbSelect" class="form-select" style="min-width: 200px;">
                            @foreach ($ppdbList as $item)
                                <option value="{{ $item->ppd_id }}"
                                    {{ $ppdb && $ppdb->ppd_id == $item->ppd_id ? 'selected' : '' }}>
                                    {{ $item->ppd_name ?? ($item->ppd_year ?? 'PPDB ' . $item->ppd_id) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="table-responsive">
                    {{-- tbody dikosongkan, semua data diisi via JS --}}
                    <table id="file_export" class="table w-100 table-striped table-bordered display text-nowrap">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                {{-- <th>Status</th> --}}
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                {{-- <th>Status</th> --}}
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    {{-- HAPUS datatable-advanced.init.js karena bentrok --}}

    <script>
        let table;

        $(document).ready(function () {
            table = $('#file_export').DataTable({
                columnDefs: [{ orderable: false, targets: -1 }],
                language: {
                    emptyTable: "Tidak ada calon peserta didik",
                    zeroRecords: "Tidak ada data yang cocok",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data",
                    search: "Cari:",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                }
            });

            // Load data awal sesuai PPDB yang terpilih
            loadParticipants($('#ppdbSelect').val());
        });

        $('#ppdbSelect').on('change', function () {
            loadParticipants($(this).val());
        });

        function loadParticipants(ppdbId) {
            table.clear().draw();

            // Tampilkan loading
            $('#file_export tbody').html(`
                <tr class="dt-loading">
                    <td colspan="5" class="text-center py-4">
                        <div class="spinner-border spinner-border-sm text-primary me-2"></div>
                        Memuat data...
                    </td>
                </tr>
            `);

            $.ajax({
                url: '/administration/ppdb-reception/' + ppdbId + '/rejected-list',
                method: 'GET',
                success: function (data) {
                    table.clear();

                    data.forEach(function (item, index) {
                        let badge = '';
                        if (item.status == 1) badge = `<span class="badge bg-success">Diterima</span>`;
                        else if (item.status == 2) badge = `<span class="badge bg-danger">Ditolak</span>`;
                        else badge = `<span class="badge bg-warning text-dark">Pending</span>`;

                        const aksi = `
                            <div class="d-flex gap-1">
                                <a href="/administration/ppdb-reception/${item.id}/show"
                                    class="btn btn-info btn-sm">Detail</a>
                                
                            </div>
                        `;

                        table.row.add([index + 1, item.name, item.major, aksi]);
                    });

                    table.draw();
                },
                error: function () {
                    table.clear().draw();
                    $('#file_export tbody').html(`
                        <tr>
                            <td colspan="5" class="text-center text-danger">Gagal memuat data.</td>
                        </tr>
                    `);
                }
            });
        }

        function updateStatus(id, action) {
            const label = action === 'accept' ? 'menerima' : 'menolak';
            if (!confirm(`Yakin ingin ${label} peserta ini?`)) return;

            $.ajax({
                url: `/administration/ppdb-participant/${id}/${action}`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'PATCH'
                },
                success: function () {
                    loadParticipants($('#ppdbSelect').val());
                },
                error: function () {
                    alert('Gagal memperbarui status.');
                }
            });
        }
    </script>
@endpush