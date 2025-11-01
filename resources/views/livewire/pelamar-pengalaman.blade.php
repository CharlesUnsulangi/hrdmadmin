<div>
    <h5>Daftar Pengalaman Kerja</h5>
    <button class="btn btn-success mb-2" wire:click="showAddForm">Tambah Pengalaman</button>
    @if($showForm)
        <form wire:submit.prevent="savePengalaman" class="mb-3">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label>Perusahaan</label>
                    <input type="text" class="form-control" wire:model.defer="form.perusahaan">
                </div>
                <div class="col-md-6 mb-2">
                    <label>Jabatan Awal</label>
                    <input type="text" class="form-control" wire:model.defer="form.jabatan_awal">
                </div>
                <div class="col-md-6 mb-2">
                    <label>Jabatan Akhir</label>
                    <input type="text" class="form-control" wire:model.defer="form.jabatan_akhir">
                </div>
                <div class="col-md-6 mb-2">
                    <label>Tanggal Masuk</label>
                    <input type="date" class="form-control" wire:model.defer="form.tgl_start">
                </div>
                <div class="col-md-6 mb-2">
                    <label>Tanggal Keluar</label>
                    <input type="date" class="form-control" wire:model.defer="form.tgl_end">
                </div>
                <div class="col-md-6 mb-2">
                    <label>Gaji Awal</label>
                    <input type="number" class="form-control" wire:model.defer="form.gaji_awal">
                </div>
                <div class="col-md-6 mb-2">
                    <label>Gaji Akhir</label>
                    <input type="number" class="form-control" wire:model.defer="form.gaji_akhir">
                </div>
                <div class="col-md-12 mb-2">
                    <label>Alasan Resign</label>
                    <textarea class="form-control" wire:model.defer="form.alasan_resign"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-secondary" wire:click="$set('showForm', false)">Batal</button>
        </form>
    @endif
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Perusahaan</th>
                <th>Jabatan Awal</th>
                <th>Jabatan Akhir</th>
                <th>Tanggal Masuk</th>
                <th>Tanggal Keluar</th>
                <th>Gaji Awal</th>
                <th>Gaji Akhir</th>
                <th>Alasan Resign</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengalamanList as $pengalaman)
                <tr>
                    <td>{{ $pengalaman->perusahaan ?? '-' }}</td>
                    <td>{{ $pengalaman->jabatan_awal ?? '-' }}</td>
                    <td>{{ $pengalaman->jabatan_akhir ?? '-' }}</td>
                    <td>{{ $pengalaman->tgl_start ?? '-' }}</td>
                    <td>{{ $pengalaman->tgl_end ?? '-' }}</td>
                    <td>{{ $pengalaman->gaji_awal ?? '-' }}</td>
                    <td>{{ $pengalaman->gaji_akhir ?? '-' }}</td>
                    <td>{{ $pengalaman->alasan_resign ?? '-' }}</td>
                    <td>
                        <button class="btn btn-sm btn-info" wire:click="showEditForm({{ $pengalaman->tr_hr_pelamar_pengalaman_id }})">Edit</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Belum ada data pengalaman</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
