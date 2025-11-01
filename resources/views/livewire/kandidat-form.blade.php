<div>
    <form wire:submit.prevent="save" class="bg-gray-50 p-4 rounded shadow mb-4">
        <div class="mb-2">
            <label>ID Kandidat</label>
            <input type="text" wire:model="fields.ms_hr_kandidat_emp_id" class="border rounded px-2 py-1 w-full" {{ $mode==='edit' ? 'readonly' : '' }} />
        </div>
        <div class="mb-2">
            <label>Status</label>
            <input type="text" wire:model="fields.ms_status_id" class="border rounded px-2 py-1 w-full" />
        </div>
        <div class="mb-2">
            <label>Tanggal Kandidat</label>
            <input type="date" wire:model="fields.date_kandidat" class="border rounded px-2 py-1 w-full" />
        </div>
        <div class="flex gap-2 mt-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            <button type="button" class="bg-gray-300 px-4 py-2 rounded" wire:click="$emit('cancelKandidatForm')">Batal</button>
        </div>
    </form>
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-2">{{ session('success') }}</div>
    @endif
</div>
