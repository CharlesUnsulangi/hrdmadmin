@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Draft Payroll Detail</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('payroll.draft.detail.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="rec_comcode" class="form-label">Comcode</label>
                <input type="text" class="form-control" id="rec_comcode" name="rec_comcode" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="rec_areacode" class="form-label">Areacode</label>
                <input type="text" class="form-control" id="rec_areacode" name="rec_areacode" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="payroll_payment_monthly_h" class="form-label">Monthly H</label>
                <input type="text" class="form-control" id="payroll_payment_monthly_h" name="payroll_payment_monthly_h" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="payroll_payment_monthly_no" class="form-label">Monthly No</label>
                <input type="number" class="form-control" id="payroll_payment_monthly_no" name="payroll_payment_monthly_no" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="payroll_payment_payrollmonthlycode" class="form-label">Payroll Monthly Code</label>
                <input type="text" class="form-control" id="payroll_payment_payrollmonthlycode" name="payroll_payment_payrollmonthlycode" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="payroll_payment_date_payroll_payment" class="form-label">Tanggal Payroll</label>
                <input type="date" class="form-control" id="payroll_payment_date_payroll_payment" name="payroll_payment_date_payroll_payment">
            </div>
            <div class="col-md-4 mb-3">
                <label for="payroll_payment_emp_code" class="form-label">Emp Code</label>
                <input type="text" class="form-control" id="payroll_payment_emp_code" name="payroll_payment_emp_code">
            </div>
            <div class="col-md-4 mb-3">
                <label for="payroll_payment_total_payment" class="form-label">Total Payment</label>
                <input type="number" step="0.01" class="form-control" id="payroll_payment_total_payment" name="payroll_payment_total_payment">
            </div>
            <div class="col-md-4 mb-3">
                <label for="payroll_payment_user_payroll" class="form-label">User Payroll</label>
                <input type="text" class="form-control" id="payroll_payment_user_payroll" name="payroll_payment_user_payroll">
            </div>
            <div class="col-md-4 mb-3">
                <label for="payroll_payment_note" class="form-label">Note</label>
                <input type="text" class="form-control" id="payroll_payment_note" name="payroll_payment_note">
            </div>
            <div class="col-md-4 mb-3">
                <label for="payroll_payment_transmaincoacode" class="form-label">Trans Main COA Code</label>
                <input type="text" class="form-control" id="payroll_payment_transmaincoacode" name="payroll_payment_transmaincoacode">
            </div>
            <div class="col-md-4 mb-3">
                <label for="payroll_payment_potongan" class="form-label">Potongan</label>
                <input type="number" step="0.01" class="form-control" id="payroll_payment_potongan" name="payroll_payment_potongan">
            </div>
            <div class="col-md-4 mb-3">
                <label for="payroll_payment_value" class="form-label">Value</label>
                <input type="number" step="0.01" class="form-control" id="payroll_payment_value" name="payroll_payment_value">
            </div>
            <div class="col-md-4 mb-3">
                <label for="payroll_payment_rekno" class="form-label">Rek No</label>
                <input type="text" class="form-control" id="payroll_payment_rekno" name="payroll_payment_rekno">
            </div>
            <div class="col-md-4 mb-3">
                <label for="upah_pokok" class="form-label">Upah Pokok</label>
                <input type="number" step="0.01" class="form-control" id="upah_pokok" name="upah_pokok">
            </div>
            <div class="col-md-4 mb-3">
                <label for="tunjangan" class="form-label">Tunjangan</label>
                <input type="number" step="0.01" class="form-control" id="tunjangan" name="tunjangan">
            </div>
            <div class="col-md-4 mb-3">
                <label for="komisi" class="form-label">Komisi</label>
                <input type="number" step="0.01" class="form-control" id="komisi" name="komisi">
            </div>
            <div class="col-md-4 mb-3">
                <label for="bonus" class="form-label">Bonus</label>
                <input type="number" step="0.01" class="form-control" id="bonus" name="bonus">
            </div>
            <div class="col-md-4 mb-3">
                <label for="thr" class="form-label">THR</label>
                <input type="number" step="0.01" class="form-control" id="thr" name="thr">
            </div>
            <div class="col-md-4 mb-3">
                <label for="pajak" class="form-label">Pajak</label>
                <input type="number" step="0.01" class="form-control" id="pajak" name="pajak">
            </div>
            <div class="col-md-4 mb-3">
                <label for="bpjs" class="form-label">BPJS</label>
                <input type="number" step="0.01" class="form-control" id="bpjs" name="bpjs">
            </div>
            <div class="col-md-4 mb-3">
                <label for="potongan" class="form-label">Potongan</label>
                <input type="number" step="0.01" class="form-control" id="potongan" name="potongan">
            </div>
            <div class="col-md-4 mb-3">
                <label for="cicilan" class="form-label">Cicilan</label>
                <input type="number" step="0.01" class="form-control" id="cicilan" name="cicilan">
            </div>
            <div class="col-md-4 mb-3">
                <label for="absen" class="form-label">Absen</label>
                <input type="number" class="form-control" id="absen" name="absen">
            </div>
            <div class="col-md-4 mb-3">
                <label for="lainnya" class="form-label">Lainnya</label>
                <input type="number" step="0.01" class="form-control" id="lainnya" name="lainnya">
            </div>
            <div class="col-md-4 mb-3">
                <label for="last_absen" class="form-label">Last Absen</label>
                <input type="date" class="form-control" id="last_absen" name="last_absen">
            </div>
            <div class="col-md-4 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
        </div>
        <button type="submit" class="btn btn-success">Simpan Draft Detail</button>
        <a href="{{ route('payroll') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
