<div>
    @if (session()->has('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    <form wire:submit.prevent="simpan" class="space-y-4">
        <div>
            <label class="block font-semibold">Nama</label>
            <input type="text" wire:model.defer="nama" class="input input-bordered w-full" maxlength="100">
            @error('nama') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block font-semibold">No HP</label>
            <input type="text" wire:model.defer="hp" class="input input-bordered w-full" maxlength="50">
            @error('hp') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block font-semibold">Email</label>
            <input type="email" wire:model.defer="email" class="input input-bordered w-full" maxlength="50">
            @error('email') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block font-semibold">Asal Lamaran</label>
            <select wire:model.defer="ms_hr_from_id" class="input input-bordered w-full">
                <option value="">-- Pilih Asal Lamaran --</option>
                @foreach($asal_lamaran_options as $id => $desc)
                    <option value="{{ $id }}">{{ $desc }}</option>
                @endforeach
            </select>
            @error('ms_hr_from_id') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block font-semibold">Rating</label>
            <input type="number" wire:model.defer="rating" class="input input-bordered w-24" min="0" max="5">
            @error('rating') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
