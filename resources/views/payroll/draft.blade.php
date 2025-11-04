@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Input Draft Payroll Bulanan</h2>
    <style>
        .payroll-table-wrapper {
            overflow-x: auto;
        }
        #payroll-table th, #payroll-table td {
            min-width: 180px;
        }
    </style>
    <form action="{{ route('payroll.draft.store') }}" method="POST">
        @csrf
    <div class="payroll-table-wrapper">
    <table class="table table-bordered" id="payroll-table" style="min-width:2200px;">
            <thead>
                <tr>
                    <th>Nama Employee</th>
                    <th>Rekening</th>
                    <th>Tunjangan</th>
                    <th>Komisi</th>
                    <th>Bonus</th>
                    <th>THR</th>
                    <th>BPJS</th>
                    <th>Potongan</th>
                    <th>Cicilan</th>
                    <th>Total</th>
                    <th>Absen</th>
                    <th>Terakhir Absen</th>
                    <th>Email</th>
                    <th>Total Value</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="payroll-tbody">
                <tr>
                    <td><input type="text" name="rows[0][nama_employee]" class="form-control" required></td>
                    <td><input type="text" name="rows[0][rekening]" class="form-control"></td>
                    <td><input type="number" name="rows[0][tunjangan]" class="form-control" step="0.01"></td>
                    <td><input type="number" name="rows[0][komisi]" class="form-control" step="0.01"></td>
                    <td><input type="number" name="rows[0][bonus]" class="form-control" step="0.01"></td>
                    <td><input type="number" name="rows[0][thr]" class="form-control" step="0.01"></td>
                    <td><input type="number" name="rows[0][bpjs]" class="form-control" step="0.01"></td>
                    <td><input type="number" name="rows[0][potongan]" class="form-control" step="0.01"></td>
                    <td><input type="number" name="rows[0][cicilan]" class="form-control" step="0.01"></td>
                    <td><input type="number" name="rows[0][total]" class="form-control" step="0.01"></td>
                    <td><input type="number" name="rows[0][absen]" class="form-control"></td>
                    <td><input type="date" name="rows[0][terakhir_absen]" class="form-control"></td>
                    <td><input type="email" name="rows[0][email]" class="form-control"></td>
                    <td><input type="number" name="rows[0][total_value]" class="form-control" step="0.01"></td>
                    <td><button type="button" class="btn btn-danger btn-remove-row">Hapus</button></td>
                </tr>
            </tbody>
    </table>
    </div>
        <button type="button" class="btn btn-primary" id="add-row">Tambah Baris</button>
        <button type="submit" class="btn btn-success">Simpan Draft Payroll</button>
        <a href="{{ route('payroll') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
<script>
let rowIdx = 1;
document.getElementById('add-row').onclick = function() {
    const tbody = document.getElementById('payroll-tbody');
    const tr = document.createElement('tr');
    tr.innerHTML = `
        <td><input type="text" name="rows[${rowIdx}][nama_employee]" class="form-control" required></td>
        <td><input type="text" name="rows[${rowIdx}][rekening]" class="form-control"></td>
        <td><input type="number" name="rows[${rowIdx}][tunjangan]" class="form-control" step="0.01"></td>
        <td><input type="number" name="rows[${rowIdx}][komisi]" class="form-control" step="0.01"></td>
        <td><input type="number" name="rows[${rowIdx}][bonus]" class="form-control" step="0.01"></td>
        <td><input type="number" name="rows[${rowIdx}][thr]" class="form-control" step="0.01"></td>
        <td><input type="number" name="rows[${rowIdx}][bpjs]" class="form-control" step="0.01"></td>
        <td><input type="number" name="rows[${rowIdx}][potongan]" class="form-control" step="0.01"></td>
        <td><input type="number" name="rows[${rowIdx}][cicilan]" class="form-control" step="0.01"></td>
        <td><input type="number" name="rows[${rowIdx}][total]" class="form-control" step="0.01"></td>
        <td><input type="number" name="rows[${rowIdx}][absen]" class="form-control"></td>
        <td><input type="date" name="rows[${rowIdx}][terakhir_absen]" class="form-control"></td>
        <td><input type="email" name="rows[${rowIdx}][email]" class="form-control"></td>
        <td><input type="number" name="rows[${rowIdx}][total_value]" class="form-control" step="0.01"></td>
        <td><button type="button" class="btn btn-danger btn-remove-row">Hapus</button></td>
    `;
    tbody.appendChild(tr);
    rowIdx++;
};
document.getElementById('payroll-tbody').addEventListener('click', function(e) {
    if (e.target.classList.contains('btn-remove-row')) {
        e.target.closest('tr').remove();
    }
});
</script>
</div>
@endsection
