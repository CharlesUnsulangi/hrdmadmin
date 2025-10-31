<div>
    @if (session()->has('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-bordered table-striped table-hover align-middle shadow mb-4">
        <thead class="table-light">
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Asal Lamaran</th>
                <th>Rating</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $i => $row)
            <tr>
                <td><input type="text" wire:model.lazy="rows.{{ $i }}.nama" class="form-control form-control-sm @error('rows.'.$i.'.nama') is-invalid @enderror" required /></td>
                <td>
                    <input type="email" wire:model.lazy="rows.{{ $i }}.email" class="form-control form-control-sm @error('rows.'.$i.'.email') is-invalid @enderror" required pattern="^[^@\s]+@[^@\s]+\.[^@\s]+$" />
                    @error('rows.'.$i.'.email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    @if(!filter_var($row['email'], FILTER_VALIDATE_EMAIL) && !empty($row['email']))
                        <div class="text-danger small">Format email tidak valid. Contoh: user@email.com</div>
                    @endif
                </td>
                <td>
                    <input type="text" wire:model.lazy="rows.{{ $i }}.no_hp" class="form-control form-control-sm @error('rows.'.$i.'.no_hp') is-invalid @enderror" placeholder="62..." required pattern="^62[0-9]{7,}$" />
                    @error('rows.'.$i.'.no_hp')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    @if(!empty($row['no_hp']) && !preg_match('/^62[0-9]{7,}$/', $row['no_hp']))
                        <div class="text-danger small">Nomor HP harus diawali 62 dan minimal 10 digit.</div>
                    @endif
                </td>
                <td>
                    <select wire:model.defer="rows.{{ $i }}.ms_hr_from_id" class="form-select form-select-sm">
                        <option value="">-- Pilih --</option>
                        @foreach($asal_lamaran_options as $id => $desc)
                            <option value="{{ $id }}">{{ $desc }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="number" wire:model.defer="rows.{{ $i }}.rating" class="form-control form-control-sm w-75" min="0" max="5" /></td>
                <td><input type="text" wire:model.defer="rows.{{ $i }}.status" class="form-control form-control-sm" /></td>
                <td>
                    @if(empty($row['saved']))
                        <button wire:click.prevent="if(confirm('Yakin simpan data pelamar ini?')) saveRow({{ $i }})" class="btn btn-success btn-sm d-flex align-items-center gap-1" @if($errors->has('rows.'.$i.'.email') || $errors->has('rows.'.$i.'.no_hp')) disabled @endif>
                            <i class="bi bi-save"></i> Simpan
                        </button>
                    @else
                        <span class="text-success fw-bold">Tersimpan</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
