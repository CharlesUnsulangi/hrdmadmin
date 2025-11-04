@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Daftar Karyawan</h2>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="karyawanTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="daftar-tab" data-bs-toggle="tab" data-bs-target="#daftar" type="button" role="tab" aria-controls="daftar" aria-selected="true">Daftar Karyawan</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="dmin-tab" data-bs-toggle="tab" data-bs-target="#dmin" type="button" role="tab" aria-controls="dmin" aria-selected="false">Data DMIN</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="kontrak-tab" data-bs-toggle="tab" data-bs-target="#kontrak" type="button" role="tab" aria-controls="kontrak" aria-selected="false">Kontrak</button>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content mt-3">
        <div class="tab-pane fade" id="kontrak" role="tabpanel" aria-labelledby="kontrak-tab">
            <!-- DataTables CSS -->
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
            <!-- DataTables JS -->
            <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
            <table id="tabel-kontrak" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Resign</th>
                        <th>Nomor Kontrak</th>
                        <th>Exp. Kontrak</th>
                        <th>Jumlah Kontrak</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($karyawans as $karyawan)
                    <tr ondblclick="window.location.href='{{ url('/karyawan/' . $karyawan->emp_id . '/edit') }}'" style="cursor:pointer;">
                        <td>{{ $karyawan->emp_id }}</td>
                        <td>{{ $karyawan->emp_name }}</td>
                        <td>{{ $karyawan->emp_datejoin }}</td>
                        <td>{{ $karyawan->emp_dateresign }}</td>
                        <td>{{ $karyawan->emp_nokontrak }}</td>
                        <td>{{ $karyawan->emp_expdatekontrak }}</td>
                        <td>{{ $karyawan->emp_numkontrak }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $karyawans->links() }}
            </div>
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Inisialisasi DataTables hanya pada tab Kontrak
                $('#tabel-kontrak').DataTable({
                    paging: false,
                    info: false,
                    searching: false,
                    order: [[4, 'asc']], // default sort by Exp. Kontrak
                });
            });
            </script>
        </div>
        <div class="tab-pane fade show active" id="daftar" role="tabpanel" aria-labelledby="daftar-tab">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Divisi</th>
                        <th>Tanggal Masuk</th>
                        <th>Kontrak Terakhir</th>
                        <th>Absen Terakhir</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($karyawans as $karyawan)
                    <tr>
                        <td>{{ $karyawan->emp_id }}</td>
                        <td>{{ $karyawan->emp_name }}</td>
                        <td>{{ $karyawan->emp_iddivision }}</td>
                        <td>{{ $karyawan->emp_datejoin }}</td>
                        <td>{{ $karyawan->emp_lastcontract }}</td>
                        <td>{{ $karyawan->emp_lastabsen }}</td>
                        <td>{{ $karyawan->emp_status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $karyawans->links() }}
            </div>
        </div>
        <div class="tab-pane fade" id="dmin" role="tabpanel" aria-labelledby="dmin-tab">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>NPWP</th>
                        <th>Card ID</th>
                        <th>Jamsostek</th>
                        <th>Bank</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($karyawans as $karyawan)
                    <tr>
                        <td>{{ $karyawan->emp_id }}</td>
                        <td>{{ $karyawan->emp_email }}</td>
                        <td>{{ $karyawan->emp_npwp }}</td>
                        <td>{{ $karyawan->card_id }}</td>
                        <td>{{ $karyawan->emp_jamsostek }}</td>
                        <td>{{ $karyawan->emp_bank }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $karyawans->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
