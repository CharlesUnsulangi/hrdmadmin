@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Kandidat</h2>
    <form action="#" method="POST">
        @csrf
        <!-- Tambahkan field sesuai kebutuhan -->
        <div class="mb-3">
            <label for="ms_hr_kandidat_emp_id" class="form-label">ID Kandidat</label>
            <input type="text" class="form-control" id="ms_hr_kandidat_emp_id" name="ms_hr_kandidat_emp_id" value="{{ $kandidat->ms_hr_kandidat_emp_id }}" readonly>
        </div>
        <div class="mb-3">
            <label for="ms_status_id" class="form-label">Status</label>
            <input type="text" class="form-control" id="ms_status_id" name="ms_status_id" value="{{ $kandidat->ms_status_id }}">
        </div>
        <div class="mb-3">
            <label for="date_kandidat" class="form-label">Tanggal Kandidat</label>
            <input type="date" class="form-control" id="date_kandidat" name="date_kandidat" value="{{ $kandidat->date_kandidat }}">
        </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('kandidat.index') }}" class="btn btn-secondary">Kembali</a>

                <!-- Tombol Buat PKWTT -->
                <button type="button" class="btn btn-success ms-2" data-bs-toggle="modal" data-bs-target="#modalPKWTT">
                        Buat PKWTT
                </button>

                <!-- Modal Konfirmasi PKWTT -->
                <div class="modal fade" id="modalPKWTT" tabindex="-1" aria-labelledby="modalPKWTTLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalPKWTTLabel">Konfirmasi Buat PKWTT</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin membuat PKWTT untuk kandidat ini?
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('kandidat.buat-pkwtt', $kandidat->ms_hr_kandidat_emp_id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Ya, Buat PKWTT</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
    </form>
</div>
@endsection
