@extends('layouts.app')
@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Manajemen Pelamar</h1>
    {{-- Form input pelamar baru --}}
    <div class="mb-8">
        <h2 class="text-lg font-semibold mb-2">Input Data Pelamar Baru</h2>
        <livewire:form-pelamar />
    </div>
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif
    {{-- Tabel pelamar --}}
    <livewire:pelamar-table />
</div>
@endsection
