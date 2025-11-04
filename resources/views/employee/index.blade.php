@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Daftar Employee</h2>
    <form method="GET" class="row g-3 mb-3">
        <div class="col-md-3">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari nama/email...">
        </div>
        <div class="col-md-2">
            <select name="status" class="form-control">
                <option value="">-- Status --</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="date" name="datejoin" value="{{ request('datejoin') }}" class="form-control" placeholder="Tanggal Masuk">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('employee') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>
                    <a href="?sort=emp_inactive&order={{ (request('sort') == 'emp_inactive' && request('order') == 'asc') ? 'desc' : 'asc' }}">
                        Status
                        @if(request('sort') == 'emp_inactive')
                            <i class="bi bi-caret-{{ request('order') == 'asc' ? 'up' : 'down' }}-fill"></i>
                        @endif
                    </a>
                </th>
                <th>Last Absen</th>
                <th>
                    <a href="?sort=emp_last_salary_date&order={{ (request('sort') == 'emp_last_salary_date' && request('order') == 'asc') ? 'desc' : 'asc' }}">
                        Last Salary Date
                        @if(request('sort') == 'emp_last_salary_date')
                            <i class="bi bi-caret-{{ request('order') == 'asc' ? 'up' : 'down' }}-fill"></i>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="?sort=emp_datejoin&order={{ (request('sort') == 'emp_datejoin' && request('order') == 'asc') ? 'desc' : 'asc' }}">
                        Tanggal Masuk
                        @if(request('sort') == 'emp_datejoin')
                            <i class="bi bi-caret-{{ request('order') == 'asc' ? 'up' : 'down' }}-fill"></i>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="?sort=emp_dateresign&order={{ (request('sort') == 'emp_dateresign' && request('order') == 'asc') ? 'desc' : 'asc' }}">
                        Tanggal Resign
                        @if(request('sort') == 'emp_dateresign')
                            <i class="bi bi-caret-{{ request('order') == 'asc' ? 'up' : 'down' }}-fill"></i>
                        @endif
                    </a>
                </th>
                <th>Nomor Kontrak</th>
                <th>
                    <a href="?sort=emp_expdatekontrak&order={{ (request('sort') == 'emp_expdatekontrak' && request('order') == 'asc') ? 'desc' : 'asc' }}">
                        Exp. Kontrak
                        @if(request('sort') == 'emp_expdatekontrak')
                            <i class="bi bi-caret-{{ request('order') == 'asc' ? 'up' : 'down' }}-fill"></i>
                        @endif
                    </a>
                </th>
                <th>Jumlah Kontrak</th>
            </tr>
        </thead>
        <tbody>
            @foreach($karyawans as $karyawan)
            <tr ondblclick="window.location.href='{{ url('/employee/' . $karyawan->emp_id . '/edit') }}'" style="cursor:pointer;">
                <td>{{ $karyawan->emp_id }}</td>
                <td>{{ $karyawan->emp_name }}</td>
                <td>{{ $karyawan->emp_email }}</td>
                <td>
                    @if($karyawan->emp_inactive == 1)
                        <span class="badge bg-danger">Tidak Aktif</span>
                    @else
                        <span class="badge bg-success">Aktif</span>
                    @endif
                </td>
                <td>{{ $karyawan->emp_lastabsen ?? '-' }}</td>
                <td>{{ $karyawan->emp_last_salary_date ?? '-' }}</td>
                <td>{{ $karyawan->emp_datejoin }}</td>
                <td>{{ $karyawan->emp_dateresign }}</td>
                <td>{{ $karyawan->emp_nokontrak }}</td>
                <td>{{ $karyawan->emp_expdatekontrak }}</td>
                <td>{{ $karyawan->emp_numkontrak }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $karyawans->links() }}
    </div>
</div>
@endsection
