<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th width="10%">ID</th>
                <th width="70%">Deskripsi Kejadian</th>
                <th width="20%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kejadians as $kejadian)
                <tr>
                    <td>
                        <span class="badge bg-secondary">{{ $kejadian->ms_hr_ba_kejadian_id }}</span>
                    </td>
                    <td>{{ $kejadian->ms_hr_ba_kejadian_desc }}</td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-outline-warning" 
                                    onclick="editKejadian({{ $kejadian->ms_hr_ba_kejadian_id }}, '{{ addslashes($kejadian->ms_hr_ba_kejadian_desc) }}')"
                                    title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger" 
                                    onclick="deleteKejadian({{ $kejadian->ms_hr_ba_kejadian_id }}, '{{ addslashes($kejadian->ms_hr_ba_kejadian_desc) }}')"
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

<!-- Pagination -->
@if($kejadians->hasPages())
    <div class="d-flex justify-content-center mt-3">
        {{ $kejadians->appends(request()->query())->links() }}
    </div>
@endif

<!-- Summary -->
<div class="row mt-3">
    <div class="col-md-12">
        <small class="text-muted">
            Menampilkan {{ $kejadians->firstItem() ?? 0 }} - {{ $kejadians->lastItem() ?? 0 }} 
            dari {{ $kejadians->total() }} total data
        </small>
    </div>
</div>