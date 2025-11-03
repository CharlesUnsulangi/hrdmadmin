@php
// Route for AJAX duplicate check
$checkIdUrl = route('pelamar.checkid');
@endphp
<div>
    @if (session()->has('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    <form method="POST" action="{{ route('pelamar.store') }}">
        @csrf
        <table class="table table-bordered table-striped table-hover align-middle shadow mb-4">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Asal Lamaran</th>
                    <th>Rating</th>
                    <th>Link Portal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rows as $i => $row)
                <tr>
                    <td><input type="text" name="rows[{{ $i }}][nama]" value="{{ $row['nama'] ?? '' }}" class="form-control form-control-sm" required /></td>
                    <td><input type="email" name="rows[{{ $i }}][email]" value="{{ $row['email'] ?? '' }}" class="form-control form-control-sm" required pattern="^[^@\s]+@[^@\s]+\.[^@\s]+$" /></td>
                    <td><input type="number" name="rows[{{ $i }}][no_hp]" value="{{ $row['no_hp'] ?? '' }}" class="form-control form-control-sm" placeholder="62..." required min="6200000000" step="1" /></td>
                    <td>
                        <select name="rows[{{ $i }}][ms_hr_from_id]" class="form-select form-select-sm">
                            <option value="">-- Pilih --</option>
                            @foreach($asal_lamaran_options as $id => $desc)
                                <option value="{{ $id }}" @if(($row['ms_hr_from_id'] ?? '') == $id) selected @endif>{{ $desc }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            @for($r=1;$r<=5;$r++)
                                <input type="radio" name="rows[{{ $i }}][rating]" value="{{ $r }}" id="rating_{{ $i }}_{{ $r }}" @if(($row['rating'] ?? '') == $r) checked @endif>
                                <label for="rating_{{ $i }}_{{ $r }}" class="me-1">{{ $r }}</label>
                            @endfor
                        </div>
                    </td>
                    <td>
                        @php
                            $link = url('/portal/pelamar/'.($row['email'] ?? ''));
                        @endphp
                        <input type="text" class="form-control form-control-sm d-inline w-75" value="{{ $link }}" readonly id="link-portal-{{ $i }}">
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="navigator.clipboard.writeText(document.getElementById('link-portal-{{ $i }}').value)">Copy</button>
                    </td>
                    <td><input type="text" name="rows[{{ $i }}][status]" value="{{ $row['status'] ?? '' }}" class="form-control form-control-sm" /></td>
                    <td>
                        <button type="button" id="btn-simpan" class="btn btn-success btn-sm d-flex align-items-center gap-1">
                            <i class="bi bi-save"></i> Simpan
                        </button>
</table>
    </form>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form[action="{{ route('pelamar.store') }}"]');
    const btnSimpan = document.getElementById('btn-simpan');
    if (form && btnSimpan) {
        btnSimpan.addEventListener('click', function (e) {
            // Validasi nomor HP semua baris
            let valid = true;
            let pesan = '';
            form.querySelectorAll('input[name^="rows"][name$="[no_hp]"]')?.forEach(function(input) {
                const val = input.value;
                if (!/^62[0-9]{7,}$/.test(val)) {
                    valid = false;
                    pesan = 'Nomor HP harus diawali 62 dan minimal 10 digit.';
                }
            });
            if (!valid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Format Nomor HP Salah',
                    text: pesan,
                });
                return;
            }
            // Validasi email semua baris
            let emailValid = true;
            let emailMsg = '';
            form.querySelectorAll('input[name^="rows"][name$="[email]"]')?.forEach(function(input) {
                const val = input.value;
                // Simple email regex: must contain @ and . after @
                if (!/^\S+@\S+\.\S+$/.test(val)) {
                    emailValid = false;
                    emailMsg = 'Format email tidak valid. Contoh: user@email.com';
                }
            });
            if (!emailValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Format Email Salah',
                    text: emailMsg,
                });
                return;
            }
            // Cek duplikat tr_hr_pelamar_main_id (email) ke server
            let emails = [];
            form.querySelectorAll('input[name^="rows"][name$="[email]"]')?.forEach(function(input) {
                emails.push(input.value);
            });
            fetch("{{$checkIdUrl}}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                },
                body: JSON.stringify({ emails: emails })
            })
            .then(response => response.json())
            .then(data => {
                if (data.exists && data.exists.length > 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Data Duplikat',
                        html: 'Email berikut sudah pernah diinput:<br><b>' + data.exists.join('<br>') + '</b>',
                    });
                    return;
                }
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Yakin simpan data pelamar?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, simpan',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    }
});
</script>
@endpush
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>

