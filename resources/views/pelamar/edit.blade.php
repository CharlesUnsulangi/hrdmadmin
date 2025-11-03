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
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="">-- Pilih Status --</option>
                @foreach(\App\Models\MsHrPelamarStatus::all() as $status)
                    <option value="{{ $status->ms_hr_pelamar_status_id }}" {{ old('status', $pelamar->status) == $status->ms_hr_pelamar_status_id ? 'selected' : '' }}>{{ $status->status_desc }}</option>
                @endforeach
            </select>
            @error('status')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1">Posisi</label>
            <select name="ms_hr_posisi_id" class="w-full border rounded px-3 py-2">
                <option value="">-- Pilih Posisi --</option>
                @foreach(\App\Models\MsHrPosisi::all() as $posisi)
                    <option value="{{ $posisi->ms_hr_posisi_id }}" {{ old('ms_hr_posisi_id', $pelamar->ms_hr_posisi_id) == $posisi->ms_hr_posisi_id ? 'selected' : '' }}>{{ $posisi->posisi_desc }}</option>
                @endforeach
            </select>
            @error('ms_hr_posisi_id')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1">Rating</label>
            <div class="flex gap-2">
                @for($i = 1; $i <= 5; $i++)
                    <label class="inline-flex items-center">
                        <input type="radio" name="rating" value="{{ $i }}" {{ old('rating', $pelamar->rating) == $i ? 'checked' : '' }}>
                        <span class="ml-1">{{ $i }}</span>
                    </label>
                @endfor
            </div>
            @error('rating')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1">Asal Lamaran</label>
            <select name="ms_hr_from_id" class="w-full border rounded px-3 py-2">
                <option value="">-- Pilih Asal Lamaran --</option>
                @foreach(\App\Models\MsHrFrom::all() as $from)
                    <option value="{{ $from->ms_hr_from_id }}" {{ old('ms_hr_from_id', $pelamar->ms_hr_from_id) == $from->ms_hr_from_id ? 'selected' : '' }}>{{ $from->form_hr_desc }}</option>
                @endforeach
            </select>
            @error('ms_hr_from_id')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1">Link CV</label>
            <input type="text" name="link_cv" class="w-full border rounded px-3 py-2" value="{{ old('link_cv', $pelamar->link_cv) }}">
            @error('link_cv')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
        </div>

        <div class="mb-4 flex gap-6">
            <label class="inline-flex items-center">
                <input type="checkbox" name="cek_shortlist" value="1" {{ old('cek_shortlist', $pelamar->cek_shortlist) ? 'checked' : '' }}>
                <span class="ml-2">Cek Shortlist</span>
            </label>
            <label class="inline-flex items-center">
                <input type="checkbox" name="cek_priority" value="1" {{ old('cek_priority', $pelamar->cek_priority) ? 'checked' : '' }}>
                <span class="ml-2">Cek Priority</span>
            </label>
        </div>
    <button type="submit" class="bg-yellow-400 text-black font-bold px-4 py-2 rounded border border-yellow-600 shadow">Update</button>
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
