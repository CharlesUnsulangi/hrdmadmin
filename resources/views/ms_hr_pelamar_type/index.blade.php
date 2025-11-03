@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2 class="mb-3">Master Tipe Pelamar</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('ms_hr_pelamar_type.create') }}" class="btn btn-primary mb-3">Tambah Tipe</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($list as $row)
            <tr>
                <td>{{ $row->ms_hr_pelamar_type_id }}</td>
                <td>{{ $row->type_desc }}</td>
                <td>
                    <a href="{{ route('ms_hr_pelamar_type.edit', $row->ms_hr_pelamar_type_id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('ms_hr_pelamar_type.destroy', $row->ms_hr_pelamar_type_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus tipe ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="3" class="text-center">Belum ada data</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
