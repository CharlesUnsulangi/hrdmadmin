@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2>Jadwal Interview Pelamar</h2>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tanggal Interview</th>
                <th>Jam</th>
                <th>Status Google Calendar</th>
                <th>Link Google Calendar</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $pelamar->nama }}</td>
                <td>{{ $pelamar->time_interview ? \Carbon\Carbon::parse($pelamar->time_interview)->format('d-m-Y') : '-' }}</td>
                <td>{{ $pelamar->time_interview ? \Carbon\Carbon::parse($pelamar->time_interview)->format('H:i') : '-' }}</td>
                <td>
                    @if($pelamar->google_event_id)
                        <span class="badge bg-success">Terkirim</span>
                    @else
                        <span class="badge bg-secondary">Belum</span>
                    @endif
                </td>
                <td>
                    @if($pelamar->google_event_id)
                        <a href="https://calendar.google.com/calendar/u/0/r/eventedit/{{ $pelamar->google_event_id }}" target="_blank" class="btn btn-sm btn-primary">Lihat Event</a>
                    @else
                        -
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
