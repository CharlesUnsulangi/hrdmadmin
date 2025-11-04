<div class="card border-danger">
    <div class="card-header bg-danger text-white">
        <h6 class="mb-0"><i class="fas fa-car-crash me-2"></i>Data Kecelakaan BA Laka</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="ms_truck_id" class="form-label">Truck ID <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('ms_truck_id') is-invalid @enderror" 
                       id="ms_truck_id" name="ms_truck_id" value="{{ old('ms_truck_id') }}" 
                       placeholder="Masukkan ID Truck..." required>
                <div class="form-text">Contoh: TRK001, B-1234-AB</div>
                @error('ms_truck_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-12 mb-3">
                <label for="ms_driver_id" class="form-label">Driver ID <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('ms_driver_id') is-invalid @enderror" 
                       id="ms_driver_id" name="ms_driver_id" value="{{ old('ms_driver_id') }}" 
                       placeholder="Masukkan ID Driver..." required>
                <div class="form-text">Contoh: DRV001, ID karyawan driver</div>
                @error('ms_driver_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-12 mb-3">
                <label for="note_kronologi" class="form-label">Kronologi Kejadian <span class="text-danger">*</span></label>
                <textarea class="form-control @error('note_kronologi') is-invalid @enderror" 
                          id="note_kronologi" name="note_kronologi" rows="8" required 
                          placeholder="Deskripsikan kronologi kejadian secara detail...">{{ old('note_kronologi') }}</textarea>
                <div class="form-text">
                    Jelaskan secara detail urutan kejadian, lokasi, waktu, penyebab, dan dampak yang terjadi.
                </div>
                @error('note_kronologi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Template kronologi helper -->
        <div class="alert alert-info">
            <h6><i class="fas fa-lightbulb me-2"></i>Template Kronologi:</h6>
            <ul class="mb-0 small">
                <li><strong>Waktu:</strong> Jam dan tanggal kejadian</li>
                <li><strong>Lokasi:</strong> Tempat kejadian yang spesifik</li>
                <li><strong>Kondisi:</strong> Cuaca, jalan, lalu lintas</li>
                <li><strong>Kronologi:</strong> Urutan kejadian step by step</li>
                <li><strong>Penyebab:</strong> Analisa penyebab kecelakaan</li>
                <li><strong>Dampak:</strong> Kerugian material/korban</li>
                <li><strong>Tindakan:</strong> Langkah yang telah diambil</li>
            </ul>
        </div>
    </div>
</div>

<script>
// Auto-suggestion for truck and driver IDs (if master data is available)
$(document).ready(function() {
    // You can add autocomplete functionality here if master tables exist
    
    // Character counter for kronologi
    $('#note_kronologi').on('input', function() {
        const length = $(this).val().length;
        const maxLength = 1000; // Adjust as needed
        
        if (length > maxLength * 0.9) {
            $(this).addClass('border-warning');
        } else {
            $(this).removeClass('border-warning');
        }
    });
    
    // Validation helpers
    $('#ms_truck_id, #ms_driver_id').on('input', function() {
        const value = $(this).val().toUpperCase();
        $(this).val(value);
    });
});
</script>