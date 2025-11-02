@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2>Manajemen Interview</h2>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form id="formPilihTipe" class="d-flex align-items-center" method="GET" action="#" onsubmit="return handlePilihTipe(event)">
            <select id="tipeInterview" class="form-select me-2" required>
                <option value="">-- Pilih Tipe Interview --</option>
                <option value="spv">SPV</option>
                <option value="mgt">MGT</option>
                <option value="hrd">HRD</option>
                <option value="finance">Finance</option>
                <option value="bod">BOD</option>
                <option value="admin">Admin</option>
            </select>
            <button type="submit" class="btn btn-success">Tambah Interview</button>
        </form>
    </div>
    <style>
    #formPilihTipe .form-select {
        color: #212529 !important;
        background-color: #f8f9fa !important;
        border-color: #6c757d !important;
    }
    #formPilihTipe .form-select:focus {
        color: #212529 !important;
        background-color: #fff !important;
        border-color: #495057 !important;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(108,117,125,.25);
    }
    #formPilihTipe .btn-success {
        color: #fff !important;
        background-color: #198754 !important;
        border-color: #198754 !important;
        font-weight: bold;
    }
    #formPilihTipe .btn-success:hover {
        background-color: #145c32 !important;
        border-color: #145c32 !important;
    }
    </style>
    <script>
    function handlePilihTipe(e) {
        e.preventDefault();
        var tipe = document.getElementById('tipeInterview').value;
        if (!tipe) return false;
        var routes = {
            spv: "{{ route('interview_spv.create') }}",
            mgt: "{{ route('interview_mgt.create') }}",
            hrd: "{{ route('interview_hrd.create') }}",
            finance: "{{ route('interview_finance.create') }}",
            bod: "{{ route('interview_bod.create') }}",
            admin: "{{ route('interview_admin.create') }}"
        };
        window.location.href = routes[tipe];
        return false;
    }
    </script>
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link {{ !$selectedType ? 'active' : '' }}" href="{{ route('manajemen-interview.index') }}">Semua</a>
        </li>
        @foreach($types as $type)
        <li class="nav-item">
            <a class="nav-link {{ $selectedType === $type ? 'active' : '' }}" href="{{ route('manajemen-interview.index', ['type' => $type]) }}">{{ strtoupper($type) }}</a>
        </li>
        @endforeach
    </ul>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tipe</th>
                <th>Pelamar</th>
                <th>Tanggal</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Rating</th>
                <th>Offline</th>
                <th>Online</th>
                <th>Red Flag</th>
                <th>Green Flag</th>
                <th>Catatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($interviews as $row)
            <tr>
                <td>{{ $row['type'] }}</td>
                <td>{{ $row['pelamar'] }}</td>
                <td>{{ $row['date_interview'] }}</td>
                <td>{{ $row['time_start'] }}</td>
                <td>{{ $row['time_end'] }}</td>
                <td>{{ $row['rating_final'] }}</td>
                <td>{{ $row['cek_offline'] ? 'Ya' : 'Tidak' }}</td>
                <td>{{ $row['cek_online'] ? 'Ya' : 'Tidak' }}</td>
                <td>{{ $row['red_flag'] }}</td>
                <td>{{ $row['green_flag'] }}</td>
                <td>{{ $row['note_interview'] }}</td>
                <td>
                    @php
                        $typeRouteMap = [
                            'SPV' => 'interview_spv.edit',
                            'MGT' => 'interview_mgt.edit',
                            'HRD' => 'interview_hrd.edit',
                            'FINANCE' => 'interview_finance.edit',
                            'BOD' => 'interview_bod.edit',
                            'ADMIN' => 'interview_admin.edit',
                        ]; 
                        $routeName = $typeRouteMap[$row['type']] ?? null;
                    @endphp
                    @if($routeName)
                        <a href="{{ route($routeName, $row['id']) }}" class="btn btn-sm btn-primary">Lakukan Interview</a>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="12" class="text-center">Tidak ada data interview</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
