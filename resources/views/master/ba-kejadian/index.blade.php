@extends('layouts.clean')

@section('title', 'Master BA Kejadian')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>Master BA Kejadian
                    </h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="fas fa-plus me-1"></i>Tambah Kejadian
                    </button>
                </div>

                <div class="card-body">
                    <!-- Search Section -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" class="form-control" id="searchInput" 
                                       placeholder="Cari deskripsi kejadian..." value="{{ request('search') }}">
                                <button class="btn btn-outline-primary" type="button" onclick="searchData()">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-outline-secondary" type="button" onclick="clearSearch()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div id="tableContainer">
                        @include('master.ba-kejadian.table', ['kejadians' => $kejadians])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Master BA Kejadian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="createForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="ms_hr_ba_kejadian_desc" class="form-label">
                            Deskripsi Kejadian <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="ms_hr_ba_kejadian_desc" 
                               name="ms_hr_ba_kejadian_desc" maxlength="100" required
                               placeholder="Contoh: Kecelakaan Kendaraan, Kehilangan Barang, dll...">
                        <div class="form-text">Maksimal 100 karakter</div>
                        <div class="invalid-feedback" id="desc-error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Master BA Kejadian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_ms_hr_ba_kejadian_desc" class="form-label">
                            Deskripsi Kejadian <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="edit_ms_hr_ba_kejadian_desc" 
                               name="ms_hr_ba_kejadian_desc" maxlength="100" required>
                        <div class="form-text">Maksimal 100 karakter</div>
                        <div class="invalid-feedback" id="edit-desc-error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save me-1"></i>Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Create form handler
    $('#createForm').on('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        $.ajax({
            url: '{{ route("ms-hr-ba-kejadian.store") }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    $('#createModal').modal('hide');
                    $('#createForm')[0].reset();
                    $('.form-control').removeClass('is-invalid');
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 3000,
                        showConfirmButton: false
                    });
                    
                    loadTable();
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    $('.form-control').removeClass('is-invalid');
                    
                    if (errors.ms_hr_ba_kejadian_desc) {
                        $('#ms_hr_ba_kejadian_desc').addClass('is-invalid');
                        $('#desc-error').text(errors.ms_hr_ba_kejadian_desc[0]);
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: xhr.responseJSON?.message || 'Terjadi kesalahan'
                    });
                }
            }
        });
    });
    
    // Edit form handler
    $('#editForm').on('submit', function(e) {
        e.preventDefault();
        
        const id = $('#edit_id').val();
        const formData = new FormData(this);
        
        $.ajax({
            url: `/ms-hr-ba-kejadian/${id}`,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    $('#editModal').modal('hide');
                    $('.form-control').removeClass('is-invalid');
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 3000,
                        showConfirmButton: false
                    });
                    
                    loadTable();
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    $('.form-control').removeClass('is-invalid');
                    
                    if (errors.ms_hr_ba_kejadian_desc) {
                        $('#edit_ms_hr_ba_kejadian_desc').addClass('is-invalid');
                        $('#edit-desc-error').text(errors.ms_hr_ba_kejadian_desc[0]);
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: xhr.responseJSON?.message || 'Terjadi kesalahan'
                    });
                }
            }
        });
    });
});

function searchData() {
    loadTable();
}

function clearSearch() {
    $('#searchInput').val('');
    loadTable();
}

function loadTable() {
    const search = $('#searchInput').val();
    
    $.ajax({
        url: '{{ route("ms-hr-ba-kejadian.index") }}',
        method: 'GET',
        data: { search: search },
        success: function(response) {
            $('#tableContainer').html(response);
        },
        error: function(xhr) {
            console.error('Error loading table:', xhr);
        }
    });
}

function editKejadian(id, desc) {
    $('#edit_id').val(id);
    $('#edit_ms_hr_ba_kejadian_desc').val(desc);
    $('.form-control').removeClass('is-invalid');
    $('#editModal').modal('show');
}

function deleteKejadian(id, desc) {
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
            $.ajax({
                url: `/ms-hr-ba-kejadian/${id}`,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            timer: 3000,
                            showConfirmButton: false
                        });
                        
                        loadTable();
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: xhr.responseJSON?.message || 'Terjadi kesalahan'
                    });
                }
            });
        }
    });
}
</script>
@endsection