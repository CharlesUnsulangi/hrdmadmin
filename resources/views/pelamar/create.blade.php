@extends('layouts.app')
@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Pelamar</h1>
    <livewire:pelamar-row-entry-list />
    <a href="{{ route('pelamar.index') }}" class="inline-block mt-4 text-gray-600">&larr; Kembali ke daftar pelamar</a>
</div>
@endsection
