<div class="card border-warning">
    <div class="card-header bg-warning text-dark">
        <h6 class="mb-0">
            <i class="fas fa-search me-2"></i>Data Pelaku BA Temuan (Edit Mode)
        </h6>
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Mode Edit:</strong> Data pelaku akan diganti dengan data baru yang Anda masukkan. 
            Data lama akan dihapus.
        </div>
        
        <!-- Reuse the create form but with edit functionality -->
        @include('berita-acara.partials.form-temuan')
        
        <!-- Show existing data for reference -->
        @if($beritaAcara->pelaku->count() > 0)
            <div class="mt-4">
                <h6 class="text-muted">Data Pelaku Saat Ini:</h6>
                @foreach($beritaAcara->pelaku as $pelaku)
                    <div class="alert alert-secondary small">
                        <strong>{{ $pelaku->user->nama ?? 'N/A' }}</strong> - 
                        {{ $pelaku->text_ba }} ({{ $pelaku->formatted_date }})
                        @if($pelaku->violation_types)
                            <br><em>Pelanggaran: {{ $pelaku->violation_types }}</em>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<script>
// Override the pelaku management for edit mode
document.addEventListener('DOMContentLoaded', function() {
    // Clear any auto-added pelaku from the include
    document.getElementById('pelakuContainer').innerHTML = '';
    document.getElementById('noPelakuAlert').style.display = 'block';
    pelakuIndex = 0;
    
    // Add existing pelaku data
    @foreach($beritaAcara->pelaku as $index => $pelaku)
        addPelaku();
        const section = document.querySelectorAll('.pelaku-section')[{{ $index }}];
        if (section) {
            section.querySelector('select[name*="ms_user_id"]').value = '{{ $pelaku->ms_user_id }}';
            section.querySelector('input[name*="date_ba"]').value = '{{ $pelaku->date_ba ? $pelaku->date_ba->format('Y-m-d') : '' }}';
            section.querySelector('input[name*="text_ba"]').value = '{{ $pelaku->text_ba }}';
            section.querySelector('select[name*="ms_type_ba_pelaku_id"]').value = '{{ $pelaku->ms_type_ba_pelaku_id }}';
            
            // Set checkboxes
            if ({{ $pelaku->cek_fraud ? 'true' : 'false' }}) {
                section.querySelector('input[name*="cek_fraud"]').checked = true;
            }
            if ({{ $pelaku->cek_pelanggaran ? 'true' : 'false' }}) {
                section.querySelector('input[name*="cek_pelanggaran"]').checked = true;
            }
            if ({{ $pelaku->cek_kode_etik ? 'true' : 'false' }}) {
                section.querySelector('input[name*="cek_kode_etik"]').checked = true;
            }
            if ({{ $pelaku->cek_disiplin ? 'true' : 'false' }}) {
                section.querySelector('input[name*="cek_disiplin"]').checked = true;
            }
            if ({{ $pelaku->cek_berulang ? 'true' : 'false' }}) {
                section.querySelector('input[name*="cek_berulang"]').checked = true;
            }
        }
    @endforeach
});
</script>