@extends('layouts.clean')

@section('title', 'Edit Berita Acara')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Edit {{ $beritaAcara->type_name }}
                    </h5>
                    <div class="btn-group">
                        <a href="{{ route('berita-acara.show', $beritaAcara->tr_hr_ba_id) }}" class="btn btn-info">
                            <i class="fas fa-eye me-2"></i>Lihat Detail
                        </a>
                        <a href="{{ route('berita-acara.index', ['type' => $type]) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('berita-acara.update', $beritaAcara->tr_hr_ba_id) }}" method="POST" id="baForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="ms_hr_ba_type_id" value="{{ $type }}">

                        <!-- Main Form Section -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card border-primary">
                                    <div class="card-header bg-primary text-white">
                                        <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Utama</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="date_ba" class="form-label">Tanggal BA <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control @error('date_ba') is-invalid @enderror" 
                                                   id="date_ba" name="date_ba" 
                                                   value="{{ old('date_ba', $beritaAcara->date_ba ? $beritaAcara->date_ba->format('Y-m-d') : '') }}" required>
                                            @error('date_ba')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="note_ba" class="form-label">Catatan/Deskripsi <span class="text-danger">*</span></label>
                                            <textarea class="form-control @error('note_ba') is-invalid @enderror" 
                                                      id="note_ba" name="note_ba" rows="4" required 
                                                      placeholder="Masukkan catatan atau deskripsi BA...">{{ old('note_ba', $beritaAcara->note_ba) }}</textarea>
                                            @error('note_ba')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="pelaku_desc" class="form-label">Deskripsi Pelaku (Opsional)</label>
                                            <input type="text" class="form-control @error('pelaku_desc') is-invalid @enderror" 
                                                   id="pelaku_desc" name="pelaku_desc" 
                                                   value="{{ old('pelaku_desc', $beritaAcara->pelaku_desc) }}" 
                                                   placeholder="Deskripsi singkat pelaku jika ada">
                                            @error('pelaku_desc')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="alert alert-warning">
                                            <small>
                                                <i class="fas fa-info-circle me-1"></i>
                                                <strong>Info:</strong> ID BA: {{ $beritaAcara->tr_hr_ba_id }} | 
                                                Dibuat: {{ $beritaAcara->created_at->format('d/m/Y H:i') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- Type Specific Form -->
                                @if($type === 'TEMUAN')
                                    @include('berita-acara.partials.edit-temuan', ['beritaAcara' => $beritaAcara, 'users' => $users])
                                @elseif($type === 'LAKA')
                                    @include('berita-acara.partials.edit-laka', ['beritaAcara' => $beritaAcara])
                                @elseif($type === 'REVISI')
                                    @include('berita-acara.partials.edit-revisi', ['beritaAcara' => $beritaAcara])
                                @endif
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border-success">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary" onclick="history.back()">
                                                <i class="fas fa-times me-2"></i>Batal
                                            </button>
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-save me-2"></i>Update Berita Acara
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Form validation
    $('#baForm').on('submit', function(e) {
        let isValid = true;
        
        // Check required fields
        $('input[required], textarea[required], select[required]').each(function() {
            if (!$(this).val()) {
                $(this).addClass('is-invalid');
                isValid = false;
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        if (!isValid) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Form Tidak Valid',
                text: 'Mohon lengkapi semua field yang wajib diisi!'
            });
        }
    });

    // Input validation on change
    $('input[required], textarea[required], select[required]').on('change keyup', function() {
        if ($(this).val()) {
            $(this).removeClass('is-invalid');
        }
    });
});
</script>
@endsection