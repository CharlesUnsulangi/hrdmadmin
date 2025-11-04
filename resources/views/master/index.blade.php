@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Pengaturan Master</h2>
    <div class="mb-3">
        <a href="{{ route('ms-company.index') }}" class="btn btn-outline-primary btn-sm">Master Perusahaan</a>
        <a href="{{ route('ms-division.index') }}" class="btn btn-outline-primary btn-sm">Master Divisi</a>
        <a href="{{ route('ms-bank.index') }}" class="btn btn-outline-primary btn-sm">Master Bank</a>
    <a href="{{ route('ms_hr_pelamar_type.index') }}" class="btn btn-outline-success btn-sm">Master Tipe Pelamar</a>
    <a href="{{ route('ms_hr_pelamar_status.index') }}" class="btn btn-outline-info btn-sm">Master Status Pelamar</a>
    <a href="{{ route('ms-hr-ba-kejadian.index') }}" class="btn btn-outline-warning btn-sm">Master BA Kejadian</a>
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
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="ba-kejadian-tab" data-bs-toggle="tab" data-bs-target="#ba-kejadian" type="button" role="tab">Master BA Kejadian</button>
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
        <div class="tab-pane fade" id="ba-kejadian" role="tabpanel">
            @livewire('master.ms-hr-ba-kejadian-component')
        </div>
    </div>
</div>
@endsection
