@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2>Daftar Interview BOD</h2>
    <a href="{{ route('interview_bod.create') }}" class="btn btn-success mb-3">Tambah Interview BOD</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pelamar</th>
                <th>Tanggal</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Rating</th>
                <th>Offline</th>
                <th>Online</th>
                <th>Red Flag</th>
                <th>Green Flag</th>
                <th>Catatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($interviews as $row)
            <tr>
                <td>{{ $row->tr_hr_pelamar_operator_id }}</td>
                <td>{{ $row->pelamar->nama ?? '-' }}</td>
                <td>{{ $row->date_interview }}</td>
                <td>{{ $row->time_start }}</td>
                <td>{{ $row->time_end }}</td>
                <td>{{ $row->rating_final }}</td>
                <td>{{ $row->cek_offline ? 'Ya' : 'Tidak' }}</td>
                <td>{{ $row->cek_online ? 'Ya' : 'Tidak' }}</td>
                <td>{{ $row->red_flag }}</td>
                <td>{{ $row->green_flag }}</td>
                <td>{{ $row->note_interview }}</td>
                <td>
                    <a href="{{ route('interview_bod.edit', $row->tr_hr_pelamar_operator_id) }}" class="btn btn-sm btn-primary">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $interviews->links() }}
</div>
@endsection
