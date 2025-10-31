@extends('layouts.app')
@section('content')
<div class="container py-5 text-center">
    <div class="alert alert-warning d-inline-block px-5 py-4 shadow">
        <i class="bi bi-tools display-4 mb-3 d-block"></i>
        <h3 class="mb-2">Fitur Sedang Dalam Proses Pengembangan</h3>
        <p class="mb-0">Menu ini akan segera tersedia. Silakan kembali ke menu utama atau hubungi admin untuk info lebih lanjut.</p>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3"><i class="bi bi-arrow-left"></i> Kembali ke Dashboard</a>
    </div>
</div>
@endsection
