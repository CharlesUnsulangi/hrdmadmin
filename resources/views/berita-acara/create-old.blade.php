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
                    <a href="{{ route('berita-acara.index', ['type' => strtolower($type)]) }}" class="btn btn-secondary">
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
                                            <input type="date" class="form-control" id="date_ba" name="date_ba" value="{{ old('date_ba', date('Y-m-d')) }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="note_ba" class="form-label">Catatan BA <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="note_ba" name="note_ba" rows="4" placeholder="Masukkan catatan berita acara..." required>{{ old('note_ba') }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="pelaku_desc" class="form-label">Deskripsi Pelaku</label>
                                            <input type="text" class="form-control" id="pelaku_desc" name="pelaku_desc" value="{{ old('pelaku_desc') }}" placeholder="Deskripsi umum pelaku...">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- Type Specific Forms -->
                                @if($type === 'TEMUAN')
                                    @include('berita-acara.partials.form-temuan', ['users' => $users])
                                @elseif($type === 'LAKA')
                                    @include('berita-acara.partials.form-laka', ['trucks' => $trucks ?? [], 'drivers' => $drivers ?? []])
                                @elseif($type === 'REVISI')
                                    @include('berita-acara.partials.form-revisi')
                                @endif
                            </div>
                        </div>

                        <!-- Submit Section -->
                        <div class="row">
                            <div class="col-12">
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
    console.log('Form ready - Type:', '{{ $type }}');
    
    // Form validation
    $('#baForm').on('submit', function(e) {
        console.log('Form submission started');
        let isValid = true;
        
        // Check required fields
        $('input[required], textarea[required], select[required]').each(function() {
            if (!$(this).val().trim()) {
                $(this).addClass('is-invalid');
                isValid = false;
                console.log('Missing field:', $(this).attr('name'));
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        @if($type === 'TEMUAN')
        // Check pelaku for BA Temuan
        const pelakuCount = $('.pelaku-section').length;
        console.log('Pelaku count:', pelakuCount);
        
        if (pelakuCount === 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'BA Temuan harus memiliki minimal 1 pelaku!'
            });
            return false;
        }
        @endif

        if (!isValid) {
            e.preventDefault();
            console.log('Form validation failed');
            Swal.fire({
                icon: 'error',
                title: 'Form Tidak Valid',
                text: 'Mohon lengkapi semua field yang wajib diisi!'
            });
            return false;
        }

        // Show loading
        console.log('Form valid, showing loading...');
        Swal.fire({
            title: 'Menyimpan...',
            text: 'Sedang memproses data',
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            }
        });
    });

    // Clear validation on input
    $('input, textarea, select').on('input change', function() {
        if ($(this).val().trim()) {
            $(this).removeClass('is-invalid');
        }
    });
});
</script>
@endsection