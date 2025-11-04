@extends('layouts.app')

@section('content')
<div class="container">
    @if(isset($employee) && $employee)
    <div class="alert alert-info">
        <strong>Data Employee:</strong><br>
        No. Kontrak: <b>{{ $employee->emp_nokontrak ?? '-' }}</b><br>
        Exp. Kontrak: <b>{{ $employee->emp_expdatekontrak ?? '-' }}</b><br>
        Tanggal Kontrak: <b>{{ $employee->emp_datejoin ?? '-' }}</b>
    </div>
    @endif
    <h2>Buat PKWTT Baru</h2>
    <form action="{{ route('pkwtt.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="no_kontrak" class="form-label">No. Kontrak</label>
            <input type="text" class="form-control" id="no_kontrak" name="no_kontrak" value="{{ old('no_kontrak', isset($employee) && $employee ? $employee->emp_nokontrak : '') }}">
        </div>
        <div class="mb-3">
            <label for="ms_emp_id" class="form-label">ID Karyawan/Kandidat</label>
            <input type="text" class="form-control" id="ms_emp_id" name="ms_emp_id" value="{{ old('ms_emp_id', $ms_emp_id ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label for="date_pkwtt_start" class="form-label">Tanggal Mulai PKWTT</label>
            <input type="date" class="form-control" id="date_pkwtt_start" name="date_pkwtt_start" value="{{ old('date_pkwtt_start', date('Y-m-d')) }}" required>
        </div>
        <div class="mb-3">
            <label for="date_pkwtt_end" class="form-label">Tanggal Akhir PKWTT</label>
            <input type="date" class="form-control" id="date_pkwtt_end" name="date_pkwtt_end" value="{{ old('date_pkwtt_end', date('Y-m-d', strtotime('+1 year'))) }}" required>
        </div>
        <div class="mb-3">
            <label for="date_sign" class="form-label">Tanggal Tanda Tangan</label>
            <input type="date" class="form-control" id="date_sign" name="date_sign" value="{{ old('date_sign', date('Y-m-d')) }}" required>
        </div>
        <div class="mb-3">
            <label for="month" class="form-label">Durasi (bulan)</label>
            <input type="number" class="form-control" id="month" name="month" value="{{ old('month', 12) }}" min="1" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan PKWTT</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
