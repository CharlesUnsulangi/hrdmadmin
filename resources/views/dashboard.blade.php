@extends('layouts.app')
@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Dashboard Admin HRD</h1>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white shadow rounded p-4">
            <div class="text-gray-500">Total Pelamar</div>
            <div class="text-2xl font-bold">{{ $totalApplicants }}</div>
        </div>
        <div class="bg-white shadow rounded p-4">
            <div class="text-gray-500">Sudah Konfirmasi Interview</div>
            <div class="text-2xl font-bold">{{ $confirmedApplicants }}</div>
        </div>
        <div class="bg-white shadow rounded p-4">
            <div class="text-gray-500">Interview Hari Ini</div>
            <div class="text-2xl font-bold">{{ $todayInterviews }}</div>
        </div>
        <div class="bg-white shadow rounded p-4">
            <div class="text-gray-500">Karyawan Baru</div>
            <div class="text-2xl font-bold">{{ $newEmployees }}</div>
        </div>
    </div>
    <div class="bg-white shadow rounded p-4 mb-6">
        <h2 class="text-lg font-semibold mb-2">Leaderboard User HRD</h2>
        <table class="min-w-full text-sm">
            <thead><tr><th class="text-left">User</th><th class="text-left">Jumlah Pelamar</th></tr></thead>
            <tbody>
                @foreach($userStats as $row)
                <tr><td>{{ $row->user_created }}</td><td>{{ $row->total }}</td></tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="bg-white shadow rounded p-4 mb-6">
        <h2 class="text-lg font-semibold mb-2">Interview Terdekat</h2>
        <table class="min-w-full text-sm">
            <thead><tr><th>Nama Pelamar</th><th>Tanggal</th><th>Jam</th><th>Status</th></tr></thead>
            <tbody>
                @foreach($upcomingInterviews as $row)
                <tr>
                    <td>{{ $row->tr_hr_pelamar_id }}</td>
                    <td>{{ $row->date_interview }}</td>
                    <td>{{ $row->time_start }}</td>
                    <td>{{ $row->cek_lanjut ? 'Konfirmasi' : 'Belum' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="flex gap-4">
        <a href="{{ url('/pelamar') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Manajemen Pelamar</a>
        <a href="{{ url('/kandidat') }}" class="bg-indigo-500 text-black px-4 py-2 rounded font-semibold">Kandidat</a>
        <a href="{{ url('/interview') }}" class="bg-green-500 text-white px-4 py-2 rounded">Interview</a>
        <a href="{{ url('/karyawan') }}" class="bg-purple-500 text-white px-4 py-2 rounded">Karyawan</a>
        <a href="{{ url('/payroll') }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Payroll</a>
    </div>
</div>
@endsection
