@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2>Daftar Interview</h2>
    <a href="{{ route('interview_main.create') }}" class="btn btn-primary mb-3">Tambah Interview</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Pelamar</th>
                <th>Tipe</th>
                <th>Rating</th>
                <th>Catatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($list as $row)
                <tr>
                    <td>{{ $row->date_interview }}</td>
                    <td>{{ $row->tr_hr_pelamar_main_id }}</td>
                    <td>{{ $row->interview_type }}</td>
                    <td>{{ $row->rating ?? '-' }}</td>
                    <td>{{ $row->note ?? '-' }}</td>
                    <td>
                        @if($row->tr_hr_pelamar_interview_main_id)
                            <a href="{{ route('interview_main.edit', $row->tr_hr_pelamar_interview_main_id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('interview_main.destroy', $row->tr_hr_pelamar_interview_main_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus interview?')">Hapus</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">Belum ada data interview</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $list->links() }}
</div>
@endsection
