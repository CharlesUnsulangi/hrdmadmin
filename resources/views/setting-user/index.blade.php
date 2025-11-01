@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0">
            <i class="bi bi-person-gear me-2 text-primary"></i>
            Management User
        </h2>
    </div>

    <!-- Search and Add Button -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <form method="GET" action="{{ route('setting-user.index') }}" class="d-flex">
                        <input type="text" name="search" class="form-control me-2" 
                               placeholder="Cari berdasarkan username, email, atau role..." 
                               value="{{ request('search') }}">
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="bi bi-search"></i> Cari
                        </button>
                        @if(request('search'))
                            <a href="{{ route('setting-user.index') }}" class="btn btn-outline-secondary ms-2">
                                <i class="bi bi-x-circle"></i> Reset
                            </a>
                        @endif
                    </form>
                </div>
                <div class="col-md-4 text-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="bi bi-plus-circle me-1"></i> Tambah User
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                Daftar User ({{ $users->total() }} user)
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Username</th>
                            <th width="25%">Email</th>
                            <th width="15%">Role</th>
                            <th width="10%">Status</th>
                            <th width="15%">Dibuat</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                            <tr>
                                <td>{{ $users->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ $user->username }}</strong>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $user->role }}</span>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input status-toggle" type="checkbox" 
                                               data-user-id="{{ $user->id }}"
                                               {{ $user->is_active == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label">
                                            <span class="status-text">{{ $user->is_active == 1 ? 'Aktif' : 'Non-Aktif' }}</span>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <small>{{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : '-' }}</small>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-outline-warning edit-user" 
                                                data-user-id="{{ $user->id }}"
                                                data-username="{{ $user->username }}"
                                                data-email="{{ $user->email }}"
                                                data-role="{{ $user->role }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-user" 
                                                data-user-id="{{ $user->id }}"
                                                data-username="{{ $user->username }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="bi bi-inbox fs-1"></i>
                                        <p class="mt-2">Tidak ada data user ditemukan</p>
                                        @if(request('search'))
                                            <p><small>Coba dengan kata kunci lain atau <a href="{{ route('setting-user.index') }}">reset pencarian</a></small></p>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($users->hasPages())
            <div class="card-footer">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">
                    <i class="bi bi-plus-circle me-2"></i>Tambah User Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addUserForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="add_username" class="form-label">Username *</label>
                        <input type="text" class="form-control" id="add_username" name="username" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="add_email" class="form-label">Email *</label>
                        <input type="email" class="form-control" id="add_email" name="email" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="add_password" class="form-label">Password *</label>
                        <input type="password" class="form-control" id="add_password" name="password" required>
                        <div class="invalid-feedback"></div>
                        <small class="text-muted">Minimal 8 karakter</small>
                    </div>
                    <div class="mb-3">
                        <label for="add_role" class="form-label">Role *</label>
                        <select class="form-select" id="add_role" name="role" required>
                            <option value="">Pilih Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->role_name }}">{{ $role->role_name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">
                    <i class="bi bi-pencil me-2"></i>Edit User
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editUserForm">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_user_id" name="user_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_username" class="form-label">Username *</label>
                        <input type="text" class="form-control" id="edit_username" name="username" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email *</label>
                        <input type="email" class="form-control" id="edit_email" name="email" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="edit_password" name="password">
                        <div class="invalid-feedback"></div>
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                    </div>
                    <div class="mb-3">
                        <label for="edit_role" class="form-label">Role *</label>
                        <select class="form-select" id="edit_role" name="role" required>
                            <option value="">Pilih Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->role_name }}">{{ $role->role_name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-save me-1"></i>Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteUserModalLabel">
                    <i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus user <strong id="delete_username"></strong>?</p>
                <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan!</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                    <i class="bi bi-trash me-1"></i>Hapus
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Add User Form Submit
    $('#addUserForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '{{ route("setting-user.store") }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    $('#addUserModal').modal('hide');
                    Swal.fire({
                        title: 'Berhasil!',
                        text: response.message,
                        icon: 'success'
                    }).then(() => {
                        location.reload();
                    });
                }
            },
            error: function(xhr) {
                handleFormErrors('#addUserForm', xhr.responseJSON.errors);
            }
        });
    });

    // Edit User Modal
    $('.edit-user').on('click', function() {
        const userId = $(this).data('user-id');
        const username = $(this).data('username');
        const email = $(this).data('email');
        const role = $(this).data('role');

        $('#edit_user_id').val(userId);
        $('#edit_username').val(username);
        $('#edit_email').val(email);
        $('#edit_role').val(role);
        $('#edit_password').val('');

        $('#editUserModal').modal('show');
    });

    // Edit User Form Submit
    $('#editUserForm').on('submit', function(e) {
        e.preventDefault();
        
        const userId = $('#edit_user_id').val();
        
        $.ajax({
            url: `/setting-user/${userId}`,
            method: 'PUT',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    $('#editUserModal').modal('hide');
                    Swal.fire({
                        title: 'Berhasil!',
                        text: response.message,
                        icon: 'success'
                    }).then(() => {
                        location.reload();
                    });
                }
            },
            error: function(xhr) {
                handleFormErrors('#editUserForm', xhr.responseJSON.errors);
            }
        });
    });

    // Delete User Modal
    $('.delete-user').on('click', function() {
        const userId = $(this).data('user-id');
        const username = $(this).data('username');

        $('#delete_username').text(username);
        $('#deleteUserModal').modal('show');

        $('#confirmDeleteBtn').off('click').on('click', function() {
            $.ajax({
                url: `/setting-user/${userId}`,
                method: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        $('#deleteUserModal').modal('hide');
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message,
                            icon: 'success'
                        }).then(() => {
                            location.reload();
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Error!',
                        text: xhr.responseJSON.message,
                        icon: 'error'
                    });
                }
            });
        });
    });

    // Toggle Status
    $('.status-toggle').on('change', function() {
        const userId = $(this).data('user-id');
        const toggle = $(this);
        const statusText = toggle.closest('td').find('.status-text');

        $.ajax({
            url: `/setting-user/${userId}/toggle-status`,
            method: 'PATCH',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    statusText.text(response.is_active ? 'Aktif' : 'Non-Aktif');
                    
                    Swal.fire({
                        title: 'Berhasil!',
                        text: response.message,
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            },
            error: function(xhr) {
                // Revert toggle if error
                toggle.prop('checked', !toggle.prop('checked'));
                
                Swal.fire({
                    title: 'Error!',
                    text: xhr.responseJSON.message,
                    icon: 'error'
                });
            }
        });
    });

    // Handle form errors
    function handleFormErrors(formSelector, errors) {
        // Clear previous errors
        $(formSelector).find('.is-invalid').removeClass('is-invalid');
        $(formSelector).find('.invalid-feedback').text('');

        // Display new errors
        $.each(errors, function(field, messages) {
            const input = $(formSelector).find(`[name="${field}"]`);
            input.addClass('is-invalid');
            input.siblings('.invalid-feedback').text(messages[0]);
        });
    }

    // Clear form errors when modal is hidden
    $('.modal').on('hidden.bs.modal', function() {
        const form = $(this).find('form');
        form[0].reset();
        form.find('.is-invalid').removeClass('is-invalid');
        form.find('.invalid-feedback').text('');
    });
});
</script>
@endpush
@endsection