@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Edit Data Employee (Kontrak)</h2>
    <div class="mb-4">
        <strong>ID:</strong> {{ $karyawan->emp_id }}<br>
        <strong>Nama:</strong> {{ $karyawan->emp_name }}<br>
        <strong>Divisi:</strong> {{ $karyawan->emp_iddivision }}<br>
        <strong>Status:</strong> {{ $karyawan->emp_status }}<br>
        <strong>Absen Terakhir:</strong> {{ $karyawan->emp_lastabsen }}<br>
        <strong>Tanggal Gaji Terakhir:</strong> {{ $karyawan->emp_last_salary_date }}
    </div>
    <form method="POST" action="{{ url('/employee/' . $karyawan->emp_id . '/kontrak') }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="emp_datejoin" class="form-label">Tanggal Masuk</label>
            <input type="date" class="form-control" id="emp_datejoin" name="emp_datejoin" value="{{ $karyawan->emp_datejoin }}">
        </div>
        <div class="mb-3">
            <label for="emp_dateresign" class="form-label">Tanggal Resign</label>
            <input type="date" class="form-control" id="emp_dateresign" name="emp_dateresign" value="{{ $karyawan->emp_dateresign }}">
        </div>
        <div class="mb-3">
            <label for="emp_nokontrak" class="form-label">Nomor Kontrak</label>
            <input type="text" class="form-control" id="emp_nokontrak" name="emp_nokontrak" value="{{ $karyawan->emp_nokontrak }}">
        </div>
        <div class="mb-3">
            <label for="emp_expdatekontrak" class="form-label">Exp. Kontrak</label>
            <input type="date" class="form-control" id="emp_expdatekontrak" name="emp_expdatekontrak" value="{{ $karyawan->emp_expdatekontrak }}">
        </div>
        <div class="mb-3">
            <label for="emp_numkontrak" class="form-label">Jumlah Kontrak</label>
            <input type="number" class="form-control" id="emp_numkontrak" name="emp_numkontrak" value="{{ $karyawan->emp_numkontrak }}">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
