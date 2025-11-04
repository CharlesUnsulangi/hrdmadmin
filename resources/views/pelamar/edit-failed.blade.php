@extends('layouts.clean')

@section('title', 'Edit Pelamar')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="mb-1">
                        <i class="fas fa-user-edit me-2"></i>Edit Pelamar
                    </h4>
                    <p class="text-muted mb-0">{{ $pelamar->nama }} - {{ $pelamar->email }}</p>
                </div>
                <a href="{{ route('pelamar.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <!-- Action Buttons -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-cogs me-2"></i>Aksi Cepat
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-md-2">
                            <form action="{{ route('pelamar.jadikanKandidat', $pelamar->tr_hr_pelamar_main_id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-user-check me-1"></i>Jadikan Kandidat
                                </button>
                            </form>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('pelamar.interview', $pelamar->tr_hr_pelamar_main_id) }}" class="btn btn-primary w-100">
                                <i class="fas fa-calendar-alt me-1"></i>Interview
                            </a>
                        </div>
                        <div class="col-md-2">
                            <form action="{{ route('pelamar.tolak', $pelamar->tr_hr_pelamar_main_id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Yakin ingin menolak pelamar ini?')">
                                    <i class="fas fa-times me-1"></i>Tolak
                                </button>
                            </form>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('pelamar.diskusi', $pelamar->tr_hr_pelamar_main_id) }}" class="btn btn-warning w-100">
                                <i class="fas fa-comments me-1"></i>Diskusi
                            </a>
                        </div>
                        <div class="col-md-2">
                            <form action="{{ route('pelamar.confirmJadwalInterview', $pelamar->tr_hr_pelamar_main_id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-info w-100">
                                    <i class="fas fa-check-circle me-1"></i>Confirm Jadwal
                                </button>
                            </form>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('pelamar.reschedule', $pelamar->tr_hr_pelamar_main_id) }}" class="btn btn-secondary w-100">
                                <i class="fas fa-calendar-times me-1"></i>Reschedule
                            </a>
                        </div>
                    </div>
                    <div class="row g-2 mt-2">
                        <div class="col-md-2">
                            <a href="{{ route('pelamar.backgroundCheck', $pelamar->tr_hr_pelamar_main_id) }}" class="btn btn-dark w-100">
                                <i class="fas fa-search me-1"></i>Background Check
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('interview_main.create', ['pelamar_id' => $pelamar->tr_hr_pelamar_main_id]) }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-microphone me-1"></i>Lakukan Interview
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content with Tabs -->
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="pelamarTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="data-tab" data-bs-toggle="tab" data-bs-target="#data" type="button" role="tab">
                                <i class="fas fa-user me-2"></i>Data Pelamar
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pengalaman-tab" data-bs-toggle="tab" data-bs-target="#pengalaman" type="button" role="tab">
                                <i class="fas fa-briefcase me-2"></i>Pengalaman
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="interview-tab" data-bs-toggle="tab" data-bs-target="#interview" type="button" role="tab">
                                <i class="fas fa-comments me-2"></i>Hasil Interview
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab">
                                <i class="fas fa-id-card me-2"></i>Data Personal
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="sosmed-tab" data-bs-toggle="tab" data-bs-target="#sosmed" type="button" role="tab">
                                <i class="fas fa-share-alt me-2"></i>Sosial Media
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="pelamarTabContent">
                        <!-- Data Pelamar Tab -->
                        <div class="tab-pane fade show active" id="data" role="tabpanel">
                            <form action="{{ route('pelamar.update', $pelamar->tr_hr_pelamar_main_id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">
                                                <i class="fas fa-user me-1"></i>Nama <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" 
                                                   class="form-control @error('nama') is-invalid @enderror" 
                                                   id="nama" 
                                                   name="nama" 
                                                   value="{{ old('nama', $pelamar->nama) }}" 
                                                   required>
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">
                                                <i class="fas fa-envelope me-1"></i>Email <span class="text-danger">*</span>
                                            </label>
                                            <input type="email" 
                                                   class="form-control @error('email') is-invalid @enderror" 
                                                   id="email" 
                                                   name="email" 
                                                   value="{{ old('email', $pelamar->email) }}" 
                                                   required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="no_hp" class="form-label">
                                                <i class="fas fa-phone me-1"></i>No HP <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" 
                                                   class="form-control @error('no_hp') is-invalid @enderror" 
                                                   id="no_hp" 
                                                   name="no_hp" 
                                                   value="{{ old('no_hp', $pelamar->no_hp) }}" 
                                                   required>
                                            @error('no_hp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="status" class="form-label">
                                                <i class="fas fa-flag me-1"></i>Status
                                            </label>
                                            <select class="form-select @error('status') is-invalid @enderror" 
                                                    id="status" 
                                                    name="status">
                                                <option value="">-- Pilih Status --</option>
                                                @foreach(\App\Models\MsHrPelamarStatus::all() as $status)
                                                    <option value="{{ $status->ms_hr_pelamar_status_id }}" 
                                                            {{ old('status', $pelamar->status) == $status->ms_hr_pelamar_status_id ? 'selected' : '' }}>
                                                        {{ $status->status_desc }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="ms_hr_posisi_id" class="form-label">
                                                <i class="fas fa-briefcase me-1"></i>Posisi
                                            </label>
                                            <select class="form-select @error('ms_hr_posisi_id') is-invalid @enderror" 
                                                    id="ms_hr_posisi_id" 
                                                    name="ms_hr_posisi_id">
                                                <option value="">-- Pilih Posisi --</option>
                                                @foreach(\App\Models\MsHrPosisi::all() as $posisi)
                                                    <option value="{{ $posisi->ms_hr_posisi_id }}" 
                                                            {{ old('ms_hr_posisi_id', $pelamar->ms_hr_posisi_id) == $posisi->ms_hr_posisi_id ? 'selected' : '' }}>
                                                        {{ $posisi->posisi_desc }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('ms_hr_posisi_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="ms_hr_from_id" class="form-label">
                                                <i class="fas fa-map-marker-alt me-1"></i>Asal Lamaran
                                            </label>
                                            <select class="form-select @error('ms_hr_from_id') is-invalid @enderror" 
                                                    id="ms_hr_from_id" 
                                                    name="ms_hr_from_id">
                                                <option value="">-- Pilih Asal Lamaran --</option>
                                                @foreach(\App\Models\MsHrFrom::all() as $from)
                                                    <option value="{{ $from->ms_hr_from_id }}" 
                                                            {{ old('ms_hr_from_id', $pelamar->ms_hr_from_id) == $from->ms_hr_from_id ? 'selected' : '' }}>
                                                        {{ $from->form_hr_desc }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('ms_hr_from_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">
                                                <i class="fas fa-star me-1"></i>Rating
                                            </label>
                                            <div class="d-flex gap-3">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <div class="form-check">
                                                        <input class="form-check-input" 
                                                               type="radio" 
                                                               name="rating" 
                                                               id="rating{{ $i }}" 
                                                               value="{{ $i }}" 
                                                               {{ old('rating', $pelamar->rating) == $i ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="rating{{ $i }}">
                                                            {{ $i }} <i class="fas fa-star text-warning"></i>
                                                        </label>
                                                    </div>
                                                @endfor
                                            </div>
                                            @error('rating')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="link_cv" class="form-label">
                                                <i class="fas fa-file-pdf me-1"></i>Link CV
                                            </label>
                                            <input type="url" 
                                                   class="form-control @error('link_cv') is-invalid @enderror" 
                                                   id="link_cv" 
                                                   name="link_cv" 
                                                   value="{{ old('link_cv', $pelamar->link_cv) }}" 
                                                   placeholder="https://...">
                                            @error('link_cv')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">
                                                <i class="fas fa-check-circle me-1"></i>Status Khusus
                                            </label>
                                            <div class="d-flex gap-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" 
                                                           type="checkbox" 
                                                           name="cek_shortlist" 
                                                           id="cek_shortlist" 
                                                           value="1" 
                                                           {{ old('cek_shortlist', $pelamar->cek_shortlist) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="cek_shortlist">
                                                        <i class="fas fa-list me-1"></i>Shortlist
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" 
                                                           type="checkbox" 
                                                           name="cek_priority" 
                                                           id="cek_priority" 
                                                           value="1" 
                                                           {{ old('cek_priority', $pelamar->cek_priority) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="cek_priority">
                                                        <i class="fas fa-star me-1"></i>Priority
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save me-2"></i>Update Data
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Pengalaman Tab -->
                        <div class="tab-pane fade" id="pengalaman" role="tabpanel">
                            @include('pelamar.pengalaman', ['pelamar' => $pelamar])
                        </div>

                        <!-- Interview Tab -->
                        <div class="tab-pane fade" id="interview" role="tabpanel">
                            <livewire:pelamar-interview :pelamar-id="$pelamar->tr_hr_pelamar_main_id" />
                        </div>

                        <!-- Personal Tab -->
                        <div class="tab-pane fade" id="personal" role="tabpanel">
                            <livewire:pelamar-personal :pelamar-id="$pelamar->tr_hr_pelamar_main_id" />
                        </div>

                        <!-- Sosmed Tab -->
                        <div class="tab-pane fade" id="sosmed" role="tabpanel">
                            <livewire:pelamar-sosmed :pelamar-id="$pelamar->tr_hr_pelamar_main_id" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success/Error Messages -->
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif
@endsection