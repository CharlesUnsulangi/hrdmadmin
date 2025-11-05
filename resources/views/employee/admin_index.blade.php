@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Employee Admin</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Status</th>
                <th>Tanggal Join</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->emp_id }}</td>
                <td>{{ $employee->emp_name }}</td>
                <td>{{ $employee->emp_email }}</td>
                <td>{{ $employee->emp_inactive ? 'Inactive' : 'Active' }}</td>
                <td>{{ $employee->emp_datejoin }}</td>
                <td>
                    <a href="{{ route('employee.edit', $employee->emp_id) }}" class="btn btn-sm btn-primary">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
