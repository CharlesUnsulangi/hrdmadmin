<div class="row">
    <div class="col-md-12">
        <div class="card border-success">
            <div class="card-header bg-success text-white">
                <h6 class="mb-0"><i class="fas fa-edit me-2"></i>Data Revisi BA Revisi</h6>
            </div>
            <div class="card-body">
                @if($beritaAcara->revisi->count() > 0)
                    @foreach($beritaAcara->revisi as $index => $revisi)
                        <div class="revisi-item border rounded p-3 mb-3" style="background-color: #d1e7dd;">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0 text-success">
                                    <i class="fas fa-file-alt me-2"></i>Item Revisi {{ $index + 1 }}
                                </h6>
                                <span class="badge bg-success">{{ $revisi->field }}</span>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td width="40%"><strong>Field Name:</strong></td>
                                            <td>{{ $revisi->field }}</td>
                                        </tr>
                                        @if($revisi->database_name)
                                            <tr>
                                                <td><strong>Database:</strong></td>
                                                <td>{{ $revisi->database_name }}</td>
                                            </tr>
                                        @endif
                                        @if($revisi->field_name)
                                            <tr>
                                                <td><strong>Field DB:</strong></td>
                                                <td>{{ $revisi->field_name }}</td>
                                            </tr>
                                        @endif
                                        @if($revisi->migrasi_time)
                                            <tr>
                                                <td><strong>Migrasi Time:</strong></td>
                                                <td>{{ $revisi->migrasi_time->format('d/m/Y H:i') }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td><strong>User Revisi:</strong></td>
                                            <td>{{ $revisi->user->nama ?? 'N/A' }}</td>
                                        </tr>
                                    </table>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <strong>Perbandingan Data:</strong>
                                        <div class="row mt-2">
                                            <div class="col-6">
                                                <div class="p-2 bg-danger bg-opacity-25 rounded">
                                                    <small class="text-muted">Sebelum (Salah):</small>
                                                    <div class="fw-bold">{{ $revisi->comparison['before'] ?: '-' }}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="p-2 bg-success bg-opacity-25 rounded">
                                                    <small class="text-muted">Sesudah (Benar):</small>
                                                    <div class="fw-bold">{{ $revisi->comparison['after'] ?: '-' }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <strong>Alasan Revisi:</strong>
                                        <div class="mt-2 p-2 bg-light rounded">
                                            {{ $revisi->reason_desc }}
                                        </div>
                                    </div>
                                    
                                    @if($revisi->query_id)
                                        <div class="mb-3">
                                            <strong>Query ID:</strong>
                                            <div class="mt-2 p-2 bg-dark text-white rounded" style="font-family: monospace; font-size: 0.9em;">
                                                {{ $revisi->query_id }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Tidak ada data revisi untuk BA Revisi ini.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>