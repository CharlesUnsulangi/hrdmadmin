@extends('layouts.app')
@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Pelamar</h1>
    <form action="{{ route('pelamar.store') }}" method="POST" class="bg-white shadow rounded p-4 max-w-lg">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Nama</label>
            <input type="text" name="nama" class="w-full border rounded px-3 py-2" value="{{ old('nama') }}">
            @error('nama')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input type="email" name="email" class="w-full border rounded px-3 py-2" value="{{ old('email') }}">
            @error('email')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1">No HP</label>
            <input type="text" name="no_hp" class="w-full border rounded px-3 py-2" value="{{ old('no_hp') }}">
            @error('no_hp')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1">Status</label>
            <input type="text" name="status" class="w-full border rounded px-3 py-2" value="{{ old('status') }}">
            @error('status')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('pelamar.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection
