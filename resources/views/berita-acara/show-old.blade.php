@extends('layouts.clean')

@section('title', 'Detail Berita Acara')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-eye me-2"></i>Detail {{ $beritaAcara->type_name }}
                    </h5>
                    <div class="btn-group">
                        <a href="{{ route('berita-acara.index', ['type' => $beritaAcara->ms_hr_ba_type_id]) }}" 
                           class="btn btn-secondary">
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
                    <!-- Main Information -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card border-primary">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Utama</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="30%"><strong>ID BA:</strong></td>
                                            <td>{{ $beritaAcara->tr_hr_ba_id }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tipe BA:</strong></td>
                                            <td>
                                                <span class="badge bg-{{ $beritaAcara->ms_hr_ba_type_id === 'TEMUAN' ? 'warning' : ($beritaAcara->ms_hr_ba_type_id === 'LAKA' ? 'danger' : 'success') }}">
                                                    {{ $beritaAcara->type_name }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tanggal BA:</strong></td>
                                            <td>{{ $beritaAcara->formatted_date }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Dibuat oleh:</strong></td>
                                            <td>
                                                <strong>{{ $beritaAcara->user->nama ?? 'N/A' }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $beritaAcara->user->role ?? 'N/A' }}</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Dibuat pada:</strong></td>
                                            <td>{{ $beritaAcara->created_at ? $beritaAcara->created_at->format('d/m/Y H:i') : '-' }}</td>
                                        </tr>
                                        @if($beritaAcara->updated_at && $beritaAcara->updated_at != $beritaAcara->created_at)
                                            <tr>
                                                <td><strong>Terakhir update:</strong></td>
                                                <td>{{ $beritaAcara->updated_at->format('d/m/Y H:i') }}</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card border-info">
                                <div class="card-header bg-info text-white">
                                    <h6 class="mb-0"><i class="fas fa-file-alt me-2"></i>Catatan & Deskripsi</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <strong>Catatan BA:</strong>
                                        <div class="mt-2 p-3 bg-light rounded">
                                            {!! nl2br(e($beritaAcara->note_ba)) !!}
                                        </div>
                                    </div>
                                    
                                    @if($beritaAcara->pelaku_desc)
                                        <div class="mb-3">
                                            <strong>Deskripsi Pelaku:</strong>
                                            <div class="mt-2 p-2 bg-warning bg-opacity-25 rounded">
                                                {{ $beritaAcara->pelaku_desc }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Type Specific Details -->
                    @if($beritaAcara->ms_hr_ba_type_id === 'TEMUAN')
                        @include('berita-acara.partials.show-temuan', ['beritaAcara' => $beritaAcara])
                    @elseif($beritaAcara->ms_hr_ba_type_id === 'LAKA')
                        @include('berita-acara.partials.show-laka', ['beritaAcara' => $beritaAcara])
                    @elseif($beritaAcara->ms_hr_ba_type_id === 'REVISI')
                        @include('berita-acara.partials.show-revisi', ['beritaAcara' => $beritaAcara])
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection