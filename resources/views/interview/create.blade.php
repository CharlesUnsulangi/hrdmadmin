@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2>Tambah Jadwal Interview</h2>
    <form action="{{ route('interview.store') }}" method="POST" class="mt-4">
        @csrf
        <div class="mb-3">
                <label for="tr_hr_pelamar_id" class="form-label">Pilih Pelamar</label>
                <select name="tr_hr_pelamar_id" id="tr_hr_pelamar_id" class="form-select" required>
        <option value="">-- Pilih Pelamar --</option>
        @foreach($pelamars as $pelamar)
            <option value="{{ $pelamar->tr_hr_pelamar_main_id }}" {{ (isset($selectedPelamarId) && $selectedPelamarId == $pelamar->tr_hr_pelamar_main_id) ? 'selected' : '' }}>{{ $pelamar->nama }} ({{ $pelamar->posisi ?? '-' }})</option>
        @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="skedul_pelamar_date" class="form-label">Tanggal Interview</label>
            <input type="date" name="skedul_pelamar_date" id="skedul_pelamar_date" class="form-control" required autocomplete="off">
        </div>
        <div class="mb-3">
            <label for="skedul_pelamar_time" class="form-label">Jam Interview</label>
            <input type="text" name="skedul_pelamar_time" id="skedul_pelamar_time" class="form-control" required autocomplete="off" placeholder="Pilih jam...">
        </div>
        <button type="submit" class="btn btn-success">Simpan Jadwal</button>
        <a href="{{ route('interview') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.css">
<!-- ClockPicker needs Bootstrap 3 CSS for proper analog style -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#skedul_pelamar_time').clockpicker({
            autoclose: true,
            placement: 'bottom',
            align: 'left',
            donetext: 'OK',
            twelvehour: false // 24 jam
        });
    });
</script>
@endpush
