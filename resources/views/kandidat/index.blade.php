@extends('layouts.app')
@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Manajemen Kandidat</h1>
    <div class="mb-4 flex justify-between items-center">
        <div>
            <form method="GET" action="">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari ID Kandidat..." class="border rounded px-2 py-1" />
                <select name="status" class="border rounded px-2 py-1">
                    <option value="">Semua Status</option>
                    <option value="draft" {{ request('status')=='draft' ? 'selected' : '' }}>Draft</option>
                    <option value="approved" {{ request('status')=='approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status')=='rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
                <button type="submit" class="bg-gray-200 px-2 py-1 rounded">Filter</button>
            </form>
        </div>
        <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Kandidat</a>
    </div>
    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="px-4 py-2 border">ID Kandidat</th>
                <th class="px-4 py-2 border">Status</th>
                <th class="px-4 py-2 border">Tanggal Kandidat</th>
                <th class="px-4 py-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kandidat as $row)
            <tr>
                <td class="border px-4 py-2">{{ $row->ms_hr_kandidat_emp_id }}</td>
                <td class="border px-4 py-2">{{ $row->ms_status_id }}</td>
                <td class="border px-4 py-2">{{ $row->date_kandidat }}</td>
                <td class="border px-4 py-2">
                    <a href="#" class="text-blue-600">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $kandidat->links() }}
    </div>
</div>
@endsection
