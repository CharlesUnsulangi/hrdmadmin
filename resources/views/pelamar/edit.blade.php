@extends('layouts.app')
@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Edit Pelamar</h1>
    <form action="{{ route('pelamar.update', $pelamar->tr_hr_pelamar_main_id) }}" method="POST" class="bg-white shadow rounded p-4 max-w-lg">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1">Nama</label>
            <input type="text" name="nama" class="w-full border rounded px-3 py-2" value="{{ old('nama', $pelamar->nama) }}">
            @error('nama')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input type="email" name="email" class="w-full border rounded px-3 py-2" value="{{ old('email', $pelamar->email) }}">
            @error('email')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1">No HP</label>
            <input type="text" name="no_hp" class="w-full border rounded px-3 py-2" value="{{ old('no_hp', $pelamar->no_hp) }}">
            @error('no_hp')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1">Status</label>
            <input type="text" name="status" class="w-full border rounded px-3 py-2" value="{{ old('status', $pelamar->status) }}">
            @error('status')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('pelamar.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>

    <div class="my-4 flex flex-wrap gap-2">
        <form action="{{ route('pelamar.jadikanKandidat', $pelamar->tr_hr_pelamar_main_id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-success">Jadikan Kandidat</button>
        </form>
        <a href="{{ route('pelamar.interview', $pelamar->tr_hr_pelamar_main_id) }}" class="btn btn-primary">Interview</a>
        <form action="{{ route('pelamar.tolak', $pelamar->tr_hr_pelamar_main_id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Tolak</button>
        </form>
        <a href="{{ route('pelamar.diskusi', $pelamar->tr_hr_pelamar_main_id) }}" class="btn btn-warning">Diskusi</a>
        <form action="{{ route('pelamar.confirmJadwalInterview', $pelamar->tr_hr_pelamar_main_id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-info">Confirm Jadwal Interview</button>
        </form>
        <a href="{{ route('pelamar.reschedule', $pelamar->tr_hr_pelamar_main_id) }}" class="btn btn-secondary">Reschedule Interview</a>
        <a href="{{ route('pelamar.backgroundCheck', $pelamar->tr_hr_pelamar_main_id) }}" class="btn btn-dark">Background Check</a>

        <!-- Tombol Lakukan Interview -->
        <a href="{{ route('interview_main.create', ['pelamar_id' => $pelamar->tr_hr_pelamar_main_id]) }}" class="btn btn-outline-primary">
            Lakukan Interview
        </a>
    </div>

    <ul class="nav nav-tabs mt-5" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pengalaman-tab" data-bs-toggle="tab" data-bs-target="#pengalaman" type="button" role="tab">Pengalaman</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="interview-tab" data-bs-toggle="tab" data-bs-target="#interview" type="button" role="tab">Hasil Interview</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab">Data Personal</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="sosmed-tab" data-bs-toggle="tab" data-bs-target="#sosmed" type="button" role="tab">Sosial Media</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="pengalaman" role="tabpanel">
            @include('pelamar.pengalaman', ['pelamar' => $pelamar])
        </div>
        <div class="tab-pane fade" id="interview" role="tabpanel">
            <livewire:pelamar-interview :pelamar-id="$pelamar->tr_hr_pelamar_main_id" />
        </div>
        <div class="tab-pane fade" id="personal" role="tabpanel">
            <livewire:pelamar-personal :pelamar-id="$pelamar->tr_hr_pelamar_main_id" />
        </div>
        <div class="tab-pane fade" id="sosmed" role="tabpanel">
            <livewire:pelamar-sosmed :pelamar-id="$pelamar->tr_hr_pelamar_main_id" />
        </div>
    </div>
</div>
@endsection
