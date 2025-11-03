@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Riwayat PKWTT</h2>
    <a href="{{ route('pkwtt.create') }}" class="btn btn-success mb-3">Buat PKWTT Baru</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID PKWTT</th>
                <th>ID Karyawan/Kandidat</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Akhir</th>
                <th>Tanggal Tanda Tangan</th>
                <th>Durasi (bulan)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($list as $pkwtt)
            <tr>
                <td>{{ $pkwtt->tr_hd_pkwtt_id }}</td>
                <td>{{ $pkwtt->ms_emp_id }}</td>
                <td>{{ $pkwtt->date_pkwtt_start }}</td>
                <td>{{ $pkwtt->date_pkwtt_end }}</td>
                <td>{{ $pkwtt->date_sign }}</td>
                <td>{{ $pkwtt->month }}</td>
                <td>
                    <!-- Aksi edit/hapus bisa ditambahkan di sini -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
