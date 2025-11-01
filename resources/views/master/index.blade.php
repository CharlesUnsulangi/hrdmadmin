@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Pengaturan Master</h2>
    <div class="mb-3">
        <a href="{{ route('ms-company.index') }}" class="btn btn-outline-primary btn-sm">Master Perusahaan</a>
        <a href="{{ route('ms-division.index') }}" class="btn btn-outline-primary btn-sm">Master Divisi</a>
        <a href="{{ route('ms-bank.index') }}" class="btn btn-outline-primary btn-sm">Master Bank</a>
    </div>
    <ul class="nav nav-tabs" id="masterTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="posisi-tab" data-bs-toggle="tab" data-bs-target="#posisi" type="button" role="tab">Master Posisi</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="asal-tab" data-bs-toggle="tab" data-bs-target="#asal" type="button" role="tab">Master Asal Lamaran</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="status-tab" data-bs-toggle="tab" data-bs-target="#status" type="button" role="tab">Master Status Pelamar</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="template-tab" data-bs-toggle="tab" data-bs-target="#template" type="button" role="tab">Master Template Pesan</button>
        </li>
    </ul>
    <div class="tab-content mt-3" id="masterTabContent">
        <div class="tab-pane fade show active" id="posisi" role="tabpanel">
            @livewire('master.ms-hr-posisi-livewire')
        </div>
        <div class="tab-pane fade" id="asal" role="tabpanel">
            @livewire('master.ms-hr-from')
        </div>
        <div class="tab-pane fade" id="status" role="tabpanel">
            @livewire('master.ms-hr-status-pelamar')
        </div>
        <div class="tab-pane fade" id="template" role="tabpanel">
            @livewire('master.ms-hr-template-pesan')
        </div>
    </div>
</div>
@endsection
