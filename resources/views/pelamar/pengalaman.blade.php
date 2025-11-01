<div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <h5>Daftar Pengalaman Kerja</h5>
    <div class="mb-3">
        <button class="btn btn-success" onclick="toggleFormPengalaman()">
            <i class="bi bi-plus-circle me-1"></i>Tambah Pengalaman
        </button>
    </div>
    
    <!-- Form Tambah/Edit Pengalaman -->
    <div id="formPengalaman" class="card mb-4" style="display: none;">
        <div class="card-header">
            <h6 class="mb-0">Form Pengalaman Kerja</h6>
        </div>
        <div class="card-body">
            <form id="pengalamanForm" action="{{ route('pelamar.pengalaman.store', $pelamar->tr_hr_pelamar_main_id) }}" method="POST">
                @csrf
                <!-- Hidden field untuk hp_hrd dari data pelamar -->
                <input type="hidden" name="hp_hrd" value="{{ $pelamar->no_hp }}">
                <input type="hidden" name="nama_hrd" value="">
                <input type="hidden" name="hp_atasan" value="">
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Perusahaan *</label>
                        <input type="text" class="form-control" name="perusahaan" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jabatan Awal</label>
                        <input type="text" class="form-control" name="jabatan_awal">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jabatan Akhir</label>
                        <input type="text" class="form-control" name="jabatan_akhir">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Masuk *</label>
                        <input type="date" class="form-control" name="tgl_start" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Keluar *</label>
                        <input type="date" class="form-control" name="tgl_end" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Gaji Awal</label>
                        <input type="number" class="form-control" name="gaji_awal" placeholder="0">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Gaji Akhir</label>
                        <input type="number" class="form-control" name="gaji_akhir" placeholder="0">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Alasan Resign</label>
                        <textarea class="form-control" name="alasan_resign" rows="3"></textarea>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary" onclick="confirmSubmitPengalaman()">
                        <i class="bi bi-save me-1"></i>Simpan
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="toggleFormPengalaman()">
                        <i class="bi bi-x-circle me-1"></i>Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Pengalaman -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Perusahaan</th>
                            <th>Jabatan Awal</th>
                            <th>Jabatan Akhir</th>
                            <th>Tanggal Masuk</th>
                            <th>Tanggal Keluar</th>
                            <th>Gaji Awal</th>
                            <th>Gaji Akhir</th>
                            <th>Alasan Resign</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pelamar->pengalaman as $pengalaman)
                            <tr>
                                <td>{{ $pengalaman->perusahaan ?? '-' }}</td>
                                <td>{{ $pengalaman->jabatan_awal ?? '-' }}</td>
                                <td>{{ $pengalaman->jabatan_akhir ?? '-' }}</td>
                                <td>{{ $pengalaman->tgl_start ? \Carbon\Carbon::parse($pengalaman->tgl_start)->format('d/m/Y') : '-' }}</td>
                                <td>{{ $pengalaman->tgl_end ? \Carbon\Carbon::parse($pengalaman->tgl_end)->format('d/m/Y') : '-' }}</td>
                                <td>{{ $pengalaman->gaji_awal ? 'Rp ' . number_format($pengalaman->gaji_awal, 0, ',', '.') : '-' }}</td>
                                <td>{{ $pengalaman->gaji_akhir ? 'Rp ' . number_format($pengalaman->gaji_akhir, 0, ',', '.') : '-' }}</td>
                                <td>{{ $pengalaman->alasan_resign ?? '-' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-warning" onclick="editPengalaman({{ $pengalaman->tr_hr_pelamar_pengalaman_id }})">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" onclick="deletePengalaman({{ $pengalaman->tr_hr_pelamar_pengalaman_id }})">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">Belum ada data pengalaman kerja</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function toggleFormPengalaman() {
    const form = document.getElementById('formPengalaman');
    const isVisible = form.style.display !== 'none';
    
    if (isVisible) {
        form.style.display = 'none';
        document.getElementById('pengalamanForm').reset();
    } else {
        form.style.display = 'block';
        // Focus pada field pertama
        form.querySelector('input[name="perusahaan"]').focus();
    }
}

function confirmSubmitPengalaman() {
    // Validasi form sebelum menampilkan konfirmasi
    const form = document.getElementById('pengalamanForm');
    const perusahaan = form.querySelector('input[name="perusahaan"]').value.trim();
    const tglStart = form.querySelector('input[name="tgl_start"]').value;
    const tglEnd = form.querySelector('input[name="tgl_end"]').value;
    
    if (!perusahaan) {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Nama perusahaan harus diisi!',
            confirmButtonColor: '#d33'
        });
        return;
    }
    
    if (!tglStart || !tglEnd) {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Tanggal masuk dan keluar harus diisi!',
            confirmButtonColor: '#d33'
        });
        return;
    }
    
    // Tampilkan konfirmasi SweetAlert
    Swal.fire({
        title: 'Konfirmasi Simpan',
        text: `Apakah Anda yakin ingin menyimpan pengalaman kerja di ${perusahaan}?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Simpan!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Menyimpan...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Submit form
            form.submit();
        }
    });
}

function editPengalaman(id) {
    // Implementasi edit - bisa pakai modal atau load data ke form
    console.log('Edit pengalaman ID:', id);
    // TODO: Load data pengalaman dan populate form
}

function deletePengalaman(id) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: 'Apakah Anda yakin ingin menghapus pengalaman kerja ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Menghapus...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Submit delete request
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/pelamar/pengalaman/${id}`;
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            
            form.appendChild(csrfToken);
            form.appendChild(methodField);
            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>