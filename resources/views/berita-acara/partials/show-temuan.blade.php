<div class="row">
    <div class="col-md-12">
        <div class="card border-warning">
            <div class="card-header bg-warning text-dark">
                <h6 class="mb-0"><i class="fas fa-users me-2"></i>Data Pelaku BA Temuan</h6>
            </div>
            <div class="card-body">
                @if($beritaAcara->pelaku->count() > 0)
                    @foreach($beritaAcara->pelaku as $index => $pelaku)
                        <div class="pelaku-item border rounded p-3 mb-3" style="background-color: #fff3cd;">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0 text-warning">
                                    <i class="fas fa-user me-2"></i>Pelaku {{ $index + 1 }}
                                </h6>
                                <span class="badge bg-warning text-dark">{{ $pelaku->ms_type_ba_pelaku_id }}</span>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td width="40%"><strong>Nama Pelaku:</strong></td>
                                            <td>{{ $pelaku->user->nama ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Role:</strong></td>
                                            <td>{{ $pelaku->user->role ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tanggal Kejadian:</strong></td>
                                            <td>{{ $pelaku->formatted_date }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Type Pelaku:</strong></td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $pelaku->ms_type_ba_pelaku_id }}</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <strong>Text BA:</strong>
                                        <div class="mt-2 p-2 bg-light rounded">
                                            {{ $pelaku->text_ba }}
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <strong>Jenis Pelanggaran:</strong>
                                        <div class="mt-2">
                                            @if($pelaku->cek_fraud)
                                                <span class="badge bg-danger me-1">
                                                    <i class="fas fa-exclamation-triangle me-1"></i>Fraud
                                                </span>
                                            @endif
                                            @if($pelaku->cek_pelanggaran)
                                                <span class="badge bg-warning me-1">
                                                    <i class="fas fa-ban me-1"></i>Pelanggaran
                                                </span>
                                            @endif
                                            @if($pelaku->cek_kode_etik)
                                                <span class="badge bg-info me-1">
                                                    <i class="fas fa-gavel me-1"></i>Kode Etik
                                                </span>
                                            @endif
                                            @if($pelaku->cek_disiplin)
                                                <span class="badge bg-primary me-1">
                                                    <i class="fas fa-clock me-1"></i>Disiplin
                                                </span>
                                            @endif
                                            @if($pelaku->cek_berulang)
                                                <span class="badge bg-secondary me-1">
                                                    <i class="fas fa-redo me-1"></i>Berulang
                                                </span>
                                            @endif
                                            
                                            @if(!$pelaku->cek_fraud && !$pelaku->cek_pelanggaran && !$pelaku->cek_kode_etik && !$pelaku->cek_disiplin && !$pelaku->cek_berulang)
                                                <span class="text-muted">Tidak ada pelanggaran yang ditandai</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Tidak ada data pelaku untuk BA Temuan ini.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>