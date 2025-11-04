@extends('layouts.clean')

@section('title', 'Tambah Detail ' . $type)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- BA Info Summary -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-file-alt me-2"></i>Berita Acara #{{ $beritaAcara->tr_hr_ba_id }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <p><strong>Tanggal:</strong> {{ $beritaAcara->formatted_date }}</p>
                            <p><strong>Pelapor:</strong> {{ $beritaAcara->user->username ?? 'N/A' }}</p>
                            <p><strong>Kejadian:</strong> {{ $beritaAcara->note_ba }}</p>
                        </div>
                        <div class="col-md-4">
                            <div class="alert alert-info">
                                <strong>Menambahkan Detail:</strong><br>
                                <span class="badge bg-primary">{{ $type }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Form -->
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-plus me-2"></i>Tambah Detail {{ $type }}
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('berita-acara.store-details', $beritaAcara->tr_hr_ba_id) }}" 
                          method="POST" id="detailForm">
                        @csrf
                        <input type="hidden" name="type" value="{{ $type }}">

                        @if($type === 'LAKA')
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="ms_truck_id" class="form-label">
                                        <i class="fas fa-truck me-1"></i>ID Truck <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('ms_truck_id') is-invalid @enderror" 
                                           id="ms_truck_id" 
                                           name="ms_truck_id" 
                                           value="{{ old('ms_truck_id') }}" 
                                           placeholder="Masukkan ID Truck"
                                           required>
                                    @error('ms_truck_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="ms_driver_id" class="form-label">
                                        <i class="fas fa-user me-1"></i>ID Driver <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('ms_driver_id') is-invalid @enderror" 
                                           id="ms_driver_id" 
                                           name="ms_driver_id" 
                                           value="{{ old('ms_driver_id') }}" 
                                           placeholder="Masukkan ID Driver"
                                           required>
                                    @error('ms_driver_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="note_kronologi" class="form-label">
                                        <i class="fas fa-file-text me-1"></i>Kronologi Kejadian <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control @error('note_kronologi') is-invalid @enderror" 
                                              id="note_kronologi" 
                                              name="note_kronologi" 
                                              rows="4" 
                                              placeholder="Jelaskan kronologi kejadian kecelakaan secara detail..."
                                              required>{{ old('note_kronologi') }}</textarea>
                                    @error('note_kronologi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        @elseif($type === 'TEMUAN')
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Dalam Pengembangan</strong><br>
                                Form detail untuk BA Temuan sedang dikembangkan. 
                                Saat ini sistem hanya dapat menetapkan jenis BA sebagai TEMUAN.
                            </div>

                        @elseif($type === 'REVISI')
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Dalam Pengembangan</strong><br>
                                Form detail untuk BA Revisi sedang dikembangkan. 
                                Saat ini sistem hanya dapat menetapkan jenis BA sebagai REVISI.
                            </div>

                        @endif

                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('berita-acara.show', $beritaAcara->tr_hr_ba_id) }}" 
                                       class="btn btn-secondary">
                                        <i class="fas fa-arrow-left me-2"></i>Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Simpan Detail {{ $type }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('detailForm');
    
    form.addEventListener('submit', function(e) {
        const type = '{{ $type }}';
        
        if (type === 'LAKA') {
            const truckId = document.getElementById('ms_truck_id').value.trim();
            const driverId = document.getElementById('ms_driver_id').value.trim();
            const kronologi = document.getElementById('note_kronologi').value.trim();
            
            if (!truckId || !driverId || !kronologi) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Data Tidak Lengkap',
                    text: 'Mohon lengkapi semua field yang diperlukan'
                });
                return;
            }
            
            if (kronologi.length < 10) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Kronologi Terlalu Singkat',
                    text: 'Kronologi minimal 10 karakter'
                });
                return;
            }
        }
        
        // Show loading
        Swal.fire({
            title: 'Menyimpan...',
            text: 'Sedang menyimpan detail ' + type,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    });
});
</script>
@endsection