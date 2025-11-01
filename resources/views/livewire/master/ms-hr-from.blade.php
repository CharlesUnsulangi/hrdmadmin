<div>
    <h5 class="mb-3">Master Asal Lamaran</h5>
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form wire:submit.prevent="{{ $edit_id ? 'update' : 'store' }}" class="row g-2 align-items-end mb-3">
        <div class="col-md-4">
            <label class="form-label">ID Asal Lamaran</label>
            <input type="text" class="form-control @error('ms_hr_from_id') is-invalid @enderror" wire:model.defer="ms_hr_from_id" {{ $edit_id ? 'readonly' : '' }}>
            @error('ms_hr_from_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-5">
            <label class="form-label">Deskripsi</label>
            <input type="text" class="form-control @error('form_hr_desc') is-invalid @enderror" wire:model.defer="form_hr_desc">
            @error('form_hr_desc') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">{{ $edit_id ? 'Update' : 'Tambah' }}</button>
            @if($edit_id)
                <button type="button" class="btn btn-secondary ms-2" wire:click="resetForm">Batal</button>
            @endif
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width: 180px">ID Asal Lamaran</th>
                    <th>Deskripsi</th>
                    <th style="width: 120px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $row)
                <tr>
                    <td>{{ $row->ms_hr_from_id }}</td>
                    <td>{{ $row->form_hr_desc }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" wire:click="edit('{{ $row->ms_hr_from_id }}')">Edit</button>
                        <button class="btn btn-sm btn-danger" wire:click="destroy('{{ $row->ms_hr_from_id }}')" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center">Belum ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
