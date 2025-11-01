<div>
    <h5>Sosial Media Pelamar</h5>
    <button class="btn btn-success mb-2" wire:click="showAddForm">Tambah Sosial Media</button>
    @if($showForm)
        <form wire:submit.prevent="saveSosmed" class="mb-3">
            <div class="row">
                <div class="col-md-8 mb-2">
                    <label>Link Sosial Media</label>
                    <input type="text" class="form-control" wire:model.defer="form.sosmed_link">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-secondary" wire:click="$set('showForm', false)">Batal</button>
        </form>
    @endif
    <ul class="list-group">
        @forelse($sosmedList as $item)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{ $item->sosmed_link }}</span>
                <span>
                    <button class="btn btn-sm btn-info" wire:click="showEditForm({{ $item->id }})">Edit</button>
                    <button class="btn btn-sm btn-danger" wire:click="deleteSosmed({{ $item->id }})">Hapus</button>
                </span>
            </li>
        @empty
            <li class="list-group-item text-danger">Belum ada data sosial media.</li>
        @endforelse
    </ul>
</div>
