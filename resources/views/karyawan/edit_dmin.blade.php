@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Edit Data Karyawan (Data DMIN)</h2>
    <div class="mb-4">
        <strong>ID:</strong> {{ $karyawan->emp_id }}<br>
        <strong>Nama:</strong> {{ $karyawan->emp_name }}<br>
        <strong>Divisi:</strong> {{ $karyawan->emp_iddivision }}<br>
        <strong>Status:</strong> {{ $karyawan->emp_status }}
    </div>
    <form method="POST" action="{{ url('/karyawan/' . $karyawan->emp_id . '/dmin') }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="emp_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="emp_email" name="emp_email" value="{{ $karyawan->emp_email }}">
        </div>
        <div class="mb-3">
            <label for="emp_npwp" class="form-label">NPWP</label>
            <input type="text" class="form-control" id="emp_npwp" name="emp_npwp" value="{{ $karyawan->emp_npwp }}">
        </div>
        <div class="mb-3">
            <label for="card_id" class="form-label">Card ID</label>
            <input type="text" class="form-control" id="card_id" name="card_id" value="{{ $karyawan->card_id }}">
        </div>
        <div class="mb-3">
            <label for="emp_jamsostek" class="form-label">Jamsostek</label>
            <input type="text" class="form-control" id="emp_jamsostek" name="emp_jamsostek" value="{{ $karyawan->emp_jamsostek }}">
        </div>
        <div class="mb-3">
            <label for="emp_bank" class="form-label">Bank</label>
            <input type="text" class="form-control" id="emp_bank" name="emp_bank" value="{{ $karyawan->emp_bank }}">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
