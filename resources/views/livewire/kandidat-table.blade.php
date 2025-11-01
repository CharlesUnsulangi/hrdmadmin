<div>
    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="px-4 py-2 border">ID Kandidat</th>
                <th class="px-4 py-2 border">Status</th>
                <th class="px-4 py-2 border">Tanggal Kandidat</th>
                <th class="px-4 py-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kandidat as $row)
            <tr>
                <td class="border px-4 py-2">{{ $row->ms_hr_kandidat_emp_id }}</td>
                <td class="border px-4 py-2">{{ $row->ms_status_id }}</td>
                <td class="border px-4 py-2">{{ $row->date_kandidat }}</td>
                <td class="border px-4 py-2">
                    <a href="#" class="text-blue-600" wire:click.prevent="$emit('editKandidat', {{ $row->ms_hr_kandidat_emp_id }})">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $kandidat->links() }}
    </div>
</div>
