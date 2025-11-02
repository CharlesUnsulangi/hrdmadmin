@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2>Manajemen Interview</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <form class="d-flex gap-2" method="GET">
            <input type="text" name="search" class="form-control" placeholder="Cari pelamar...">
            <select name="status" class="form-select">
                <option value="">Status Interview</option>
                <option value="scheduled">Terjadwal</option>
                <option value="done">Selesai</option>
                <option value="cancelled">Dibatalkan</option>
            </select>
            <button class="btn btn-primary">Filter</button>
        </form>
        <a href="{{ route('interview.create') }}" class="btn btn-success">Tambah Jadwal Interview</a>
    </div>
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Nama Pelamar</th>
                <th>Posisi</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Interviewer</th>
                <th>Status Google Calendar</th>
                <th>Status Interview</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($interviews as $row)
            <tr>
                <td>{{ $row->pelamar->nama ?? '-' }}</td>
                <td>{{ $row->pelamar->posisi ?? '-' }}</td>
                <td>{{ $row->skedul_pelamar_time ? \Carbon\Carbon::parse($row->skedul_pelamar_time)->format('d-m-Y') : '-' }}</td>
                <td>{{ $row->skedul_pelamar_time ? \Carbon\Carbon::parse($row->skedul_pelamar_time)->format('H:i') : '-' }}</td>
                <td>-</td>
                <td>
                    @if($row->pelamar && $row->pelamar->google_event_id)
                        <span class="badge bg-success">Terkirim</span>
                    @else
                        <span class="badge bg-secondary">Belum</span>
                    @endif
                </td>
                <td><span class="badge bg-warning text-dark">Terjadwal</span></td>
                <td>
                    <a href="#" class="btn btn-sm btn-info">Detail</a>
                    <a href="#" class="btn btn-sm btn-primary">Edit</a>
                    <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                    @if($row->pelamar && $row->pelamar->google_event_id)
                        <a href="https://calendar.google.com/calendar/u/0/r/eventedit/{{ $row->pelamar->google_event_id }}" target="_blank" class="btn btn-sm btn-secondary">Google Cal</a>
                    @else
                        <span class="btn btn-sm btn-secondary disabled">Google Cal</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="8" class="text-center">Belum ada jadwal interview</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
