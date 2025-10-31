<div>
    <h5>Daftar Hasil Interview</h5>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Interviewer</th>
                <th>Score</th>
                <th>Status</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($interviews as $interview)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($interview->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $interview->interviewer }}</td>
                    <td>{{ $interview->score }}</td>
                    <td>{{ $interview->status }}</td>
                    <td>{{ $interview->catatan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data interview</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
