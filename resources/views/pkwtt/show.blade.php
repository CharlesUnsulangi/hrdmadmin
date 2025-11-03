@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail PKWTT</h2>
    <table class="table table-bordered">
        <tr><th>ID PKWTT</th><td>{{ $pkwtt->tr_hd_pkwtt_id }}</td></tr>
        <tr><th>ID Karyawan/Kandidat</th><td>{{ $pkwtt->ms_emp_id }}</td></tr>
        <tr><th>Nama</th><td>{{ $employee ? $employee->emp_name : ($kandidat ? $kandidat->ms_hr_kandidat_emp_id : '-') }}</td></tr>
        <tr><th>Tanggal Mulai</th><td>{{ $pkwtt->date_pkwtt_start }}</td></tr>
        <tr><th>Tanggal Akhir</th><td>{{ $pkwtt->date_pkwtt_end }}</td></tr>
        <tr><th>Tanggal Tanda Tangan</th><td>{{ $pkwtt->date_sign }}</td></tr>
        <tr><th>Durasi (bulan)</th><td>{{ $pkwtt->month }}</td></tr>
        <tr><th>Status Tanda Tangan</th><td><span class="badge bg-warning">Menunggu</span></td></tr>
    </table>
    <a href="{{ route('pkwtt.edit', $pkwtt->tr_hd_pkwtt_id) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('pkwtt.destroy', $pkwtt->tr_hd_pkwtt_id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin hapus PKWTT ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Hapus</button>
    </form>
    <a href="{{ route('pkwtt.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
