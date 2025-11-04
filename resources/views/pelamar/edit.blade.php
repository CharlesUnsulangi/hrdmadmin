@extends('layouts.app')
@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Edit Pelamar</h1>
    <form action="{{ route('pelamar.update', $pelamar->tr_hr_pelamar_main_id) }}" method="POST" class="bg-white shadow rounded p-4 max-w-lg">
        @csrf
        @method('PUT')
        <div class="mb-4">
        <div class="mb-4">
            <label class="block mb-1">User Terakhir Update</label>
            <input type="text" class="w-full border rounded px-3 py-2 bg-gray-100" value="{{ auth()->user()->username ?? '-' }}" readonly>
            <input type="hidden" name="ms_hr_user_id" value="{{ auth()->user()->id ?? '-' }}">
        </div>
            <label class="block mb-1">Nama</label>
            <input type="text" name="nama" class="w-full border rounded px-3 py-2" value="{{ old('nama', $pelamar->nama) }}">
            @error('nama')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input type="email" name="email" class="w-full border rounded px-3 py-2" value="{{ old('email', $pelamar->email) }}">
            @error('email')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1">No HP</label>
            <input type="text" name="no_hp" class="w-full border rounded px-3 py-2" value="{{ old('no_hp', $pelamar->no_hp) }}">
            @error('no_hp')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="">-- Pilih Status --</option>
                @foreach(\App\Models\MsHrPelamarStatus::all() as $status)
                    <option value="{{ $status->ms_hr_pelamar_status_id }}" {{ old('status', $pelamar->status) == $status->ms_hr_pelamar_status_id ? 'selected' : '' }}>{{ $status->status_desc }}</option>
                @endforeach
            </select>
            @error('status')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1">Posisi</label>
            <select name="ms_hr_posisi_id" class="w-full border rounded px-3 py-2">
                <option value="">-- Pilih Posisi --</option>
                @foreach(\App\Models\MsHrPosisi::all() as $posisi)
                    <option value="{{ $posisi->ms_hr_posisi_id }}" {{ old('ms_hr_posisi_id', $pelamar->ms_hr_posisi_id) == $posisi->ms_hr_posisi_id ? 'selected' : '' }}>{{ $posisi->posisi_desc }}</option>
                @endforeach
            </select>
            @error('ms_hr_posisi_id')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1">Rating</label>
            <div class="flex gap-2">
                @for($i = 1; $i <= 5; $i++)
                    <label class="inline-flex items-center">
                        <input type="radio" name="rating" value="{{ $i }}" {{ old('rating', $pelamar->rating) == $i ? 'checked' : '' }}>
                        <span class="ml-1">{{ $i }}</span>
                    </label>
                @endfor
            </div>
            @error('rating')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1">Asal Lamaran</label>
            <select name="ms_hr_from_id" class="w-full border rounded px-3 py-2">
                <option value="">-- Pilih Asal Lamaran --</option>
                @foreach(\App\Models\MsHrFrom::all() as $from)
                    <option value="{{ $from->ms_hr_from_id }}" {{ old('ms_hr_from_id', $pelamar->ms_hr_from_id) == $from->ms_hr_from_id ? 'selected' : '' }}>{{ $from->form_hr_desc }}</option>
                @endforeach
            </select>
            @error('ms_hr_from_id')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1">Link CV</label>
            <input type="text" name="link_cv" class="w-full border rounded px-3 py-2" value="{{ old('link_cv', $pelamar->link_cv) }}">
            @error('link_cv')<div class="text-red-600 text-xs">{{ $message }}</div>@enderror
        </div>

        <div class="mb-4 flex gap-6">
            <label class="inline-flex items-center">
                <input type="checkbox" name="cek_shortlist" value="1" {{ old('cek_shortlist', $pelamar->cek_shortlist) ? 'checked' : '' }}>
                <span class="ml-2">Cek Shortlist</span>
            </label>
            <label class="inline-flex items-center">
                <input type="checkbox" name="cek_priority" value="1" {{ old('cek_priority', $pelamar->cek_priority) ? 'checked' : '' }}>
                <span class="ml-2">Cek Priority</span>
            </label>
        </div>
    <button type="submit" class="bg-yellow-400 text-black font-bold px-4 py-2 rounded border border-yellow-600 shadow">Update</button>
        <a href="{{ route('pelamar.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>

    <div class="my-4">
        <div class="row g-2">
            <div class="col-md-3">
                <form action="{{ route('pelamar.jadikanKandidat', $pelamar->tr_hr_pelamar_main_id) }}" method="POST" class="d-inline w-100">
                    @csrf
                    <button type="submit" class="btn btn-success w-100">Jadikan Kandidat</button>
                </form>
            </div>
            <div class="col-md-3">
                <a href="{{ route('pelamar.interview', $pelamar->tr_hr_pelamar_main_id) }}" class="btn btn-primary w-100">Interview</a>
            </div>
            <div class="col-md-3">
                <form action="{{ route('pelamar.tolak', $pelamar->tr_hr_pelamar_main_id) }}" method="POST" class="d-inline w-100">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">Tolak</button>
                </form>
            </div>
            <div class="col-md-3">
                <a href="{{ route('pelamar.diskusi', $pelamar->tr_hr_pelamar_main_id) }}" class="btn btn-warning w-100">Diskusi</a>
            </div>
        </div>
        <div class="row g-2 mt-2">
            <div class="col-md-4">
                <a href="{{ url('/interview/create?tr_hr_pelamar_id=' . $pelamar->tr_hr_pelamar_main_id) }}" class="btn btn-info w-100">Confirm Jadwal Interview</a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('pelamar.reschedule', $pelamar->tr_hr_pelamar_main_id) }}" class="btn btn-secondary w-100">Reschedule Interview</a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('pelamar.backgroundCheck', $pelamar->tr_hr_pelamar_main_id) }}" class="btn btn-dark w-100">Background Check</a>
            </div>
        </div>
        <div class="row g-2 mt-2">
            <div class="col-md-6">
                <a href="{{ route('interview_main.create', ['pelamar_id' => $pelamar->tr_hr_pelamar_main_id]) }}" class="btn btn-outline-primary w-100">
                    Lakukan Interview
                </a>
            </div>
        </div>
    </div>

    <ul class="nav nav-tabs mt-5" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pengalaman-tab" data-bs-toggle="tab" data-bs-target="#pengalaman" type="button" role="tab">Pengalaman</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="interview-tab" data-bs-toggle="tab" data-bs-target="#interview" type="button" role="tab" onclick="loadInterviewData()">Hasil Interview</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab" onclick="loadPersonalData()">Data Personal</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="sosmed-tab" data-bs-toggle="tab" data-bs-target="#sosmed" type="button" role="tab" onclick="loadSosmedData()">Sosial Media</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="pengalaman" role="tabpanel">
            @include('pelamar.pengalaman', ['pelamar' => $pelamar])
        </div>
        <div class="tab-pane fade" id="interview" role="tabpanel">
            <div class="p-4">
                <h5>Data Interview</h5>
                <div id="interview-content">
                    <div class="text-center py-4">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="personal" role="tabpanel">
            <div class="p-4">
                <h5>Data Personal</h5>
                <div id="personal-content">
                    <div class="text-center py-4">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="sosmed" role="tabpanel">
            <div class="p-4">
                <h5>Data Sosial Media</h5>
                <div id="sosmed-content">
                    <div class="text-center py-4">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const pelamarId = '{{ $pelamar->tr_hr_pelamar_main_id }}';

