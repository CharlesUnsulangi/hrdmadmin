@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Buat Draft Payroll Bulanan</h2>
    <form method="POST" action="{{ route('payroll.monthly.h.store') }}">
        @csrf
        <div class="mb-3">
            <label for="payroll_payment_monthly_h_code" class="form-label">Kode Header</label>
            <input type="text" name="payroll_payment_monthly_h_code" id="payroll_payment_monthly_h_code" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="periode" class="form-label">Periode</label>
            <input type="text" name="periode" id="periode" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="pay_date" class="form-label">Tanggal Proses</label>
            <input type="date" name="pay_date" id="pay_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan Draft</button>
        <a href="{{ route('payroll') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
