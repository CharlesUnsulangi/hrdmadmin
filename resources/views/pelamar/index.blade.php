@extends('layouts.app')
@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Manajemen Pelamar</h1>
    <div class="mb-4 flex justify-end">
        <a href="{{ route('pelamar.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition">Tambah Pelamar</a>
    </div>
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif
    {{-- Tabel pelamar --}}
    <livewire:pelamar-table />
</div>
@endsection
