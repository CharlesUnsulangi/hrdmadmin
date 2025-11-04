@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Edit Data Karyawan (Daftar Karyawan)</h2>
    <div class="mb-4">
        <strong>ID:</strong> {{ $karyawan->emp_id }}<br>
        <strong>Nama:</strong> {{ $karyawan->emp_name }}<br>
        <strong>Divisi:</strong> {{ $karyawan->emp_iddivision }}<br>
        <strong>Status:</strong> {{ $karyawan->emp_status }}
    </div>
    <form method="POST" action="{{ url('/karyawan/' . $karyawan->emp_id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="emp_name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="emp_name" name="emp_name" value="{{ $karyawan->emp_name }}">
        </div>
        <div class="mb-3">
            <label for="emp_iddivision" class="form-label">Divisi</label>
            <input type="text" class="form-control" id="emp_iddivision" name="emp_iddivision" value="{{ $karyawan->emp_iddivision }}">
        </div>
        <div class="mb-3">
            <label for="emp_status" class="form-label">Status</label>
            <input type="text" class="form-control" id="emp_status" name="emp_status" value="{{ $karyawan->emp_status }}">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
