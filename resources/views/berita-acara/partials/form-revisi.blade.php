<div class="card border-success">
    <div class="card-header bg-success text-white">
        <h6 class="mb-0">
            <i class="fas fa-edit me-2"></i>Data Revisi BA Revisi
            <button type="button" class="btn btn-sm btn-outline-light float-end" onclick="addRevisi()">
                <i class="fas fa-plus me-1"></i>Tambah Item Revisi
            </button>
        </h6>
    </div>
    <div class="card-body">
        <div id="revisiContainer">
            <!-- Dynamic revisi sections will be added here -->
        </div>
        
        <div class="alert alert-info" id="noRevisiAlert">
            <i class="fas fa-info-circle me-2"></i>
            Belum ada item revisi yang ditambahkan. Klik "Tambah Item Revisi" untuk menambah data revisi.
        </div>
    </div>
</div>

<!-- Revisi Template -->
<template id="revisiTemplate">
    <div class="revisi-section border rounded p-3 mb-3" style="background-color: #d1e7dd;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="mb-0 text-success">
                <i class="fas fa-file-alt me-2"></i>Item Revisi <span class="revisi-number"></span>
            </h6>
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeRevisi(this)">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Field Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="revisi[INDEX][field]" 
                       placeholder="Nama field yang direvisi..." required>
                <div class="form-text">Contoh: nama_karyawan, gaji_pokok, tanggal_masuk</div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Database & Field Info</label>
                <div class="row">
                    <div class="col-6">
                        <input type="text" class="form-control" name="revisi[INDEX][database_name]" 
                               placeholder="Database name">
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" name="revisi[INDEX][field_name]" 
                               placeholder="Field name">
                    </div>
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label">Tipe Data Revisi</label>
                <select class="form-select revisi-type" name="revisi_type[INDEX]" onchange="toggleRevisiFields(this, INDEX)">
                    <option value="">Pilih tipe data...</option>
                    <option value="text">Text/String</option>
                    <option value="number">Number/Quantity</option>
                    <option value="money">Money/Currency</option>
                    <option value="date">Date</option>
                </select>
            </div>

            <!-- Text Fields -->
            <div class="revisi-fields text-fields" id="textFields_INDEX" style="display: none;">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Text Salah</label>
                    <input type="text" class="form-control" name="revisi[INDEX][text_salah]" 
                           placeholder="Data text yang salah">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Text Benar</label>
                    <input type="text" class="form-control" name="revisi[INDEX][text_benar]" 
                           placeholder="Data text yang benar">
                </div>
            </div>

            <!-- Number Fields -->
            <div class="revisi-fields number-fields" id="numberFields_INDEX" style="display: none;">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Quantity Salah</label>
                    <input type="number" class="form-control" name="revisi[INDEX][qty_salah]" 
                           placeholder="Jumlah yang salah">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Quantity Benar</label>
                    <input type="number" class="form-control" name="revisi[INDEX][qty_benar]" 
                           placeholder="Jumlah yang benar">
                </div>
            </div>

            <!-- Money Fields -->
            <div class="revisi-fields money-fields" id="moneyFields_INDEX" style="display: none;">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Money Salah (Rp)</label>
                    <input type="number" class="form-control money-input" name="revisi[INDEX][money_salah]" 
                           placeholder="0" step="0.01">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Money Benar (Rp)</label>
                    <input type="number" class="form-control money-input" name="revisi[INDEX][money_benar]" 
                           placeholder="0" step="0.01">
                </div>
            </div>

            <!-- Date Fields -->
            <div class="revisi-fields date-fields" id="dateFields_INDEX" style="display: none;">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Date Salah</label>
                    <input type="date" class="form-control" name="revisi[INDEX][date_salah]">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Date Benar</label>
                    <input type="date" class="form-control" name="revisi[INDEX][date_benar]">
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label">Alasan Revisi <span class="text-danger">*</span></label>
                <textarea class="form-control" name="revisi[INDEX][reason_desc]" rows="3" 
                          placeholder="Jelaskan alasan dilakukan revisi..." required></textarea>
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label">Query ID (Optional)</label>
                <textarea class="form-control" name="revisi[INDEX][query_id]" rows="2" 
                          placeholder="SQL query atau ID transaksi terkait..."></textarea>
            </div>
        </div>
    </div>
</template>

<script>
let revisiIndex = 0;

function addRevisi() {
    const template = document.getElementById('revisiTemplate');
    const clone = template.content.cloneNode(true);
    
    // Replace INDEX with actual index
    let html = clone.innerHTML.replace(/INDEX/g, revisiIndex);
    
    // Update revisi number
    const wrapper = document.createElement('div');
    wrapper.innerHTML = html;
    wrapper.querySelector('.revisi-number').textContent = revisiIndex + 1;
    
    // Add to container
    document.getElementById('revisiContainer').appendChild(wrapper.firstElementChild);
    
    // Hide no revisi alert
    document.getElementById('noRevisiAlert').style.display = 'none';
    
    revisiIndex++;
    updateRevisiNumbers();
}

function removeRevisi(button) {
    Swal.fire({
        title: 'Konfirmasi',
        text: 'Hapus item revisi ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            button.closest('.revisi-section').remove();
            updateRevisiNumbers();
            
            // Show no revisi alert if no revisi left
            if (document.querySelectorAll('.revisi-section').length === 0) {
                document.getElementById('noRevisiAlert').style.display = 'block';
            }
        }
    });
}

function toggleRevisiFields(select, index) {
    const section = select.closest('.revisi-section');
    const allFields = section.querySelectorAll('.revisi-fields');
    
    // Hide all fields first
    allFields.forEach(field => {
        field.style.display = 'none';
        // Clear values when hiding
        field.querySelectorAll('input, textarea').forEach(input => {
            input.value = '';
        });
    });
    
    // Show selected type fields
    const selectedType = select.value;
    if (selectedType) {
        const targetField = section.querySelector(`#${selectedType}Fields_${index}`);
        if (targetField) {
            targetField.style.display = 'block';
        }
    }
}

function updateRevisiNumbers() {
    const sections = document.querySelectorAll('.revisi-section');
    sections.forEach((section, index) => {
        section.querySelector('.revisi-number').textContent = index + 1;
    });
}

// Money input formatting
$(document).on('input', '.money-input', function() {
    let value = $(this).val().replace(/[^\d]/g, '');
    if (value) {
        // Format as currency
        value = parseInt(value).toLocaleString('id-ID');
        $(this).val(value);
    }
});

// Add first revisi on load if this is create mode
document.addEventListener('DOMContentLoaded', function() {
    // Check if we're on create page by looking for form action
    const isCreateMode = document.querySelector('form[action*="berita-acara"][method="POST"]') && 
                        !document.querySelector('input[name="_method"][value="PUT"]');
    
    // Only auto-add if container is empty and we're in create mode
    if (isCreateMode && document.getElementById('revisiContainer').children.length === 0) {
        console.log('Auto-adding first revisi for BA Revisi create mode');
        addRevisi();
    }
});
</script>