@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2>Tambah Interview Finance</h2>
    <form action="{{ route('interview_finance.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="ms_hr_pelamar_main_id" class="form-label">Pelamar</label>
            @if(isset($selectedPelamar) && $selectedPelamar)
                <input type="hidden" name="ms_hr_pelamar_main_id" value="{{ $selectedPelamar->tr_hr_pelamar_main_id }}">
                <input type="text" class="form-control" value="{{ $selectedPelamar->nama }}" readonly>
            @else
                <select name="ms_hr_pelamar_main_id" id="ms_hr_pelamar_main_id" class="form-select" required>
                    <option value="">-- Pilih Pelamar --</option>
                    @foreach($pelamars as $pelamar)
                        <option value="{{ $pelamar->tr_hr_pelamar_main_id }}">{{ $pelamar->nama }}</option>
                    @endforeach
                </select>
            @endif
        </div>
        <div class="mb-3">
            <label for="date_interview" class="form-label">Tanggal Interview</label>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="date_interview" class="form-label">Tanggal Interview</label>
                <input type="date" name="date_interview" id="date_interview" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="time_start" class="form-label">Jam Mulai</label>
                <input type="time" name="time_start" id="time_start" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="time_end" class="form-label">Jam Selesai</label>
            <input type="time" name="time_end" id="time_end" class="form-control">
        <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            var end = document.getElementById('time_end');
            if (end) {
                var now = new Date();
                var hh = String(now.getHours()).padStart(2, '0');
                var mm = String(now.getMinutes()).padStart(2, '0');
                end.value = hh + ':' + mm;
            }
        });
        </script>
            </div>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var today = new Date();
            var yyyy = today.getFullYear();
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var dd = String(today.getDate()).padStart(2, '0');
            document.getElementById('date_interview').value = yyyy + '-' + mm + '-' + dd;
            var hh = String(today.getHours()).padStart(2, '0');
            var min = String(Math.round(today.getMinutes() / 5) * 5).padStart(2, '0');
            document.getElementById('time_start').value = hh + ':' + min;
        });
        </script>
        <!-- duplikat time_end dihapus, hanya satu input time_end -->
        <div class="mb-3">
            <label class="form-label">Rating</label><br>
            @for($i = 0; $i <= 5; $i++)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="rating_final" id="rating_final_{{ $i }}" value="{{ $i }}" {{ $i === 0 ? 'checked' : '' }}>
                    <label class="form-check-label" for="rating_final_{{ $i }}">{{ $i }}</label>
                </div>
            @endfor
        </div>
        <div class="mb-3">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="cek_offline" id="cek_offline" value="1">
                <label class="form-check-label" for="cek_offline">Offline</label>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="cek_online" id="cek_online" value="1">
                <label class="form-check-label" for="cek_online">Online</label>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Red Flag</label><br>
            @for($i = 0; $i <= 5; $i++)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="red_flag" id="red_flag_{{ $i }}" value="{{ $i }}" {{ $i === 0 ? 'checked' : '' }}>
                    <label class="form-check-label" for="red_flag_{{ $i }}">{{ $i }}</label>
                </div>
            @endfor
        </div>
        <div class="mb-3">
            <label class="form-label">Green Flag</label><br>
            @for($i = 0; $i <= 5; $i++)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="green_flag" id="green_flag_{{ $i }}" value="{{ $i }}" {{ $i === 0 ? 'checked' : '' }}>
                    <label class="form-check-label" for="green_flag_{{ $i }}">{{ $i }}</label>
                </div>
            @endfor
        </div>
        <div class="mb-3">
            <label for="note_interview" class="form-label">Catatan Interview</label>
            <textarea name="note_interview" id="note_interview" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
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
        <a href="{{ route('interview_finance.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
