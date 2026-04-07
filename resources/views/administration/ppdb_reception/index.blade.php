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
                    <table id="file_export" class="table w-100 table-striped table-bordered display text-nowrap">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($participants as $no => $participant)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $participant->student->user->usr_name ?? '-' }}</td>
                                    <td>{{ $participant->major->mjr_name ?? '-' }}</td>
                                    <td>
                                        @if ($participant->ppsu_status == 1)
                                            <span class="badge bg-success">Diterima</span>
                                        @elseif ($participant->ppsu_status == 2)
                                            <span class="badge bg-danger">Ditolak</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="/administration/ppdb-participant/{{ $participant->ppsu_id }}/show"
                                                class="btn btn-info btn-sm">Detail</a>

                                            <form action="/administration/ppdb-participant/{{ $participant->ppsu_id }}/accept"
                                                method="POST"
                                                onsubmit="return confirm('Terima peserta ini?')">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success btn-sm">Terima</button>
                                            </form>

                                            <form action="/administration/ppdb-participant/{{ $participant->ppsu_id }}/reject"
                                                method="POST"
                                                onsubmit="return confirm('Tolak peserta ini?')">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Tidak ada calon peserta didik</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Status</th>
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

            $('#file_export tbody').html(`
                <tr>
                    <td colspan="5" class="text-center py-4">
                        <div class="spinner-border spinner-border-sm text-primary me-2"></div>
                        Memuat data...
                    </td>
                </tr>
            `);

            $.ajax({
                url: '/administration/ppdb-participant/' + ppdbId + '/list',
                method: 'GET',
                success: function(data) {
                    let rows = '';

                    if (data.length === 0) {
                        rows = `<tr><td colspan="5" class="text-center text-muted">Tidak ada calon peserta didik</td></tr>`;
                    } else {
                        data.forEach(function(item, index) {
                            let badge = '';
                            if (item.status == 1) badge = `<span class="badge bg-success">Diterima</span>`;
                            else if (item.status == 2) badge = `<span class="badge bg-danger">Ditolak</span>`;
                            else badge = `<span class="badge bg-warning text-dark">Pending</span>`;

                            rows += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${item.name}</td>
                                    <td>${item.major}</td>
                                    <td>${badge}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="/administration/ppdb-participant/${item.id}/show"
                                                class="btn btn-info btn-sm">Detail</a>
                                            <button class="btn btn-success btn-sm"
                                                onclick="updateStatus(${item.id}, 'accept')">Terima</button>
                                            <button class="btn btn-danger btn-sm"
                                                onclick="updateStatus(${item.id}, 'reject')">Tolak</button>
                                        </div>
                                    </td>
                                </tr>
                            `;
                        });
                    }

                    $('#file_export tbody').html(rows);
                },
                error: function() {
                    $('#file_export tbody').html(`
                        <tr>
                            <td colspan="5" class="text-center text-danger">Gagal memuat data.</td>
                        </tr>
                    `);
                }
            });
        });

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
                success: function() {
                    $('#ppdbSelect').trigger('change');
                },
                error: function() {
                    alert('Gagal memperbarui status.');
                }
            });
        }
    </script>
@endpush