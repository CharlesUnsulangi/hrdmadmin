@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Payroll Bulanan</h2>
    <div class="mb-3 d-flex gap-2">
        <a href="{{ route('payroll.draft') }}" class="btn btn-primary">Add New Payroll (Draft)</a>
        <a href="{{ route('payroll.monthly.h.create') }}" class="btn btn-success">Buat Draft Payroll Bulanan</a>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>
                    <a href="?sort=periode&order={{ (request('sort') == 'periode' && request('order') == 'asc') ? 'desc' : 'asc' }}">
                        Periode
                        @if(request('sort') == 'periode')
                            <i class="bi bi-caret-{{ request('order') == 'asc' ? 'up' : 'down' }}-fill"></i>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('payroll', ['sort' => 'payroll_monthly_date_payment', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Tanggal Proses
                        @if(request('sort') === 'payroll_monthly_date_payment')
                            <span class="sort-indicator">{{ request('order') === 'asc' ? '▲' : '▼' }}</span>
                        @endif
                    </a>
                </th>
                <th>Tanggal Created</th>
                <th>Keterangan</th>
                <th>Total Payment</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payrolls as $payroll)
            <tr style="cursor:pointer" onclick="window.location='{{ route('payroll.monthly.detail', $payroll->payroll_payment_monthly_h_code) }}'">
                <td>{{ $payroll->payroll_payment_monthly_h_code ?? $payroll->id }}</td>
                <td>{{ $payroll->periode ?? '-' }}</td>
                <td>{{ $payroll->payroll_monthly_date_payment ?? '-' }}</td>
                <td>{{ $payroll->rec_datecreated ?? '-' }}</td>
                <td>{{ $payroll->keterangan ?? '-' }}</td>
                <td>{{ $payroll->payroll_monthly_Total_payment ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
