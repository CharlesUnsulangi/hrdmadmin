@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Daftar Divisi</h2>
    <a href="{{ route('ms-division.create') }}" class="btn btn-success mb-3">Tambah Divisi</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Divisi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($divisions as $division)
            <tr>
                <td>{{ $division->div_id }}</td>
                <td>{{ $division->div_desc }}</td>
                <td>
                    <a href="{{ route('ms-division.edit', $division->div_id) }}" class="btn btn-sm btn-warning">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
