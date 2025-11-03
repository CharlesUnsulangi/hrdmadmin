@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Riwayat PKWTT</h2>
    <form method="GET" class="row g-3 mb-3 align-items-end">
        <div class="col-md-3">
            <label class="form-label">Cari (ID/Nama)</label>
            <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari PKWTT, ID, atau Nama">
        </div>
        <div class="col-md-2">
            <label class="form-label">Sort</label>
            <select name="sort" class="form-select">
                <option value="date_pkwtt_start" @selected(request('sort','date_pkwtt_start')=='date_pkwtt_start')>Tanggal Mulai</option>
                <option value="date_pkwtt_end" @selected(request('sort')=='date_pkwtt_end')>Tanggal Akhir</option>
                <option value="tr_hd_pkwtt_id" @selected(request('sort')=='tr_hd_pkwtt_id')>ID PKWTT</option>
                <option value="ms_emp_id" @selected(request('sort')=='ms_emp_id')>ID Karyawan/Kandidat</option>
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label">Arah</label>
            <select name="dir" class="form-select">
                <option value="desc" @selected(request('dir','desc')=='desc')>Desc</option>
                <option value="asc" @selected(request('dir')=='asc')>Asc</option>
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label">Status Tanda Tangan</label>
            <select name="status" class="form-select" disabled>
                <option value="">Semua</option>
                <option value="menunggu">Menunggu</option>
                <option value="hr">Sudah HR</option>
                <option value="kandidat">Sudah Kandidat</option>
                <option value="selesai">Selesai</option>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">Filter/Search</button>
        </div>
        <div class="col-md-1">
            <a href="{{ route('pkwtt.create') }}" class="btn btn-success w-100">Buat PKWTT</a>
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID PKWTT</th>
                <th>ID Karyawan/Kandidat</th>
                <th>Nama</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Akhir</th>
                <th>Tanggal Tanda Tangan</th>
                <th>Durasi (bulan)</th>
                <th>Status Tanda Tangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($list as $pkwtt)
            <tr>
                <td>{{ $pkwtt->tr_hd_pkwtt_id }}</td>
                <td>{{ $pkwtt->ms_emp_id }}</td>
                <td>
                  {{-- Dummy: tampilkan nama dari relasi kandidat/employee jika ada --}}
                  @php
                    $nama = null;
                    $kandidat = \App\Models\MsHrKandidat::find($pkwtt->ms_emp_id);
                    if ($kandidat) $nama = $kandidat->ms_hr_kandidat_emp_id;
                    $employee = class_exists('App\\Models\\MsEmployee') ? \App\Models\MsEmployee::find($pkwtt->ms_emp_id) : null;
                    if ($employee && method_exists($employee, 'getAttribute')) $nama = $employee->emp_name;
                  @endphp
                  {{ $nama ?? '-' }}
                </td>
                <td>{{ $pkwtt->date_pkwtt_start }}</td>
                <td>{{ $pkwtt->date_pkwtt_end }}</td>
                <td>{{ $pkwtt->date_sign }}</td>
                <td>{{ $pkwtt->month }}</td>
                <td>
                  {{-- Dummy status tanda tangan --}}
                  <span class="badge bg-warning">Menunggu</span>
                </td>
                <td>
                    <a href="{{ route('pkwtt.show', $pkwtt->tr_hd_pkwtt_id) }}" class="btn btn-sm btn-info">Detail</a>
                    <a href="{{ route('pkwtt.edit', $pkwtt->tr_hd_pkwtt_id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('pkwtt.destroy', $pkwtt->tr_hd_pkwtt_id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin hapus PKWTT ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
