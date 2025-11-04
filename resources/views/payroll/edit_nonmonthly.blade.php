@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Payroll Non Bulanan</h2>
    @if($header)
        <form method="POST" action="{{ route('payroll.nonmonthly.update', $header->payrollpaymentnonmonthly_code_h) }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="payrollpaymentnonmonthly_code_h" value="{{ $header->payrollpaymentnonmonthly_code_h }}">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode Karyawan</th>
                        <th>Total Pembayaran</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($details as $detail)
                    <tr>
                        <td>{{ $detail->payrollpaymentnonmonthly_code_d }}</td>
                        <td>{{ $detail->payrollpaymentnonmonthly_empcode }}</td>
                        <td><input type="number" name="details[{{ $detail->payrollpaymentnonmonthly_code_d }}][total]" value="{{ $detail->payrollpaymentnonmonthly_total_payment }}" class="form-control"></td>
                        <td><input type="date" name="details[{{ $detail->payrollpaymentnonmonthly_code_d }}][date]" value="{{ $detail->payrollpaymentnonmonthly_date_payroll_payment }}" class="form-control"></td>
                        <td><input type="text" name="details[{{ $detail->payrollpaymentnonmonthly_code_d }}][note]" value="{{ $detail->payrollpaymentnonmonthly_note }}" class="form-control"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('payroll') }}" class="btn btn-secondary">Kembali</a>
        </form>
    @else
        <div class="alert alert-danger">Data payroll non bulanan tidak ditemukan untuk kode ini.</div>
        <a href="{{ route('payroll') }}" class="btn btn-secondary">Kembali</a>
    @endif
</div>
@endsection
