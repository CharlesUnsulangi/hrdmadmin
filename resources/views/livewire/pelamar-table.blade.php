<div>
    {{-- Filter dan kontrol atas tabel --}}
    <div class="mb-4">
    <button wire:click="toggleFormInput" class="bg-green-500 text-white px-4 py-2 rounded border border-green-700 shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">Tambah Pelamar</button>
    </div>
    <div class="flex flex-wrap gap-4 mb-4">
        <div>
            <label class="block text-sm font-medium">Asal Lamaran</label>
            <select wire:model="asalLamaran" class="border rounded px-2 py-1">
                <option value="">Semua</option>
                @foreach($asalLamaranOptions as $option)
                    <option value="{{ $option->ms_hr_from_id }}">{{ $option->form_hr_desc }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium">Rating Default</label>
            <select wire:model="ratingDefault" class="border rounded px-2 py-1">
                <option value="">-</option>
                @for($i=1;$i<=5;$i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div>
            <input type="text" wire:model="search" placeholder="Cari pelamar..." class="border rounded px-2 py-1" />
        </div>
    </div>

    {{-- Input dinamis satu per satu --}}
    @if($showFormInput ?? false)
    <div class="mb-6">
        <livewire:pelamar-row-entry :asal-lamaran="$asalLamaran" :rating-default="$ratingDefault" />
    </div>
    @endif

    {{-- Tabel daftar pelamar --}}
    <div class="bg-white shadow rounded p-4">
        <table class="min-w-full text-sm">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Status</th>
                    <th>Rating</th>
                    <th>Asal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- Loop pelamar, nanti diisi dari Livewire --}}
                @foreach($pelamars as $index => $pelamar)
                <tr class="{{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-white' }} hover:bg-green-50 border-b">
                    <td class="py-2 px-2">{{ $pelamar->nama }}</td>
                    <td class="py-2 px-2">{{ $pelamar->email }}</td>
                    <td class="py-2 px-2">{{ $pelamar->no_hp }}</td>
                    <td class="py-2 px-2">{{ $pelamar->status }}</td>
                    <td class="py-2 px-2">{{ $pelamar->rating }}</td>
                    <td class="py-2 px-2">{{ $pelamar->asal_lamaran }}</td>
                    <td class="py-2 px-2">
                        <button wire:click="showDetail({{ $pelamar->id }})" class="bg-blue-600 text-white font-bold px-2 py-1 rounded shadow hover:bg-blue-800">Detail</button>
                        <button wire:click="editPelamar({{ $pelamar->id }})" class="bg-green-600 text-white font-bold px-2 py-1 rounded shadow hover:bg-green-800 ml-2">Edit</button>
                        <button wire:click="arsipkanPelamar({{ $pelamar->id }})" class="bg-yellow-300 text-gray-900 font-bold px-2 py-1 rounded shadow hover:bg-yellow-400 ml-2">Arsip</button>
                        <button wire:click="kirimWa({{ $pelamar->id }})" class="bg-green-800 text-white font-bold px-2 py-1 rounded shadow hover:bg-green-900 ml-2">Kirim WA</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Paginasi Livewire --}}
        {{ $pelamars->links() }}
    </div>

    {{-- Modal detail/edit pelamar (akan diisi komponen detail) --}}
    @if($showDetailModal)
        <livewire:pelamar-detail :pelamar-id="$selectedPelamarId" />
    @endif
</div>
