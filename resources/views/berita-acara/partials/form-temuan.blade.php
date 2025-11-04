<div class="card border-warning">
    <div class="card-header bg-warning text-dark">
        <h6 class="mb-0">
            <i class="fas fa-search me-2"></i>Data Pelaku BA Temuan
            <button type="button" class="btn btn-sm btn-outline-dark float-end" onclick="addPelaku()">
                <i class="fas fa-plus me-1"></i>Tambah Pelaku
            </button>
        </h6>
    </div>
    <div class="card-body">
        <div id="pelakuContainer">
            <!-- Dynamic pelaku sections will be added here -->
        </div>
        
        <div class="alert alert-info" id="noPelakuAlert">
            <i class="fas fa-info-circle me-2"></i>
            Belum ada pelaku yang ditambahkan. Klik "Tambah Pelaku" untuk menambah data pelaku.
        </div>
    </div>
</div>

<!-- Pelaku Template -->
<template id="pelakuTemplate">
    <div class="pelaku-section border rounded p-3 mb-3" style="background-color: #fff3cd;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="mb-0 text-warning">
                <i class="fas fa-user me-2"></i>Pelaku <span class="pelaku-number"></span>
            </h6>
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removePelaku(this)">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">User Pelaku <span class="text-danger">*</span></label>
                <select class="form-select" name="pelaku[INDEX][ms_user_id]" required>
                    <option value="">Pilih User...</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->username }} ({{ $user->role }})</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Kejadian <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="pelaku[INDEX][date_ba]" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Text BA <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="pelaku[INDEX][text_ba]" 
                       placeholder="Deskripsi kejadian..." required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Type Pelaku <span class="text-danger">*</span></label>
                <select class="form-select" name="pelaku[INDEX][ms_type_ba_pelaku_id]" required>
                    <option value="">Pilih Type...</option>
                    <option value="UTAMA">Pelaku Utama</option>
                    <option value="PENDUKUNG">Pelaku Pendukung</option>
                    <option value="SAKSI">Saksi</option>
                </select>
            </div>

            <div class="col-md-12">
                <label class="form-label">Jenis Pelanggaran</label>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="pelaku[INDEX][cek_fraud]" value="1">
                            <label class="form-check-label">
                                <i class="fas fa-exclamation-triangle text-danger me-1"></i>Fraud
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="pelaku[INDEX][cek_pelanggaran]" value="1">
                            <label class="form-check-label">
                                <i class="fas fa-ban text-warning me-1"></i>Pelanggaran
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="pelaku[INDEX][cek_kode_etik]" value="1">
                            <label class="form-check-label">
                                <i class="fas fa-gavel text-info me-1"></i>Kode Etik
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="pelaku[INDEX][cek_disiplin]" value="1">
                            <label class="form-check-label">
                                <i class="fas fa-clock text-primary me-1"></i>Disiplin
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="pelaku[INDEX][cek_berulang]" value="1">
                            <label class="form-check-label">
                                <i class="fas fa-redo text-secondary me-1"></i>Berulang
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
let pelakuIndex = 0;

function addPelaku() {
    const template = document.getElementById('pelakuTemplate');
    const clone = template.content.cloneNode(true);
    
    // Replace INDEX with actual index in all inputs
    const inputs = clone.querySelectorAll('[name*="INDEX"]');
    inputs.forEach(input => {
        input.name = input.name.replace('INDEX', pelakuIndex);
    });
    
    // Update pelaku number
    clone.querySelector('.pelaku-number').textContent = pelakuIndex + 1;
    
    // Add to container
    document.getElementById('pelakuContainer').appendChild(clone);
    
    // Hide no pelaku alert
    document.getElementById('noPelakuAlert').style.display = 'none';
    
    pelakuIndex++;
    updatePelakuNumbers();
}

function removePelaku(button) {
    Swal.fire({
        title: 'Konfirmasi',
        text: 'Hapus data pelaku ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            button.closest('.pelaku-section').remove();
            updatePelakuNumbers();
            
            // Show no pelaku alert if no pelaku left
            if (document.querySelectorAll('.pelaku-section').length === 0) {
                document.getElementById('noPelakuAlert').style.display = 'block';
            }
        }
    });
}

function updatePelakuNumbers() {
    const sections = document.querySelectorAll('.pelaku-section');
    sections.forEach((section, index) => {
        section.querySelector('.pelaku-number').textContent = index + 1;
    });
}

// Add first pelaku on load if this is create mode (not edit mode)
document.addEventListener('DOMContentLoaded', function() {
    // Check if we're on create page by looking for form action
    const isCreateMode = document.querySelector('form[action*="berita-acara"][method="POST"]') && 
                        !document.querySelector('input[name="_method"][value="PUT"]');
    
    // Only auto-add if container is empty and we're in create mode
    if (isCreateMode && document.getElementById('pelakuContainer').children.length === 0) {
        console.log('Auto-adding first pelaku for BA Temuan create mode');
        addPelaku();
    }
});
</script>