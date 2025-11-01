@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Daftar Perusahaan</h2>
    <a href="{{ route('ms-company.create') }}" class="btn btn-success mb-3">Tambah Perusahaan</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Perusahaan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($companies as $company)
            <tr>
                <td>{{ $company->company_code }}</td>
                <td>{{ $company->company_desc }}</td>
                <td>
                    <a href="{{ route('ms-company.edit', $company->company_code) }}" class="btn btn-sm btn-warning">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
