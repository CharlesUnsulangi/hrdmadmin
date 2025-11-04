@extends('layouts.clean')

@section('title', 'Buat Berita Acara')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-plus me-2"></i>Buat Berita Acara Baru
                    </h5>
                    <a href="{{ route('berita-acara.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>

                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Langkah 1:</strong> Buat berita acara dasar terlebih dahulu. Setelah tersimpan, Anda dapat menentukan jenis (Temuan/Laka/Revisi) dan menambahkan detail spesifik.
                    </div>

                    <form action="{{ route('berita-acara.store') }}" method="POST" id="baForm">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border-primary">
                                    <div class="card-header bg-primary text-white">
                                        <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Berita Acara</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="date_ba" class="form-label">Tanggal Kejadian <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="date_ba" name="date_ba" 
                                                       value="{{ old('date_ba', date('Y-m-d')) }}" required>
                                                @error('date_ba')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="pelapor" class="form-label">Pelapor</label>
                                                <input type="text" class="form-control" id="pelapor" 
                                                       value="{{ Auth::user()->username }}" readonly>
                                                <small class="form-text text-muted">Otomatis diisi dari user yang login</small>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="note_ba" class="form-label">Deskripsi Kejadian <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="note_ba" name="note_ba" rows="4" 
                                                      placeholder="Jelaskan secara detail kejadian yang terjadi..." required>{{ old('note_ba') }}</textarea>
                                            @error('note_ba')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="pelaku_desc" class="form-label">Keterangan Pelaku/Objek (Opsional)</label>
                                            <input type="text" class="form-control" id="pelaku_desc" name="pelaku_desc" 
                                                   value="{{ old('pelaku_desc') }}" placeholder="Keterangan umum tentang pelaku atau objek yang terlibat...">
                                            <small class="form-text text-muted">
                                                Detail spesifik akan ditambahkan pada langkah berikutnya
                                            </small>
                                            @error('pelaku_desc')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Section -->
                        <div class="row mt-4">
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
    console.log('BA Create Form ready');
    
    // Form validation
    $('#baForm').on('submit', function(e) {
        console.log('Form submission started');
        let isValid = true;
        
        // Check required fields
        $('input[required], textarea[required]').each(function() {
            if (!$(this).val().trim()) {
                $(this).addClass('is-invalid');
                isValid = false;
                console.log('Missing field:', $(this).attr('name'));
            } else {
                $(this).removeClass('is-invalid');
            }
        });

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
            text: 'Sedang memproses data berita acara',
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            }
        });
    });

    // Clear validation on input
    $('input, textarea').on('input change', function() {
        if ($(this).val().trim()) {
            $(this).removeClass('is-invalid');
        }
    });
});
</script>
@endsection