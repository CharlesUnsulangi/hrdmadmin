@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit PKWTT</h2>
    <form action="{{ route('pkwtt.update', $pkwtt->tr_hd_pkwtt_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="date_pkwtt_start" class="form-label">Tanggal Mulai PKWTT</label>
            <input type="date" class="form-control" id="date_pkwtt_start" name="date_pkwtt_start" value="{{ old('date_pkwtt_start', $pkwtt->date_pkwtt_start) }}" required>
        </div>
        <div class="mb-3">
            <label for="date_pkwtt_end" class="form-label">Tanggal Akhir PKWTT</label>
            <input type="date" class="form-control" id="date_pkwtt_end" name="date_pkwtt_end" value="{{ old('date_pkwtt_end', $pkwtt->date_pkwtt_end) }}" required>
        </div>
        <div class="mb-3">
            <label for="date_sign" class="form-label">Tanggal Tanda Tangan</label>
            <input type="date" class="form-control" id="date_sign" name="date_sign" value="{{ old('date_sign', $pkwtt->date_sign) }}" required>
        </div>
        <div class="mb-3">
            <label for="month" class="form-label">Durasi (bulan)</label>
            <input type="number" class="form-control" id="month" name="month" value="{{ old('month', $pkwtt->month) }}" min="1" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('pkwtt.show', $pkwtt->tr_hd_pkwtt_id) }}" class="btn btn-secondary">Batal</a>
    </form>
    <form action="{{ route('pkwtt.promote', $pkwtt->tr_hd_pkwtt_id) }}" method="POST" class="mt-3">
        @csrf
        <button type="submit" class="btn btn-success" onclick="return confirm('Jadikan karyawan permanen?')">Jadikan Karyawan</button>
    </form>
</div>
@endsection
