@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Daftar Interview Pelamar</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Pelamar</th>
                <th>Tanggal Interview</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($interviews as $row)
            <tr>
                <td>{{ $row->tr_hr_pelamar_interview_main_id }}</td>
                <td>{{ $row->tr_hr_pelamar_main_id }}</td>
                <td>{{ $row->date_interview }}</td>
                <td>{{ $row->time_start }}</td>
                <td>{{ $row->time_end }}</td>
                <td><a href="{{ url('tr_hr_pelamar_interview/'.$row->tr_hr_pelamar_interview_main_id) }}" class="btn btn-sm btn-info">Detail</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $interviews->links() }}
    </div>
</div>
@endsection
