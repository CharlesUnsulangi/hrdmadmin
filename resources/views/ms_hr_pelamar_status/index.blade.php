@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h1 class="mb-4">Master Status Pelamar</h1>
    <a href="{{ route('ms_hr_pelamar_status.create') }}" class="btn btn-success mb-3">Tambah Status</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($statuses as $status)
            <tr>
                <td>{{ $status->ms_hr_pelamar_status_id }}</td>
                <td>{{ $status->status_desc }}</td>
                <td>
                    <a href="{{ route('ms_hr_pelamar_status.edit', $status->ms_hr_pelamar_status_id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('ms_hr_pelamar_status.destroy', $status->ms_hr_pelamar_status_id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
