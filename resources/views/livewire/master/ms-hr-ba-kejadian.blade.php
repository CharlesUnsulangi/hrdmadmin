<div>
    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Form -->
    <div class="card mb-4">
        <div class="card-header">
            <h6 class="mb-0">
                <i class="fas fa-{{ $edit_id ? 'edit' : 'plus' }} me-2"></i>
                {{ $edit_id ? 'Edit' : 'Tambah' }} Master BA Kejadian
            </h6>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $edit_id ? 'update' : 'store' }}">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="ms_hr_ba_kejadian_desc" class="form-label">
                                Deskripsi Kejadian <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('ms_hr_ba_kejadian_desc') is-invalid @enderror" 
                                   id="ms_hr_ba_kejadian_desc"
                                   wire:model="ms_hr_ba_kejadian_desc" 
                                   placeholder="Contoh: Kecelakaan Kendaraan, Kehilangan Barang, dll..."
                                   maxlength="100">
                            @error('ms_hr_ba_kejadian_desc')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Maksimal 100 karakter</div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <div class="mb-3 w-100">
                            <button type="submit" class="btn btn-{{ $edit_id ? 'warning' : 'primary' }} me-2">
                                <i class="fas fa-{{ $edit_id ? 'save' : 'plus' }} me-1"></i>
                                {{ $edit_id ? 'Update' : 'Tambah' }}
                            </button>
                            @if($edit_id)
                                <button type="button" class="btn btn-secondary" wire:click="resetForm">
                                    <i class="fas fa-times me-1"></i>Batal
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="card">
        <div class="card-header">
            <h6 class="mb-0">
                <i class="fas fa-list me-2"></i>Daftar Master BA Kejadian
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th width="15%">ID</th>
                            <th width="65%">Deskripsi Kejadian</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $item)
                            <tr>
                                <td>
                                    <span class="badge bg-secondary">{{ $item->ms_hr_ba_kejadian_id }}</span>
                                </td>
                                <td>{{ $item->ms_hr_ba_kejadian_desc }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" 
                                                class="btn btn-outline-warning" 
                                                wire:click="edit({{ $item->ms_hr_ba_kejadian_id }})"
                                                title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" 
                                                class="btn btn-outline-danger" 
                                                onclick="confirmDelete({{ $item->ms_hr_ba_kejadian_id }}, '{{ addslashes($item->ms_hr_ba_kejadian_desc) }}')"
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-list text-muted mb-2" style="font-size: 3rem;"></i>
                                        <h6 class="text-muted">Belum ada data Master BA Kejadian</h6>
                                        <p class="text-muted small">Mulai dengan menambahkan data baru</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function confirmDelete(id, desc) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: `Apakah Anda yakin ingin menghapus "${desc}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            @this.call('delete', id);
        }
    });
}
</script>
@endpush