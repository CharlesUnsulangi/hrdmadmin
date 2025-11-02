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
                        <option value="{{ $pelamar->tr_hr_pelamar_main_id }}">{{ $pelamar->nama }} ({{ $pelamar->posisi ?? '-' }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="skedul_pelamar_time" class="form-label">Tanggal & Jam Interview</label>
            <input type="datetime-local" name="skedul_pelamar_time" id="skedul_pelamar_time" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan Jadwal</button>
        <a href="{{ route('interview') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
