@extends('layouts.clean')

@section('title', 'Berita Acara')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Main Content -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-file-alt me-2"></i>Daftar Berita Acara
                    </h5>
                    <div>
                        <a href="{{ route('berita-acara.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Buat BA Baru
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <form id="filterForm" class="row g-3">
                                <div class="col-md-3">
                                    <label for="search" class="form-label">Pencarian</label>
                                    <input type="text" class="form-control" id="search" name="search" 
                                           placeholder="Cari dalam catatan..." value="{{ request('search') }}">
                                </div>
                                <div class="col-md-2">
                                    <label for="type_filter" class="form-label">Jenis BA</label>
                                    <select class="form-control" id="type_filter" name="type_filter">
                                        <option value="">Semua Jenis</option>
                                        <option value="TEMUAN" {{ request('type_filter') === 'TEMUAN' ? 'selected' : '' }}>BA Temuan</option>
                                        <option value="LAKA" {{ request('type_filter') === 'LAKA' ? 'selected' : '' }}>BA Laka</option>
                                        <option value="REVISI" {{ request('type_filter') === 'REVISI' ? 'selected' : '' }}>BA Revisi</option>
                                        <option value="GENERAL" {{ request('type_filter') === 'GENERAL' ? 'selected' : '' }}>Belum Ditentukan</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="date_from" class="form-label">Tanggal Dari</label>
                                    <input type="date" class="form-control" id="date_from" name="date_from" 
                                           value="{{ request('date_from') }}">
                                </div>
                                <div class="col-md-2">
                                    <label for="date_to" class="form-label">Tanggal Sampai</label>
                                    <input type="date" class="form-control" id="date_to" name="date_to" 
                                           value="{{ request('date_to') }}">
                                </div>
                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-outline-primary me-2">
                                        <i class="fas fa-search"></i> Filter
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary" onclick="clearFilter()">
                                        <i class="fas fa-times"></i> Reset
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- BA Table -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th width="8%">ID BA</th>
                                    <th width="12%">Tanggal</th>
                                    <th width="15%">Pelapor</th>
                                    <th width="12%">Jenis</th>
                                    <th width="35%">Nama Kejadian</th>
                                    <th width="18%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($beritaAcaras as $ba)
                                    <tr>
                                        <td>
                                            <span class="badge bg-secondary">{{ $ba->tr_hr_ba_id }}</span>
                                        </td>
                                        <td>{{ $ba->formatted_date }}</td>
                                        <td>{{ $ba->user->username ?? 'N/A' }}</td>
                                        <td>
                                            @if($ba->ms_hr_ba_type_id)
                                                @if($ba->ms_hr_ba_type_id === 'TEMUAN')
                                                    <span class="badge bg-warning">
                                                        <i class="fas fa-search me-1"></i>Temuan
                                                    </span>
                                                @elseif($ba->ms_hr_ba_type_id === 'LAKA')
                                                    <span class="badge bg-danger">
                                                        <i class="fas fa-car-crash me-1"></i>Laka
                                                    </span>
                                                @elseif($ba->ms_hr_ba_type_id === 'REVISI')
                                                    <span class="badge bg-info">
                                                        <i class="fas fa-edit me-1"></i>Revisi
                                                    </span>
                                                @endif
                                            @else
                                                <span class="badge bg-light text-dark">
                                                    <i class="fas fa-clock me-1"></i>Belum Ditentukan
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 300px;">
                                                {{ $ba->note_ba }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('berita-acara.show', $ba->tr_hr_ba_id) }}" 
                                                   class="btn btn-outline-primary" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                
                                                @if(Auth::user()->role === 'ADMIN' || Auth::user()->role === 'HR')
                                                    <a href="{{ route('berita-acara.edit', $ba->tr_hr_ba_id) }}" 
                                                       class="btn btn-outline-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    
                                                    <form action="{{ route('berita-acara.destroy', $ba->tr_hr_ba_id) }}" 
                                                          method="POST" class="delete-form d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-delete" 
                                                                title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fas fa-file-alt text-muted mb-2" style="font-size: 3rem;"></i>
                                                <h6 class="text-muted">Belum ada Berita Acara</h6>
                                                <p class="text-muted small">Mulai dengan membuat BA baru</p>
                                                <a href="{{ route('berita-acara.create') }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-plus me-1"></i>Buat BA Pertama
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($beritaAcaras->hasPages())
                        <div class="d-flex justify-content-center mt-3">
                            {{ $beritaAcaras->appends(request()->query())->links() }}
                        </div>
                    @endif

                    <!-- Summary -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <small class="text-muted">
                                Menampilkan {{ $beritaAcaras->firstItem() ?? 0 }} - {{ $beritaAcaras->lastItem() ?? 0 }} 
                                dari {{ $beritaAcaras->total() }} total Berita Acara
                            </small>
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

@if(session('warning'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan!',
            text: '{{ session('warning') }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif

@if(session('info'))
    <script>
        Swal.fire({
            icon: 'info',
            title: 'Info',
            text: '{{ session('info') }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Filter form handler
    $('#filterForm').on('submit', function(e) {
        e.preventDefault();
        const formData = $(this).serialize();
        const url = `{{ route('berita-acara.index') }}?${formData}`;
        window.location.href = url;
    });
    
    // Clear filter function
    window.clearFilter = function() {
        $('#search').val('');
        $('#type_filter').val('');
        $('#date_from').val('');
        $('#date_to').val('');
        window.location.href = `{{ route('berita-acara.index') }}`;
    }
    
    // Delete confirmation
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        const form = $(this).closest('.delete-form');
        
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus Berita Acara ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
@endsection