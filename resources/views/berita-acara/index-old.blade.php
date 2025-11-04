@extends('layouts.clean')

@section('title', 'Berita Acara Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Main Content -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-file-alt me-2"></i>Berita Acara Management
                    </h5>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fas fa-plus me-1"></i>Buat BA Baru
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('berita-acara.create', ['type' => 'TEMUAN']) }}">
                                <i class="fas fa-search me-2"></i>BA Temuan
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('berita-acara.create', ['type' => 'LAKA']) }}">
                                <i class="fas fa-car-crash me-2"></i>BA Laka
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('berita-acara.create', ['type' => 'REVISI']) }}">
                                <i class="fas fa-edit me-2"></i>BA Revisi
                            </a></li>
                        </ul>
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
                                           placeholder="Cari catatan, pelaku..." value="{{ request('search') }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="date_from" class="form-label">Tanggal Dari</label>
                                    <input type="date" class="form-control" id="date_from" name="date_from" 
                                           value="{{ request('date_from') }}">
                                </div>
                                <div class="col-md-3">
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

                    <!-- Tabs Navigation -->
                    <ul class="nav nav-tabs mb-3" id="baTypeTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $type === 'TEMUAN' ? 'active' : '' }}" 
                               href="{{ route('berita-acara.index', ['type' => 'TEMUAN']) }}">
                                <i class="fas fa-search me-2"></i>BA Temuan
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $type === 'LAKA' ? 'active' : '' }}" 
                               href="{{ route('berita-acara.index', ['type' => 'LAKA']) }}">
                                <i class="fas fa-car-crash me-2"></i>BA Laka
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $type === 'REVISI' ? 'active' : '' }}" 
                               href="{{ route('berita-acara.index', ['type' => 'REVISI']) }}">
                                <i class="fas fa-edit me-2"></i>BA Revisi
                            </a>
                        </li>
                    </ul>

                    <!-- Tab Content - Simplified -->
                    <div class="tab-content" id="baTypeTabContent">
                        <div class="tab-pane fade show active" id="current-tab" role="tabpanel">
                            @include('berita-acara.partials.table', ['beritaAcaras' => $beritaAcaras, 'type' => $type, 'user' => $user])
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

@section('scripts')
<script>
$(document).ready(function() {
    // Filter form handler
    $('#filterForm').on('submit', function(e) {
        e.preventDefault();
        const formData = $(this).serialize();
        const currentType = '{{ $type }}';
        const url = `{{ route('berita-acara.index') }}?type=${currentType}&${formData}`;
        window.location.href = url;
    });
    
    // Clear filter function
    window.clearFilter = function() {
        $('#search').val('');
        $('#date_from').val('');
        $('#date_to').val('');
        const currentType = '{{ $type }}';
        window.location.href = `{{ route('berita-acara.index') }}?type=${currentType}`;
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