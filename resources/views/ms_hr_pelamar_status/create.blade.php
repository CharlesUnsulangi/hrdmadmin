@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h1 class="mb-4">Tambah Status Pelamar</h1>
    <form action="{{ route('ms_hr_pelamar_status.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="ms_hr_pelamar_status_id" class="form-label">ID Status</label>
            <input type="text" name="ms_hr_pelamar_status_id" id="ms_hr_pelamar_status_id" class="form-control" required maxlength="50" value="{{ old('ms_hr_pelamar_status_id') }}">
        </div>
        <div class="mb-3">
            <label for="status_desc" class="form-label">Deskripsi</label>
            <input type="text" name="status_desc" id="status_desc" class="form-control" maxlength="50" value="{{ old('status_desc') }}">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('ms_hr_pelamar_status.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
