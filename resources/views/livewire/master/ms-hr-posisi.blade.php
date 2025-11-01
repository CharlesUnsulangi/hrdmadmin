<div>
    <h5>Master Posisi</h5>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form wire:submit.prevent="{{ $edit_id ? 'update' : 'store' }}" class="mb-3">
        <div class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label">ID Posisi</label>
                <input type="text" wire:model.defer="ms_hr_posisi_id" class="form-control @error('ms_hr_posisi_id') is-invalid @enderror" {{ $edit_id ? 'readonly' : '' }}>
                @error('ms_hr_posisi_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Nama Posisi</label>
                <input type="text" wire:model.defer="posisi_desc" class="form-control @error('posisi_desc') is-invalid @enderror">
                @error('posisi_desc')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">{{ $edit_id ? 'Update' : 'Tambah' }}</button>
                @if($edit_id)
                    <button type="button" wire:click="resetForm" class="btn btn-secondary ms-2">Batal</button>
                @endif
            </div>
        </div>
    </form>
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>ID Posisi</th>
                <th>Nama Posisi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->ms_hr_posisi_id }}</td>
                <td>{{ $row->posisi_desc }}</td>
                <td>
                    <button class="btn btn-sm btn-warning" wire:click="edit('{{ $row->ms_hr_posisi_id }}')">Edit</button>
                    <button class="btn btn-sm btn-danger" wire:click="destroy('{{ $row->ms_hr_posisi_id }}')">Hapus</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
