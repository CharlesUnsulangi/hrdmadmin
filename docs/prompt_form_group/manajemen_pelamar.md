- Alpine.js: Interaksi ringan (modal, dropdown, tambah baris)
- Paginasi: Laravel built-in atau Livewire
- Authorization: Middleware/Policy untuk akses admin/HR

## Struktur Halaman
- /pelamar (route: pelamar.index)
    - Tabel daftar pelamar (nama, email, posisi, status, aksi)
    - Filter: status, posisi, tanggal daftar, keyword
    - Tombol aksi: detail, edit, arsipkan
    - Tabel input dinamis: Form di bagian atas/terpisah untuk input pelamar satu per satu. Setiap baris bisa langsung disimpan sebelum tambah baris baru. Tidak ada bulk entry, lebih aman dan minim risiko error.
- /pelamar/{id} (route: pelamar.show)
    - Detail lengkap pelamar (data diri, pengalaman, dokumen, status)
    - Aksi: update status, kirim undangan, konfirmasi, dll
- Modal/Edit Form: Untuk update data tanpa reload
## 4. Alur Bisnis Singkat
1. Input pelamar → 2. Kirim WA → 3. Penjadwalan interview → 4. Konfirmasi kehadiran → 5. Interview → 6. Proses lanjut/selesai.

## 5. Referensi
- Lihat AI_SAFETY_GUIDELINES.md untuk detail struktur tabel dan aturan bisnis.

## Langkah Implementasi
## Langkah Implementasi
1. Buat Livewire Component: PelamarTable, PelamarDetail, PelamarRowEntry
2. Routing: Tambahkan route resource untuk pelamar di routes/web.php
3. Tampilan Tabel: Tampilkan data pelamar dengan filter, search, paginasi
4. Input Satu Per Satu: Tabel input dinamis untuk entry pelamar satu per satu (add row, validasi, simpan per baris, tambah baris baru setelah simpan)
5. Detail & Edit: Modal/detail page untuk melihat & edit data pelamar
6. Aksi Status: Tombol untuk update status proses (interview, kandidat, tolak, dll)
7. Authorization: Pastikan hanya admin/HR yang bisa akses/ubah data
8. Testing: Buat feature test untuk akses, filter, update, entry per baris, dan aksi status
1. Buat Livewire Component: PelamarTable, PelamarDetail, PelamarRowEntry
2. Routing: Tambahkan route resource untuk pelamar di routes/web.php
3. Tampilan Tabel: Tampilkan data pelamar dengan filter, search, paginasi
4. Input Satu Per Satu: Tabel input dinamis untuk entry pelamar satu per satu (add row, validasi, simpan per baris, tambah baris baru setelah simpan)
5. Detail & Edit: Modal/detail page untuk melihat & edit data pelamar
6. Aksi Status: Tombol untuk update status proses (interview, kandidat, tolak, dll)
7. Authorization: Pastikan hanya admin/HR yang bisa akses/ubah data
8. Testing: Buat feature test untuk akses, filter, update, entry per baris, dan aksi status

## Catatan Keamanan & UX
- Tidak ada aksi hapus permanen, hanya soft delete/arsip
- Semua aksi penting (ubah status, arsip) konfirmasi via modal
- Data sensitif (KTP, dokumen) hanya bisa diakses role tertentu
- Validasi dan feedback error langsung per baris input
- Setelah simpan sukses, baris baru otomatis muncul di bawah
- Bisa tambahkan shortcut keyboard (misal Enter = simpan & tambah baris baru)

## Tips Pencegahan Error Implementasi
- Tambahkan validasi di backend (Livewire/Controller) dan frontend (Blade/JS) untuk semua field penting.
- Berikan feedback jelas setiap aksi (sukses/gagal) di UI.
- Gunakan try-catch dan error handling pada proses simpan data.
- Encode semua parameter URL (terutama untuk link WhatsApp).
- Uji semua fitur dengan data edge case (input kosong, format salah, duplikat, dsb).
- Uji akses dengan user tanpa hak akses (pastikan proteksi policy/middleware berjalan).
- Buat automated test (feature/unit test) untuk setiap fitur utama.
- Pastikan nomor WhatsApp sudah format internasional (628...)
- Cegah double submit dengan disable tombol simpan saat proses berlangsung.
- Pastikan soft delete benar-benar menyembunyikan data dari list.
