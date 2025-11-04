@extends('layouts.clean')

@section('title', 'Buat Berita Acara Baru')

@section('content')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Buat Berita Acara Baru
                    </h5>
                </div>

                <div class="card-body">
                    <div class="alert alert-info mb-4">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Langkah 1 dari 2:</strong> Isi informasi dasar kejadian. 
                        Jenis BA dan detail spesifik akan ditentukan pada langkah berikutnya.
                    </div>

                    <form action="{{ route('berita-acara.store') }}" method="POST" id="baForm">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="date_ba" class="form-label">
                                    <i class="fas fa-calendar me-1"></i>Tanggal Kejadian <span class="text-danger">*</span>
                                </label>
                                <input type="date" 
                                       class="form-control @error('date_ba') is-invalid @enderror" 
                                       id="date_ba" 
                                       name="date_ba" 
                                       value="{{ old('date_ba', date('Y-m-d')) }}" 
                                       required>
                                @error('date_ba')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="pelapor" class="form-label">
                                    <i class="fas fa-user me-1"></i>Pelapor
                                </label>
                                <input type="text" class="form-control" id="pelapor" 
                                       value="{{ Auth::user()->username }}" readonly>
                                <small class="form-text text-muted">Otomatis diisi dari user yang login</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="note_ba" class="form-label">
                                <i class="fas fa-file-text me-1"></i>Nama Kejadian <span class="text-danger">*</span>
                            </label>
                            <select class="form-control select2-kejadian @error('note_ba') is-invalid @enderror" 
                                    id="note_ba" 
                                    name="note_ba" 
                                    required
                                    style="width: 100%;">
                                <option value="">-- Pilih atau Ketik Nama Kejadian --</option>
                                @foreach($masterKejadian as $kejadian)
                                    <option value="{{ $kejadian->ms_hr_ba_kejadian_desc }}" 
                                            {{ old('note_ba') == $kejadian->ms_hr_ba_kejadian_desc ? 'selected' : '' }}>
                                        {{ $kejadian->ms_hr_ba_kejadian_desc }}
                                    </option>
                                @endforeach
                            </select>
                            @error('note_ba')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Pilih dari daftar atau ketik untuk mencari kejadian yang sesuai</small>
                        </div>

                        <div class="mb-3">
                            <label for="kronologi" class="form-label">
                                <i class="fas fa-list-ol me-1"></i>Kronologi Kejadian <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('kronologi') is-invalid @enderror" 
                                      id="kronologi" 
                                      name="kronologi" 
                                      rows="6" 
                                      placeholder="Jelaskan secara detail kronologi kejadian dari awal sampai akhir...&#10;&#10;Contoh:&#10;- Jam 08:00: Driver berangkat dari depot&#10;- Jam 10:30: Terjadi kecelakaan di persimpangan&#10;- Jam 11:00: Pelaporan ke kantor pusat&#10;- dll..." 
                                      required>{{ old('kronologi') }}</textarea>
                            @error('kronologi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Ceritakan urutan kejadian secara lengkap dan detail</small>
                        </div>

                        <div class="mb-4">
                            <label for="pelaku_desc" class="form-label">
                                <i class="fas fa-users me-1"></i>Keterangan Pelaku/Objek (Opsional)
                            </label>
                            <input type="text" 
                                   class="form-control @error('pelaku_desc') is-invalid @enderror" 
                                   id="pelaku_desc" 
                                   name="pelaku_desc" 
                                   value="{{ old('pelaku_desc') }}" 
                                   placeholder="Keterangan umum tentang pelaku atau objek yang terlibat...">
                            @error('pelaku_desc')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Detail spesifik akan ditambahkan pada langkah berikutnya sesuai jenis BA
                            </small>
                        </div>

                        <hr>

                        <!-- Submit Section -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('berita-acara.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-arrow-right me-2"></i>Lanjut ke Langkah 2
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Select2 untuk nama kejadian
    $('.select2-kejadian').select2({
        theme: 'bootstrap-5',
        placeholder: '-- Pilih atau Ketik Nama Kejadian --',
        allowClear: true,
        tags: true, // Allow creating new tags
        createTag: function (params) {
            const term = params.term.trim();
            
            if (term === '') {
                return null;
            }
            
            // Only allow creating new tags if no exact match exists
            const options = $('.select2-kejadian option');
            let exactMatch = false;
            
            options.each(function() {
                if (this.text.toLowerCase() === term.toLowerCase()) {
                    exactMatch = true;
                    return false;
                }
            });
            
            if (!exactMatch && term.length >= 5) {
                return {
                    id: term,
                    text: term + ' (Baru)',
                    newTag: true
                };
            }
            
            return null;
        },
        templateResult: function (data) {
            if (data.loading) {
                return data.text;
            }
            
            if (data.newTag) {
                return $('<span><i class="fas fa-plus-circle me-2"></i>' + data.text + '</span>');
            }
            
            return data.text;
        }
    });

    const form = document.getElementById('baForm');
    
    form.addEventListener('submit', function(e) {
        const noteBA = document.getElementById('note_ba').value.trim();
        const kronologi = document.getElementById('kronologi').value.trim();
        
        if (!noteBA || !kronologi) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Data Tidak Lengkap',
                text: 'Mohon lengkapi Nama Kejadian dan Kronologi'
            });
            return;
        }
        
        if (noteBA.length < 5) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Nama Kejadian Terlalu Singkat',
                text: 'Nama kejadian minimal 5 karakter'
            });
            return;
        }
        
        if (kronologi.length < 20) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Kronologi Terlalu Singkat',
                text: 'Kronologi minimal 20 karakter'
            });
            return;
        }
        
        // Show loading
        Swal.fire({
            title: 'Menyimpan...',
            text: 'Sedang menyimpan Berita Acara',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    });
});
</script>
@endsection