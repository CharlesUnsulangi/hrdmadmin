@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Edit Data Employee</h2>
    <div class="mb-4">
        <strong>ID:</strong> {{ $karyawan->emp_id }}<br>
        <strong>Nama:</strong> {{ $karyawan->emp_name }}<br>
        <strong>Divisi:</strong> {{ $karyawan->emp_iddivision }}<br>
        <strong>Status:</strong> {{ $karyawan->emp_status }}
    </div>
    <form method="POST" action="{{ url('/employee/' . $karyawan->emp_id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="emp_name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="emp_name" name="emp_name" value="{{ $karyawan->emp_name }}">
        </div>
        <div class="mb-3">
            <label for="emp_iddivision" class="form-label">Divisi</label>
            <input type="text" class="form-control" id="emp_iddivision" name="emp_iddivision" value="{{ $karyawan->emp_iddivision }}">
        </div>
        <div class="mb-3">
            <label for="emp_status" class="form-label">Status</label>
            <input type="text" class="form-control" id="emp_status" name="emp_status" value="{{ $karyawan->emp_status }}">
        </div>
        <div class="mb-3">
            <label for="emp_nokontrak" class="form-label">No. Kontrak</label>
            <input type="text" class="form-control" id="emp_nokontrak" name="emp_nokontrak" value="{{ $karyawan->emp_nokontrak }}">
        </div>
        <div class="mb-3">
            <label for="emp_inactive" class="form-label">Inactive</label>
            <input type="checkbox" id="emp_inactive" name="emp_inactive" value="1" {{ $karyawan->emp_inactive ? 'checked' : '' }}> Tidak Aktif
        </div>
        <div class="mb-3">
            <label for="emp_expdatekontrak" class="form-label">Exp. Kontrak</label>
            <input type="date" class="form-control" id="emp_expdatekontrak" name="emp_expdatekontrak" value="{{ $karyawan->emp_expdatekontrak }}">
        </div>
        <div class="mb-3">
            <label for="emp_numkontrak" class="form-label">Jumlah Kontrak</label>
            <input type="number" class="form-control" id="emp_numkontrak" name="emp_numkontrak" value="{{ $karyawan->emp_numkontrak }}">
        </div>
        <div class="mb-3">
            <label for="emp_jamsostek" class="form-label">Jamsostek</label>
            <input type="text" class="form-control" id="emp_jamsostek" name="emp_jamsostek" value="{{ $karyawan->emp_jamsostek }}">
        </div>
        <div class="mb-3">
            <label for="emp_telp" class="form-label">Telepon</label>
            <input type="text" class="form-control" id="emp_telp" name="emp_telp" value="{{ $karyawan->emp_telp }}">
        </div>
        <div class="mb-3">
            <label for="emp_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="emp_email" name="emp_email" value="{{ $karyawan->emp_email }}">
        </div>
        <div class="mb-3">
            <label for="emp_lastabsen" class="form-label">Last Absen</label>
            <input type="date" class="form-control" id="emp_lastabsen" name="emp_lastabsen" value="{{ $karyawan->emp_lastabsen }}">
        </div>
        <div class="mb-3">
            <label for="emp_last_salary_date" class="form-label">Last Salary Date</label>
            <input type="date" class="form-control" id="emp_last_salary_date" name="emp_last_salary_date" value="{{ $karyawan->emp_last_salary_date }}">
        </div>
        <div class="mb-3">
            <label for="emp_bank" class="form-label">Bank</label>
            <input type="text" class="form-control" id="emp_bank" name="emp_bank" value="{{ $karyawan->emp_bank }}">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ url('/pkwtt/create?ms_emp_id=' . $karyawan->emp_id) }}" class="btn btn-success ms-2">Create PKWTT</a>
        <button type="button" class="btn btn-warning ms-2" onclick="updateResign()">Update Resign</button>
    </form>
    <form id="form-resign" method="POST" action="{{ url('/employee/' . $karyawan->emp_id . '/resign') }}" style="display:none;">
        @csrf
        <input type="hidden" name="emp_last_salary_date" value="{{ $karyawan->emp_last_salary_date }}">
    </form>
    <script>
    function updateResign() {
        if(confirm('Yakin update resign?')) {
            document.getElementById('form-resign').submit();
        }
    }
    </script>
        <!-- Modal Create PKWTT -->
                <!-- Modal Create PKWTT dihapus, diganti tombol redirect ke halaman create PKWTT -->
</div>
@endsection
