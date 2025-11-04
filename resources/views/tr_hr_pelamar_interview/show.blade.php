@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Detail Interview Pelamar</h2>
    <table class="table table-bordered">
        <tr><th>ID</th><td>{{ $interview->tr_hr_pelamar_interview_main_id }}</td></tr>
        <tr><th>ID Pelamar</th><td>{{ $interview->tr_hr_pelamar_main_id }}</td></tr>
        <tr><th>Tanggal Interview</th><td>{{ $interview->date_interview }}</td></tr>
        <tr><th>Jam Mulai</th><td>{{ $interview->time_start }}</td></tr>
        <tr><th>Jam Selesai</th><td>{{ $interview->time_end }}</td></tr>
        <tr><th>Catatan Operator</th><td>{{ $interview->note_operator }}</td></tr>
        <tr><th>Catatan SPV</th><td>{{ $interview->note_spv }}</td></tr>
        <tr><th>Catatan MGR</th><td>{{ $interview->note_mgr }}</td></tr>
        <tr><th>Catatan HRD</th><td>{{ $interview->note_hrd }}</td></tr>
        <tr><th>Catatan BD</th><td>{{ $interview->note_bd }}</td></tr>
        <tr><th>Catatan GM</th><td>{{ $interview->note_gm }}</td></tr>
        <tr><th>Catatan DIR</th><td>{{ $interview->note_dir }}</td></tr>
        <tr><th>Catatan MGT</th><td>{{ $interview->note_mgt }}</td></tr>
        <tr><th>Rating Operator</th><td>{{ $interview->rating_operator }}</td></tr>
        <tr><th>Rating SPV</th><td>{{ $interview->rating_spv }}</td></tr>
        <tr><th>Rating MGR</th><td>{{ $interview->rating_mgr }}</td></tr>
        <tr><th>Rating GM</th><td>{{ $interview->rating_gm }}</td></tr>
        <tr><th>Rating BD</th><td>{{ $interview->rating_bd }}</td></tr>
        <tr><th>Rating MGT</th><td>{{ $interview->rating_mgt }}</td></tr>
        <tr><th>Rating HRD</th><td>{{ $interview->rating_hrd }}</td></tr>
        <tr><th>Cek Lanjut</th><td>{{ $interview->cek_lanjut }}</td></tr>
        <tr><th>Cek Tolak</th><td>{{ $interview->cek_tolak }}</td></tr>
        <tr><th>User Created</th><td>{{ $interview->user_created }}</td></tr>
        <tr><th>Created At</th><td>{{ $interview->created_at }}</td></tr>
        <tr><th>Updated At</th><td>{{ $interview->updated_at }}</td></tr>
    </table>
    <a href="{{ url('tr_hr_pelamar_interview') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
