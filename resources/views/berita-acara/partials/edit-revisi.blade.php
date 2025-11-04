<div class="card border-success">
    <div class="card-header bg-success text-white">
        <h6 class="mb-0">
            <i class="fas fa-edit me-2"></i>Data Revisi BA Revisi (Edit Mode)
        </h6>
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Mode Edit:</strong> Data revisi akan diganti dengan data baru yang Anda masukkan. 
            Data lama akan dihapus.
        </div>
        
        <!-- Reuse the create form but with edit functionality -->
        @include('berita-acara.partials.form-revisi')
        
        <!-- Show existing data for reference -->
        @if($beritaAcara->revisi->count() > 0)
            <div class="mt-4">
                <h6 class="text-muted">Data Revisi Saat Ini:</h6>
                @foreach($beritaAcara->revisi as $revisi)
                    <div class="alert alert-secondary small">
                        <strong>{{ $revisi->field }}</strong><br>
                        <em>{{ $revisi->short_reason }}</em><br>
                        Sebelum: {{ $revisi->comparison['before'] ?: '-' }} → 
                        Sesudah: {{ $revisi->comparison['after'] ?: '-' }}
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<script>
// Override the revisi management for edit mode
document.addEventListener('DOMContentLoaded', function() {
    // Clear any auto-added revisi from the include
    document.getElementById('revisiContainer').innerHTML = '';
    document.getElementById('noRevisiAlert').style.display = 'block';
    revisiIndex = 0;
    
    // Add existing revisi data
    @foreach($beritaAcara->revisi as $index => $revisi)
        addRevisi();
        const section = document.querySelectorAll('.revisi-section')[{{ $index }}];
        if (section) {
            section.querySelector('input[name*="field"]').value = '{{ $revisi->field }}';
            section.querySelector('input[name*="database_name"]').value = '{{ $revisi->database_name ?? '' }}';
            section.querySelector('input[name*="field_name"]').value = '{{ $revisi->field_name ?? '' }}';
            section.querySelector('textarea[name*="reason_desc"]').value = '{{ $revisi->reason_desc }}';
            section.querySelector('textarea[name*="query_id"]').value = '{{ $revisi->query_id ?? '' }}';
            
            // Determine and set the revisi type
            @if($revisi->text_salah !== null)
                section.querySelector('select[name*="revisi_type"]').value = 'text';
                toggleRevisiFields(section.querySelector('select[name*="revisi_type"]'), {{ $index }});
                section.querySelector('input[name*="text_salah"]').value = '{{ $revisi->text_salah }}';
                section.querySelector('input[name*="text_benar"]').value = '{{ $revisi->text_benar }}';
            @elseif($revisi->qty_salah !== null)
                section.querySelector('select[name*="revisi_type"]').value = 'number';
                toggleRevisiFields(section.querySelector('select[name*="revisi_type"]'), {{ $index }});
                section.querySelector('input[name*="qty_salah"]').value = '{{ $revisi->qty_salah }}';
                section.querySelector('input[name*="qty_benar"]').value = '{{ $revisi->qty_benar }}';
            @elseif($revisi->money_salah !== null)
                section.querySelector('select[name*="revisi_type"]').value = 'money';
                toggleRevisiFields(section.querySelector('select[name*="revisi_type"]'), {{ $index }});
                section.querySelector('input[name*="money_salah"]').value = '{{ $revisi->money_salah }}';
                section.querySelector('input[name*="money_benar"]').value = '{{ $revisi->money_benar }}';
            @elseif($revisi->date_salah !== null)
                section.querySelector('select[name*="revisi_type"]').value = 'date';
                toggleRevisiFields(section.querySelector('select[name*="revisi_type"]'), {{ $index }});
                section.querySelector('input[name*="date_salah"]').value = '{{ $revisi->date_salah ? $revisi->date_salah->format('Y-m-d') : '' }}';
                section.querySelector('input[name*="date_benar"]').value = '{{ $revisi->date_benar ? $revisi->date_benar->format('Y-m-d') : '' }}';
            @endif
        }
    @endforeach
});
</script>