function loadInterviewData() {
    const content = document.getElementById('interview-content');
    if (content.dataset.loaded) return;
    
    fetch(`/api/pelamar/${pelamarId}/interview`)
        .then(response => response.json())
        .then(data => {
            let html = '<div class="table-responsive"><table class="table table-striped">';
            html += '<thead><tr><th>Tanggal</th><th>Interviewer</th><th>Hasil</th><th>Catatan</th></tr></thead><tbody>';
            
            if (data.length > 0) {
                data.forEach(item => {
                    html += `<tr>
                        <td>${item.tanggal}</td>
                        <td>${item.interviewer}</td>
                        <td><span class="badge bg-${item.hasil === 'LULUS' ? 'success' : 'danger'}">${item.hasil}</span></td>
                        <td>${item.catatan || '-'}</td>
                    </tr>`;
                });
            } else {
                html += '<tr><td colspan="4" class="text-center">Belum ada data interview</td></tr>';
            }
            
            html += '</tbody></table></div>';
            content.innerHTML = html;
            content.dataset.loaded = true;
        })
        .catch(error => {
            content.innerHTML = '<div class="alert alert-danger">Error loading data</div>';
        });
}

function loadPersonalData() {
    const content = document.getElementById('personal-content');
    if (content.dataset.loaded) return;
    
    fetch(`/api/pelamar/${pelamarId}/personal`)
        .then(response => response.json())
        .then(data => {
            let html = '<div class="row">';
            html += `
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Alamat KTP</label>
                        <textarea class="form-control" readonly>${data.alamat_ktp || '-'}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Domisili</label>
                        <textarea class="form-control" readonly>${data.alamat_domisili || '-'}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="text" class="form-control" value="${data.tanggal_lahir || '-'}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Agama</label>
                        <input type="text" class="form-control" value="${data.agama || '-'}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status Pernikahan</label>
                        <input type="text" class="form-control" value="${data.status_nikah || '-'}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pendidikan Terakhir</label>
                        <input type="text" class="form-control" value="${data.pendidikan || '-'}" readonly>
                    </div>
                </div>
            `;
            html += '</div>';
            content.innerHTML = html;
            content.dataset.loaded = true;
        })
        .catch(error => {
            content.innerHTML = '<div class="alert alert-danger">Error loading data</div>';
        });
}

function loadSosmedData() {
    const content = document.getElementById('sosmed-content');
    if (content.dataset.loaded) return;
    
    fetch(`/api/pelamar/${pelamarId}/sosmed`)
        .then(response => response.json())
        .then(data => {
            let html = '<div class="table-responsive"><table class="table table-striped">';
            html += '<thead><tr><th>Platform</th><th>Username/Link</th><th>Status</th></tr></thead><tbody>';
            
            if (data.length > 0) {
                data.forEach(item => {
                    html += `<tr>
                        <td><i class="fab fa-${item.platform.toLowerCase()}"></i> ${item.platform}</td>
                        <td><a href="${item.link}" target="_blank">${item.username}</a></td>
                        <td><span class="badge bg-${item.status === 'VERIFIED' ? 'success' : 'warning'}">${item.status}</span></td>
                    </tr>`;
                });
            } else {
                html += '<tr><td colspan="3" class="text-center">Belum ada data sosial media</td></tr>';
            }
            
            html += '</tbody></table></div>';
            content.innerHTML = html;
            content.dataset.loaded = true;
        })
        .catch(error => {
            content.innerHTML = '<div class="alert alert-danger">Error loading data</div>';
        });
}
</script>
@endsection
