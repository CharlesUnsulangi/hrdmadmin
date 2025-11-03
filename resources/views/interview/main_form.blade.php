@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2>Form Interview</h2>
    <form action="{{ isset($interview) ? route('interview_main.update', $interview->tr_hr_pelamar_interview_main_id) : route('interview_main.store') }}" method="POST">
        @csrf
        @if(isset($interview))
            @method('PUT')
        @endif
        <div class="mb-3">
            <label for="tr_hr_pelamar_main_id" class="form-label">Pelamar</label>
            <input type="text" name="tr_hr_pelamar_main_id" id="tr_hr_pelamar_main_id" class="form-control" value="{{ old('tr_hr_pelamar_main_id', $interview->tr_hr_pelamar_main_id ?? $pelamar_id ?? '') }}" required readonly>
        </div>
        <div class="mb-3">
            <label for="interview_type" class="form-label">Tipe Interview</label>
            <select name="interview_type" id="interview_type" class="form-select" required>
                <option value="">-- Pilih Tipe --</option>
                @foreach(['SPV','HRD','MGT','FINANCE','BOD','ADMIN','OPERATOR'] as $type)
                    <option value="{{ $type }}" {{ (old('interview_type', $interview->interview_type ?? '') == $type) ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
            </select>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="date_interview" class="form-label">Tanggal Interview</label>
                <input type="date" name="date_interview" id="date_interview" class="form-control" value="{{ old('date_interview', $interview->date_interview ?? '') }}" required>
            </div>
            <div class="col-md-4">
                <label for="time_start" class="form-label">Jam Mulai</label>
                <input type="time" name="time_start" id="time_start" class="form-control" value="{{ old('time_start', $interview->time_start ?? '') }}">
            </div>
            <div class="col-md-4">
                <label for="time_end" class="form-label">Jam Selesai</label>
                <input type="time" name="time_end" id="time_end" class="form-control" value="{{ old('time_end', $interview->time_end ?? '') }}">
            </div>
        </div>
        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <input type="number" name="rating" id="rating" class="form-control" min="0" max="5" value="{{ old('rating', $interview->rating ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="note" class="form-label">Catatan</label>
            <textarea name="note" id="note" class="form-control">{{ old('note', $interview->note ?? '') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('interview_main.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
