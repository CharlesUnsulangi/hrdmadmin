@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Draft Payroll Detail</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Comcode</th>
                <th>Areacode</th>
                <th>Monthly H</th>
                <th>Monthly No</th>
                <th>Payroll Monthly Code</th>
                <th>Tanggal Payroll</th>
                <th>Emp Code</th>
                <th>Total Payment</th>
                <th>User Payroll</th>
                <th>Note</th>
                <th>Trans Main COA</th>
                <th>Potongan</th>
                <th>Value</th>
                <th>Rek No</th>
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
                <th>Last Absen</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($drafts as $draft)
            <tr>
                <td>{{ $draft->rec_comcode }}</td>
                <td>{{ $draft->rec_areacode }}</td>
                <td>{{ $draft->payroll_payment_monthly_h }}</td>
                <td>{{ $draft->payroll_payment_monthly_no }}</td>
                <td>{{ $draft->payroll_payment_payrollmonthlycode }}</td>
                <td>{{ $draft->payroll_payment_date_payroll_payment }}</td>
                <td>{{ $draft->payroll_payment_emp_code }}</td>
                <td>{{ $draft->payroll_payment_total_payment }}</td>
                <td>{{ $draft->payroll_payment_user_payroll }}</td>
                <td>{{ $draft->payroll_payment_note }}</td>
                <td>{{ $draft->payroll_payment_transmaincoacode }}</td>
                <td>{{ $draft->payroll_payment_potongan }}</td>
                <td>{{ $draft->payroll_payment_value }}</td>
                <td>{{ $draft->payroll_payment_rekno }}</td>
                <td>{{ $draft->upah_pokok }}</td>
                <td>{{ $draft->tunjangan }}</td>
                <td>{{ $draft->komisi }}</td>
                <td>{{ $draft->bonus }}</td>
                <td>{{ $draft->thr }}</td>
                <td>{{ $draft->pajak }}</td>
                <td>{{ $draft->bpjs }}</td>
                <td>{{ $draft->potongan }}</td>
                <td>{{ $draft->cicilan }}</td>
                <td>{{ $draft->absen }}</td>
                <td>{{ $draft->lainnya }}</td>
                <td>{{ $draft->last_absen }}</td>
                <td>{{ $draft->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
