@extends('layouts.clean')

@section('title', 'Buat Berita Acara')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-plus me-2"></i>Buat {{ $type === 'TEMUAN' ? 'BA Temuan' : ($type === 'LAKA' ? 'BA Laka' : 'BA Revisi') }}
                    </h5>
                    <a href="{{ route('berita-acara.index', ['type' => $type]) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route('berita-acara.store') }}" method="POST" id="baForm">
                        @csrf
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
                                                   id="date_ba" name="date_ba" value="{{ old('date_ba', date('Y-m-d')) }}" required>
                                            @error('date_ba')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="note_ba" class="form-label">Catatan/Deskripsi <span class="text-danger">*</span></label>
                                            <textarea class="form-control @error('note_ba') is-invalid @enderror" 
                                                      id="note_ba" name="note_ba" rows="4" required 
                                                      placeholder="Masukkan catatan atau deskripsi BA...">{{ old('note_ba') }}</textarea>
                                            @error('note_ba')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="pelaku_desc" class="form-label">Deskripsi Pelaku (Opsional)</label>
                                            <input type="text" class="form-control @error('pelaku_desc') is-invalid @enderror" 
                                                   id="pelaku_desc" name="pelaku_desc" value="{{ old('pelaku_desc') }}" 
                                                   placeholder="Deskripsi singkat pelaku jika ada">
                                            @error('pelaku_desc')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- Type Specific Form -->
                                @if($type === 'TEMUAN')
                                    @include('berita-acara.partials.form-temuan')
                                @elseif($type === 'LAKA')
                                    @include('berita-acara.partials.form-laka')
                                @elseif($type === 'REVISI')
                                    @include('berita-acara.partials.form-revisi')
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
                                                <i class="fas fa-save me-2"></i>Simpan Berita Acara
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
        console.log('Form submitted!'); // Debug log
        let isValid = true;
        
        // Check required fields
        $('input[required], textarea[required], select[required]').each(function() {
            if (!$(this).val()) {
                $(this).addClass('is-invalid');
                isValid = false;
                console.log('Missing required field:', $(this).attr('name')); // Debug log
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        @if($type === 'TEMUAN')
        // Validate at least one pelaku for BA Temuan
        if ($('.pelaku-section').length === 0) {
            console.log('No pelaku found for BA Temuan'); // Debug log
            Swal.fire({
                icon: 'error',
                title: 'Validasi Error',
                text: 'BA Temuan harus memiliki minimal 1 pelaku!'
            });
            isValid = false;
        } else {
            console.log('Found', $('.pelaku-section').length, 'pelaku sections'); // Debug log
        }
        @endif

        @if($type === 'REVISI')
        // Validate at least one revisi item for BA Revisi
        if ($('.revisi-section').length === 0) {
            console.log('No revisi found for BA Revisi'); // Debug log
            Swal.fire({
                icon: 'error',
                title: 'Validasi Error',
                text: 'BA Revisi harus memiliki minimal 1 item revisi!'
            });
            isValid = false;
        } else {
            console.log('Found', $('.revisi-section').length, 'revisi sections'); // Debug log
        }
        @endif

        if (!isValid) {
            e.preventDefault();
            console.log('Form validation failed'); // Debug log
            Swal.fire({
                icon: 'error',
                title: 'Form Tidak Valid',
                text: 'Mohon lengkapi semua field yang wajib diisi!'
            });
        } else {
            console.log('Form validation passed, submitting...'); // Debug log
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