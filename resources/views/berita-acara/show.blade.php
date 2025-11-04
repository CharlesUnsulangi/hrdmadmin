@extends('layouts.clean')

@section('title', 'Detail Berita Acara')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- BA Main Info -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-file-alt me-2"></i>Detail Berita Acara #{{ $beritaAcara->tr_hr_ba_id }}
                    </h5>
                    <div class="btn-group">
                        <a href="{{ route('berita-acara.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        @if(Auth::user()->role === 'ADMIN' || Auth::user()->role === 'HR')
                            <a href="{{ route('berita-acara.edit', $beritaAcara->tr_hr_ba_id) }}" 
                               class="btn btn-warning">
                                <i class="fas fa-edit me-2"></i>Edit
                            </a>
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="30%"><strong>ID BA:</strong></td>
                                    <td>{{ $beritaAcara->tr_hr_ba_id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal:</strong></td>
                                    <td>{{ $beritaAcara->formatted_date }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Pelapor:</strong></td>
                                    <td>{{ $beritaAcara->user->username ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        @if($beritaAcara->ms_hr_ba_type_id)
                                            <span class="badge bg-success">
                                                {{ $beritaAcara->ms_hr_ba_type_id }}
                                            </span>
                                        @else
                                            <span class="badge bg-warning">Belum Ditentukan</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6><strong>Nama Kejadian:</strong></h6>
                            <p class="bg-light p-3 rounded">{{ $beritaAcara->note_ba }}</p>
                            
                            @if($beritaAcara->pelaku_desc)
                                <h6><strong>Keterangan Pelaku/Objek:</strong></h6>
                                <p class="bg-light p-3 rounded">{{ $beritaAcara->pelaku_desc }}</p>
                            @endif
                        </div>
                    </div>
                    
                    @if($beritaAcara->kronologi)
                        <div class="row mt-3">
                            <div class="col-12">
                                <h6><strong>Kronologi Kejadian:</strong></h6>
                                <div class="bg-light p-3 rounded">
                                    <pre style="white-space: pre-wrap; margin: 0; font-family: inherit;">{{ $beritaAcara->kronologi }}</pre>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Action Cards -->
            @if(!$beritaAcara->ms_hr_ba_type_id)
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <h5><i class="fas fa-info-circle me-2"></i>Langkah Selanjutnya</h5>
                            <p class="mb-3">Berita Acara dasar sudah tersimpan. Sekarang tentukan jenis kejadian dan tambahkan detail spesifik:</p>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card border-warning">
                                        <div class="card-body text-center">
                                            <i class="fas fa-search text-warning mb-2" style="font-size: 2rem;"></i>
                                            <h6>BA Temuan</h6>
                                            <p class="small text-muted">Untuk kejadian pelanggaran, fraud, atau temuan lainnya</p>
                                            <a href="{{ route('berita-acara.add-details', ['id' => $beritaAcara->tr_hr_ba_id, 'type' => 'TEMUAN']) }}" 
                                               class="btn btn-warning btn-sm">
                                                <i class="fas fa-plus me-1"></i>Pilih
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="card border-danger">
                                        <div class="card-body text-center">
                                            <i class="fas fa-truck text-danger mb-2" style="font-size: 2rem;"></i>
                                            <h6>BA Laka</h6>
                                            <p class="small text-muted">Untuk kecelakaan kendaraan atau kejadian lalu lintas</p>
                                            <a href="{{ route('berita-acara.add-details', ['id' => $beritaAcara->tr_hr_ba_id, 'type' => 'LAKA']) }}" 
                                               class="btn btn-danger btn-sm">
                                                <i class="fas fa-plus me-1"></i>Pilih
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="card border-info">
                                        <div class="card-body text-center">
                                            <i class="fas fa-edit text-info mb-2" style="font-size: 2rem;"></i>
                                            <h6>BA Revisi</h6>
                                            <p class="small text-muted">Untuk koreksi data atau revisi dokumen</p>
                                            <a href="{{ route('berita-acara.add-details', ['id' => $beritaAcara->tr_hr_ba_id, 'type' => 'REVISI']) }}" 
                                               class="btn btn-info btn-sm">
                                                <i class="fas fa-plus me-1"></i>Pilih
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Detail Spesifik -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-list me-2"></i>Detail {{ $beritaAcara->ms_hr_ba_type_id }}
                        </h6>
                    </div>
                    <div class="card-body">
                        @if($beritaAcara->ms_hr_ba_type_id === 'TEMUAN')
                            <p class="text-muted">Detail pelaku akan ditampilkan setelah tabel tr_hr_ba_pelaku dibuat.</p>
                        @elseif($beritaAcara->ms_hr_ba_type_id === 'LAKA')
                            @if($beritaAcara->laka)
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Truck ID:</strong> {{ $beritaAcara->laka->ms_truck_id }}<br>
                                        <strong>Driver ID:</strong> {{ $beritaAcara->laka->ms_driver_id }}
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Kronologi:</strong><br>
                                        <p class="bg-light p-2 rounded">{{ $beritaAcara->laka->note_kronologi }}</p>
                                    </div>
                                </div>
                            @else
                                <p class="text-muted">Belum ada detail laka tersimpan.</p>
                            @endif
                        @elseif($beritaAcara->ms_hr_ba_type_id === 'REVISI')
                            <p class="text-muted">Detail revisi akan ditampilkan setelah tabel tr_hr_ba_revisi dibuat.</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection