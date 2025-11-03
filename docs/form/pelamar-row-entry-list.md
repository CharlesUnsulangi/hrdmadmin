# Workflow & User Guide: pelamar-row-entry-list.blade.php

## Deskripsi Singkat
Form ini digunakan untuk input data pelamar secara massal (multi-entry) oleh admin/HRD. Setiap baris mewakili satu pelamar, dengan fitur rating (radio box) dan link portal yang bisa dicopy.

## Fitur Utama
- Input multi-pelamar dalam satu tabel.
- Field: Nama, Email, No HP, Asal Lamaran, Rating (radio 1-5), Status, Link Portal (dengan tombol Copy).
- Validasi otomatis (email, no HP, field wajib).
- Link portal otomatis berdasarkan email pelamar.
- Tombol "Copy" untuk menyalin link portal.

## Workflow Penggunaan
1. **Tampilan Awal**: User melihat tabel input pelamar.
2. **Input Data**: Isi data pada setiap baris. Pilih rating dengan radio box.
3. **Validasi**: Sistem memvalidasi input sebelum simpan.
4. **Simpan**: Klik Simpan untuk mengirim data ke server.
5. **Copy Link**: Gunakan tombol Copy untuk menyalin link portal pelamar.

## Tujuan
- Memudahkan input data pelamar secara efisien.
- Menjamin data valid dan siap diproses lebih lanjut.
- Memudahkan distribusi link portal ke pelamar.

---

**File terkait:**
- `resources/views/livewire/pelamar-row-entry-list.blade.php`
- Dipanggil dari: `resources/views/pelamar/create.blade.php`

**Catatan:**
- Dokumentasi ini mengikuti nama file utama form untuk konsistensi pengembangan.
