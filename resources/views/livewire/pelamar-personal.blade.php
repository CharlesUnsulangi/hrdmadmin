<div>
    <h5>Data Personal Pelamar</h5>
    @if($showForm)
        <form wire:submit.prevent="savePersonal" class="mb-3">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label>Nama</label>
                    <input type="text" class="form-control" wire:model.defer="form.nama">
                </div>
                <div class="col-md-6 mb-2">
                    <label>Nama Keluarga</label>
                    <input type="text" class="form-control" wire:model.defer="form.nama_keluarga">
                </div>
                <div class="col-md-6 mb-2">
                    <label>Tanggal Lahir</label>
                    <input type="date" class="form-control" wire:model.defer="form.date_lahir">
                </div>
                <div class="col-md-6 mb-2">
                    <label>Kota Lahir</label>
                    <input type="text" class="form-control" wire:model.defer="form.kota_lahir">
                </div>
                <div class="col-md-6 mb-2">
                    <label>Alamat</label>
                    <input type="text" class="form-control" wire:model.defer="form.alamat">
                </div>
                <div class="col-md-6 mb-2">
                    <label>Jenis Kelamin</label>
                    <input type="text" class="form-control" wire:model.defer="form.jenis">
                </div>
                <div class="col-md-6 mb-2">
                    <label>Agama</label>
                    <input type="text" class="form-control" wire:model.defer="form.agama">
                </div>
                <div class="col-md-6 mb-2">
                    <label>Pendidikan</label>
                    <input type="text" class="form-control" wire:model.defer="form.pendidikan">
                </div>
                <div class="col-md-6 mb-2">
                    <label>Cek Pengalaman</label>
                    <select class="form-control" wire:model.defer="form.cek_pengalaman">
                        <option value="0">Tidak</option>
                        <option value="1">Ya</option>
                    </select>
                </div>
                <div class="col-md-6 mb-2">
                    <label>Gaji Diminta</label>
                    <input type="number" class="form-control" wire:model.defer="form.gaji_diminta">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-secondary" wire:click="$set('showForm', false)">Batal</button>
        </form>
    @else
        @if($personal)
            <div class="row mb-2">
                <div class="col-md-4">Nama</div>
                <div class="col-md-8">{{ $personal->nama }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4">Nama Keluarga</div>
                <div class="col-md-8">{{ $personal->nama_keluarga }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4">Tanggal Lahir</div>
                <div class="col-md-8">{{ $personal->date_lahir }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4">Kota Lahir</div>
                <div class="col-md-8">{{ $personal->kota_lahir }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4">Alamat</div>
                <div class="col-md-8">{{ $personal->alamat }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4">Jenis Kelamin</div>
                <div class="col-md-8">{{ $personal->jenis }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4">Agama</div>
                <div class="col-md-8">{{ $personal->agama }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4">Pendidikan</div>
                <div class="col-md-8">{{ $personal->pendidikan }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4">Cek Pengalaman</div>
                <div class="col-md-8">{{ $personal->cek_pengalaman ? 'Ya' : 'Tidak' }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4">Gaji Diminta</div>
                <div class="col-md-8">{{ $personal->gaji_diminta }}</div>
            </div>
            <button class="btn btn-info" wire:click="showEditForm">Edit Data Personal</button>
        @else
            <div class="p-3 text-danger">Data personal belum tersedia.</div>
            <button class="btn btn-success" wire:click="showEditForm">Tambah Data Personal</button>
        @endif
    @endif
</div>
