<div class="row">
    <div class="col-md-12">
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">
                <h6 class="mb-0"><i class="fas fa-car-crash me-2"></i>Data Kecelakaan BA Laka</h6>
            </div>
            <div class="card-body">
                @if($beritaAcara->laka)
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="30%"><strong>Truck ID:</strong></td>
                                    <td>
                                        <span class="badge bg-secondary fs-6">{{ $beritaAcara->laka->ms_truck_id }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Driver ID:</strong></td>
                                    <td>
                                        <span class="badge bg-secondary fs-6">{{ $beritaAcara->laka->ms_driver_id }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <!-- Space for future truck/driver details if master tables exist -->
                            <div class="alert alert-light">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Detail truck dan driver akan ditampilkan jika master data tersedia.
                                </small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card border-light">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0 text-dark">
                                        <i class="fas fa-file-text me-2"></i>Kronologi Kejadian
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="p-3 bg-white border rounded">
                                        {!! nl2br(e($beritaAcara->laka->note_kronologi)) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Data kecelakaan untuk BA Laka ini belum tersedia.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>