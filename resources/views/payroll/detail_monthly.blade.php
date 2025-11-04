@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Payroll Bulanan: {{ $code_h }}</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Karyawan</th>
                <th>Nama</th>
                <th>Total Pembayaran</th>
                <th>Tanggal Pembayaran</th>
                <th>Catatan</th>
                <th>Rekening</th>
                <th>Upah Pokok</th>
                <th>Tunjangan</th>
                <th>Komisi</th>
                <th>Bonus</th>
                <th>THR</th>
                <th>Pajak</th>
                <th>BPJS</th>
                <th>Potongan</th>
                <th>Cicilan</th>
                <th>Absen</th>
                <th>Lainnya</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @forelse($details as $detail)
            <tr>
                <td>{{ $detail->payroll_payment_monthly_no }}</td>
                <td>{{ $detail->payroll_payment_emp_code }}</td>
                <td>{{ $detail->nama ?? '-' }}</td>
                <td>{{ $detail->payroll_payment_total_payment }}</td>
                <td>{{ $detail->payroll_payment_date_payroll_payment }}</td>
                <td>{{ $detail->payroll_payment_note }}</td>
                <td>{{ $detail->payroll_payment_rekno }}</td>
                <td>{{ $detail->upah_pokok }}</td>
                <td>{{ $detail->tunjangan }}</td>
                <td>{{ $detail->komisi }}</td>
                <td>{{ $detail->bonus }}</td>
                <td>{{ $detail->thr }}</td>
                <td>{{ $detail->pajak }}</td>
                <td>{{ $detail->bpjs }}</td>
                <td>{{ $detail->potongan }}</td>
                <td>{{ $detail->cicilan }}</td>
                <td>{{ $detail->absen }}</td>
                <td>{{ $detail->lainnya }}</td>
                <td>{{ $detail->email }}</td>
            </tr>
            @empty
            <tr><td colspan="18" class="text-center">Data tidak ditemukan</td></tr>
            @endforelse
        </tbody>
    </table>
    <a href="{{ route('payroll') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
