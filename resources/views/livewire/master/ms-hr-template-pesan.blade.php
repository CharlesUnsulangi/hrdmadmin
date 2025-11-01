<div>
    <h5 class="mb-3">Master Template Pesan WhatsApp</h5>
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form wire:submit.prevent="{{ $edit_id ? 'update' : 'store' }}" class="row g-2 align-items-end mb-3">
        <div class="col-md-3">
            <label class="form-label">Kode Template</label>
            <input type="text" class="form-control @error('msg_code') is-invalid @enderror" wire:model.defer="msg_code" {{ $edit_id ? 'readonly' : '' }}>
            @error('msg_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Isi Pesan</label>
            <input type="text" class="form-control @error('msg_text') is-invalid @enderror" wire:model.defer="msg_text">
            @error('msg_text') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                    <th style="width: 120px">Kode</th>
                    <th>Isi Pesan</th>
                    <th style="width: 120px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $row)
                <tr>
                    <td>{{ $row->msg_code }}</td>
                    <td>{{ $row->msg_text }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" wire:click="edit('{{ $row->id }}')">Edit</button>
                        <button class="btn btn-sm btn-danger" wire:click="destroy('{{ $row->id }}')" onclick="return confirm('Yakin hapus template ini?')">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center">Belum ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
