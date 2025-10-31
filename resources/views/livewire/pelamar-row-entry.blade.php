<div class="bg-white p-4 rounded shadow mb-4">
    @if($successMessage)
        <div class="mb-2 p-2 bg-green-100 text-green-800 rounded">{{ $successMessage }}</div>
    @endif
    <form wire:submit.prevent="simpanPelamar" class="flex flex-wrap gap-4 items-end">
        <div>
            <label class="block text-xs font-semibold mb-1">Nama</label>
            <input type="text" wire:model.defer="nama" class="border rounded px-2 py-1" required />
        </div>
        <div>
            <label class="block text-xs font-semibold mb-1">Email</label>
            <input type="email" wire:model.defer="email" class="border rounded px-2 py-1" required />
        </div>
        <div>
            <label class="block text-xs font-semibold mb-1">No HP</label>
            <input type="text" wire:model.defer="no_hp" class="border rounded px-2 py-1" required />
        </div>
        <div>
            <label class="block text-xs font-semibold mb-1">Status</label>
            <input type="text" wire:model.defer="status" class="border rounded px-2 py-1" />
        </div>
        <div>
            <label class="block text-xs font-semibold mb-1">Rating</label>
            <select wire:model.defer="rating" class="border rounded px-2 py-1">
                <option value="">-</option>
                @for($i=1;$i<=5;$i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div>
            <label class="block text-xs font-semibold mb-1">Asal Lamaran</label>
            <select wire:model.defer="asal_lamaran" class="border rounded px-2 py-1" required>
                <option value="">Pilih</option>
                @foreach($asalLamaranOptions as $option)
                    <option value="{{ $option->ms_hr_from_id }}">{{ $option->form_hr_desc }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit" class="bg-blue-700 text-white font-bold px-4 py-2 rounded shadow-lg border border-blue-900 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-400" style="background-color:#1d4ed8;color:#fff;font-weight:bold;">Simpan</button>
        </div>
    </form>
</div>
