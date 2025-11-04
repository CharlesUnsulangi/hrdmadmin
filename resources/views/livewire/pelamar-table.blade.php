<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<div class="container py-4">
    <div class="row mb-3 align-items-end g-2">
        <div class="col-md-3 mb-2">
            <a href="{{ route('pelamar.create') }}" class="btn btn-success w-100 d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-plus-circle"></i> Tambah Pelamar
            </a>
        </div>
        <div class="col-md-3 mb-2">
            <label class="form-label">Asal Lamaran</label>
            <select wire:model="asalLamaran" class="form-select form-select-sm">
                <option value="">Semua</option>
                @foreach($asalLamaranOptions as $option)
                    <option value="{{ $option->ms_hr_from_id }}">{{ $option->form_hr_desc }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 mb-2">
            <label class="form-label">Rating</label>
            <select wire:model="ratingDefault" class="form-select form-select-sm">
                <option value="">-</option>
                @for($i=1;$i<=5;$i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="col-md-4 mb-2">
            <label class="form-label">Cari</label>
            <input type="text" wire:model="search" placeholder="Cari pelamar..." class="form-control form-control-sm" />
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="display:none">ID</th>
                            <th class="align-middle" style="cursor:pointer" wire:click="sortBy('nama')">
                                Nama
                                @if($sortField === 'nama')
                                    <i class="bi bi-caret-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-fill text-primary"></i>
                                @endif
                            </th>
                            <th class="align-middle">Tipe Pelamar</th>
                            <th class="align-middle" style="cursor:pointer" wire:click="sortBy('email')">
                                Email
                                @if($sortField === 'email')
                                    <i class="bi bi-caret-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-fill text-primary"></i>
                                @endif
                            </th>
                            <th class="align-middle" style="cursor:pointer" wire:click="sortBy('no_hp')">
                                No HP
                                @if($sortField === 'no_hp')
                                    <i class="bi bi-caret-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-fill text-primary"></i>
                                @endif
                            </th>
                            <th class="align-middle" style="cursor:pointer" wire:click="sortBy('status')">
                                Status
                                @if($sortField === 'status')
                                    <i class="bi bi-caret-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-fill text-primary"></i>
                                @endif
                            </th>
                            <th class="align-middle" style="cursor:pointer" wire:click="sortBy('cek_shortlist')">
                                Shortlist
                                @if($sortField === 'cek_shortlist')
                                    <i class="bi bi-caret-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-fill text-primary"></i>
                                @endif
                            </th>
                            <th class="align-middle" style="cursor:pointer" wire:click="sortBy('posisi')">
                                Posisi
                                @if($sortField === 'posisi')
                                    <i class="bi bi-caret-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-fill text-primary"></i>
                                @endif
                            </th>
                            <th class="align-middle" style="cursor:pointer" wire:click="sortBy('rating')">
                                Rating
                                @if($sortField === 'rating')
                                    <i class="bi bi-caret-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-fill text-primary"></i>
                                @endif
                            </th>
                            <th class="align-middle">User</th>
                            <th class="align-middle">Link CV</th>
                            <th class="align-middle" style="cursor:pointer" wire:click="sortBy('asal_lamaran')">
                                Asal
                                @if($sortField === 'asal_lamaran')
                                    <i class="bi bi-caret-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-fill text-primary"></i>
                                @endif
                            </th>
                            <th class="align-middle" style="cursor:pointer" wire:click="sortBy('date_created')">
                                Tanggal Input
                                @if($sortField === 'date_created')
                                    <i class="bi bi-caret-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-fill text-primary"></i>
                                @endif
                            </th>
                            <th class="align-middle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pelamars as $index => $pelamar)
                        <tr ondblclick="window.location='{{ route('pelamar.edit', $pelamar->tr_hr_pelamar_main_id ?? $pelamar->id) }}'" style="cursor:pointer;">
                            <td style="display:none">{{ $pelamar->tr_hr_pelamar_main_id ?? $pelamar->id }}</td>
                            <td>
                                <a href="{{ route('pelamar.edit', $pelamar->tr_hr_pelamar_main_id ?? $pelamar->id) }}" class="text-primary fw-bold text-decoration-underline" title="Edit Pelamar">
                                    {{ $pelamar->nama }}
                                </a>
                            </td>
                            <td>{{ $pelamar->tipePelamar->type_desc ?? '-' }}</td>
                            <td>{{ $pelamar->email }}</td>
                            <td>{{ $pelamar->no_hp }}</td>
                            <td>{{ $pelamar->statusPelamar->status_desc ?? $pelamar->status ?? '-' }}</td>
                            <td>
                                @if($pelamar->cek_shortlist)
                                    <span class="badge bg-success">&#10003;</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $pelamar->msHrPosisi->posisi_desc ?? '-' }}</td>
                            <td>
                                <span class="badge bg-primary fs-6 px-3 py-2">{{ $pelamar->rating }}</span>
                            </td>
                            <td>
                                @if($pelamar->ms_hr_user_id && $pelamar->ms_hr_user_id !== '-')
                                    {{ $pelamar->msHrUser->username ?? $pelamar->ms_hr_user_id }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($pelamar->link_cv)
                                    <a href="{{ $pelamar->link_cv }}" target="_blank" class="text-info text-decoration-underline">Lihat CV</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $pelamar->msHrFrom->form_hr_desc ?? '-' }}</td>
                            <td>{{ $pelamar->date_created ? \Carbon\Carbon::parse($pelamar->date_created)->format('d-m-Y H:i') : '-' }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button wire:click="showDetail({{ $pelamar->id }})" class="btn btn-sm btn-info" title="Detail"><i class="bi bi-eye"></i></button>
                                    <a href="{{ route('pelamar.edit', $pelamar->tr_hr_pelamar_main_id ?? $pelamar->id) }}" class="btn btn-sm btn-success" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                    <a href="{{ route('pelamar.interview', $pelamar->tr_hr_pelamar_main_id ?? $pelamar->id) }}" class="btn btn-sm btn-primary" title="Interview"><i class="bi bi-calendar-event"></i></a>
                                    <button wire:click="arsipkanPelamar({{ $pelamar->id }})" class="btn btn-sm btn-warning" title="Arsip"><i class="bi bi-archive"></i></button>
                                    <a href="{{ route('pelamar.kirimWaLink', $pelamar->tr_hr_pelamar_main_id ?? $pelamar->id) }}" target="_blank" class="btn btn-sm btn-dark" title="Kirim WA">
                                        <i class="bi bi-whatsapp"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $pelamars->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    @if($showDetailModal)
        <livewire:pelamar-detail :pelamar-id="$selectedPelamarId" />
    @endif
</div>
