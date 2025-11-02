@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Kandidat</h2>
    <form action="#" method="POST">
        @csrf
        <!-- Tambahkan field sesuai kebutuhan -->
        <div class="mb-3">
            <label for="ms_hr_kandidat_emp_id" class="form-label">ID Kandidat</label>
            <input type="text" class="form-control" id="ms_hr_kandidat_emp_id" name="ms_hr_kandidat_emp_id" value="{{ $kandidat->ms_hr_kandidat_emp_id }}" readonly>
        </div>
        <div class="mb-3">
            <label for="ms_status_id" class="form-label">Status</label>
            <input type="text" class="form-control" id="ms_status_id" name="ms_status_id" value="{{ $kandidat->ms_status_id }}">
        </div>
        <div class="mb-3">
            <label for="date_kandidat" class="form-label">Tanggal Kandidat</label>
            <input type="date" class="form-control" id="date_kandidat" name="date_kandidat" value="{{ $kandidat->date_kandidat }}">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('kandidat.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
