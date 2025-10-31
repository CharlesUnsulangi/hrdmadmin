<div>
    <h5>Daftar Pengalaman Kerja</h5>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Perusahaan</th>
                <th>Jabatan</th>
                <th>Tahun Masuk</th>
                <th>Tahun Keluar</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengalamanList as $pengalaman)
                <tr>
                    <td>{{ $pengalaman->nama_perusahaan ?? '-' }}</td>
                    <td>{{ $pengalaman->jabatan ?? '-' }}</td>
                    <td>{{ $pengalaman->tahun_masuk ?? '-' }}</td>
                    <td>{{ $pengalaman->tahun_keluar ?? '-' }}</td>
                    <td>{{ $pengalaman->deskripsi ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data pengalaman</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
