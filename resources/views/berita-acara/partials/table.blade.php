<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th width="5%">No</th>
                <th width="15%">Tanggal</th>
                <th width="15%">User</th>
                <th width="25%">Catatan</th>
                @if($type === 'TEMUAN')
                    <th width="15%">Pelaku</th>
                    <th width="15%">Pelanggaran</th>
                @elseif($type === 'LAKA')
                    <th width="15%">Truck</th>
                    <th width="15%">Driver</th>
                @elseif($type === 'REVISI')
                    <th width="15%">Field</th>
                    <th width="15%">Revisi Items</th>
                @endif
                <th width="10%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($beritaAcaras as $index => $ba)
                <tr>
                    <td>{{ $beritaAcaras->firstItem() + $index }}</td>
                    <td>
                        <span class="badge bg-info text-dark">
                            {{ $ba->formatted_date }}
                        </span>
                    </td>
                    <td>
                        <strong>{{ $ba->user->nama ?? 'N/A' }}</strong>
                        <br>
                        <small class="text-muted">{{ $ba->user->role ?? 'N/A' }}</small>
                    </td>
                    <td>
                        <div class="text-wrap">
                            {{ Str::limit($ba->note_ba, 100) }}
                        </div>
                        @if($ba->pelaku_desc)
                            <small class="text-muted">
                                <i class="fas fa-user me-1"></i>{{ $ba->pelaku_desc }}
                            </small>
                        @endif
                    </td>
                    
                    @if($type === 'TEMUAN')
                        <td>
                            {{-- Disabled until tr_hr_ba_pelaku table exists
                            @if($ba->pelaku->count() > 0)
                                @foreach($ba->pelaku as $pelaku)
                                    <div class="mb-1">
                                        <span class="badge bg-warning text-dark">
                                            {{ $pelaku->user->nama ?? 'N/A' }}
                                        </span>
                                    </div>
                                @endforeach
                            @else --}}
                                <span class="text-muted">Pending tabel pelaku</span>
                            {{-- @endif --}}
                        </td>
                        <td>
                            {{-- Disabled until tr_hr_ba_pelaku table exists
                            @if($ba->pelaku->count() > 0)
                                @foreach($ba->pelaku as $pelaku)
                                    <div class="mb-1">
                                        <small class="text-muted">{{ $pelaku->violation_types ?: '-' }}</small>
                                    </div>
                                @endforeach
                            @else --}}
                                <span class="text-muted">-</span>
                            {{-- @endif --}}
                        </td>
                    @elseif($type === 'LAKA')
                        <td>
                            @if($ba->laka)
                                <span class="badge bg-secondary">
                                    {{ $ba->laka->ms_truck_id }}
                                </span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($ba->laka)
                                <span class="badge bg-secondary">
                                    {{ $ba->laka->ms_driver_id }}
                                </span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    @elseif($type === 'REVISI')
                        <td>
                            {{-- Disabled until tr_hr_ba_revisi table exists
                            @if($ba->revisi->count() > 0)
                                @foreach($ba->revisi->take(2) as $revisi)
                                    <div class="mb-1">
                                        <span class="badge bg-primary">{{ $revisi->field }}</span>
                                    </div>
                                @endforeach
                                @if($ba->revisi->count() > 2)
                                    <small class="text-muted">+{{ $ba->revisi->count() - 2 }} lainnya</small>
                                @endif
                            @else --}}
                                <span class="text-muted">Pending tabel revisi</span>
                            {{-- @endif --}}
                        </td>
                        <td>
                            {{-- Disabled until tr_hr_ba_revisi table exists
                            @if($ba->revisi->count() > 0)
                                <span class="badge bg-info">
                                    {{ $ba->revisi->count() }} item{{ $ba->revisi->count() > 1 ? 's' : '' }}
                                </span>
                            @else --}}
                                <span class="text-muted">-</span>
                            {{-- @endif --}}
                        </td>
                    @endif
                    
                    <td>
                        <div class="btn-group btn-group-sm" role="group">
                            <!-- View Button - Available for all users -->
                            <a href="{{ route('berita-acara.show', $ba->tr_hr_ba_id) }}" 
                               class="btn btn-outline-info" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            
                            <!-- Edit & Delete - Only for Admin/HR -->
                            @if($user->role === 'ADMIN' || $user->role === 'HR')
                                <a href="{{ route('berita-acara.edit', $ba->tr_hr_ba_id) }}" 
                                   class="btn btn-outline-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <form action="{{ route('berita-acara.destroy', $ba->tr_hr_ba_id) }}" 
                                      method="POST" class="delete-form d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-outline-danger btn-delete" 
                                            data-id="{{ $ba->tr_hr_ba_id }}" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $type === 'TEMUAN' ? '7' : ($type === 'LAKA' ? '7' : '7') }}" class="text-center py-4">
                        <div class="d-flex flex-column align-items-center">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Tidak ada data {{ $type === 'TEMUAN' ? 'BA Temuan' : ($type === 'LAKA' ? 'BA Laka' : 'BA Revisi') }}</h5>
                            <p class="text-muted">Belum ada berita acara yang dibuat untuk kategori ini.</p>
                            <a href="{{ route('berita-acara.create', ['type' => $type]) }}" 
                               class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Buat {{ $type === 'TEMUAN' ? 'BA Temuan' : ($type === 'LAKA' ? 'BA Laka' : 'BA Revisi') }} Pertama
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
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div class="text-muted small">
            Menampilkan {{ $beritaAcaras->firstItem() }} - {{ $beritaAcaras->lastItem() }} 
            dari {{ $beritaAcaras->total() }} data
        </div>
        <div>
            {{ $beritaAcaras->withQueryString()->links() }}
        </div>
    </div>
@endif