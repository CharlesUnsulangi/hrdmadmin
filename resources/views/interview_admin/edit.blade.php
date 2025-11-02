@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2>Edit Interview Admin</h2>
    <form action="{{ route('interview_admin.update', $interview->tr_hr_pelamar_operator_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="ms_hr_pelamar_main_id" class="form-label">Pelamar</label>
            <select name="ms_hr_pelamar_main_id" id="ms_hr_pelamar_main_id" class="form-select" required>
                <option value="">-- Pilih Pelamar --</option>
                @foreach($pelamars as $pelamar)
                    <option value="{{ $pelamar->tr_hr_pelamar_main_id }}" {{ $interview->ms_hr_pelamar_main_id == $pelamar->tr_hr_pelamar_main_id ? 'selected' : '' }}>{{ $pelamar->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="date_interview" class="form-label">Tanggal Interview</label>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="date_interview" class="form-label">Tanggal Interview</label>
                <input type="date" name="date_interview" id="date_interview" class="form-control" value="{{ $interview->date_interview }}" required>
            </div>
            <div class="col-md-4">
                <label for="time_start" class="form-label">Jam Mulai</label>
                <input type="time" name="time_start" id="time_start" class="form-control" value="{{ $interview->time_start }}" required>
            </div>
            <div class="col-md-4">
                <label for="time_end" class="form-label">Jam Selesai</label>
                <input type="time" name="time_end" id="time_end" class="form-control" value="{{ $interview->time_end }}" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Rating</label><br>
            @for($i = 0; $i <= 5; $i++)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="rating_final" id="rating_final_{{ $i }}" value="{{ $i }}" {{ $interview->rating_final == $i ? 'checked' : '' }}>
                    <label class="form-check-label" for="rating_final_{{ $i }}">{{ $i }}</label>
                </div>
            @endfor
        </div>
        <div class="mb-3">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="cek_offline" id="cek_offline" value="1" {{ $interview->cek_offline ? 'checked' : '' }}>
                <label class="form-check-label" for="cek_offline">Offline</label>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="cek_online" id="cek_online" value="1" {{ $interview->cek_online ? 'checked' : '' }}>
                <label class="form-check-label" for="cek_online">Online</label>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Red Flag</label><br>
            @for($i = 0; $i <= 5; $i++)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="red_flag" id="red_flag_{{ $i }}" value="{{ $i }}" {{ $interview->red_flag == $i ? 'checked' : '' }}>
                    <label class="form-check-label" for="red_flag_{{ $i }}">{{ $i }}</label>
                </div>
            @endfor
        </div>
        <div class="mb-3">
            <label class="form-label">Green Flag</label><br>
            @for($i = 0; $i <= 5; $i++)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="green_flag" id="green_flag_{{ $i }}" value="{{ $i }}" {{ $interview->green_flag == $i ? 'checked' : '' }}>
                    <label class="form-check-label" for="green_flag_{{ $i }}">{{ $i }}</label>
                </div>
            @endfor
        </div>
        <div class="mb-3">
            <label for="note_interview" class="form-label">Catatan Interview</label>
            <textarea name="note_interview" id="note_interview" class="form-control">{{ $interview->note_interview }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            var start = document.getElementById('time_start').value;
            var end = document.getElementById('time_end');
            if (start && end && !end.value) {
                var [h, m] = start.split(':');
                var date = new Date();
                date.setHours(parseInt(h));
                date.setMinutes(parseInt(m));
                date.setMinutes(date.getMinutes() + 60);
                var hh = String(date.getHours()).padStart(2, '0');
                var mm = String(date.getMinutes()).padStart(2, '0');
                end.value = hh + ':' + mm;
            }
        });
        </script>
        <a href="{{ route('interview_admin.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
