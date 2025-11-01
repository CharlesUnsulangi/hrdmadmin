@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Daftar Bank</h2>
    <a href="{{ route('ms-bank.create') }}" class="btn btn-success mb-3">Tambah Bank</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Kode Bank</th>
                <th>User Created</th>
                <th>User Update</th>
                <th>Tanggal Created</th>
                <th>Tanggal Update</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($banks as $bank)
            <tr>
                <td>{{ $bank->Bank_Code }}</td>
                <td>{{ $bank->rec_usercreated }}</td>
                <td>{{ $bank->rec_userupdate }}</td>
                <td>{{ $bank->rec_datecreated }}</td>
                <td>{{ $bank->rec_dateupdate }}</td>
                <td>{{ $bank->rec_status }}</td>
                <td>
                    <a href="{{ route('ms-bank.edit', $bank->Bank_Code) }}" class="btn btn-sm btn-warning">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
