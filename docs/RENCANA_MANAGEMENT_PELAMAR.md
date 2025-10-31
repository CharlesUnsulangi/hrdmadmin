# Rencana Halaman Manajemen Pelamar

## Fitur Utama
- Daftar pelamar (tabel/listing dengan filter & pencarian)
- Detail pelamar (modal/halaman detail)
- Edit/update data pelamar
- Input pelamar satu per satu melalui tabel dinamis, setiap baris bisa langsung disimpan sebelum tambah baris baru (bukan bulk entry)
- Dropdown "Asal Lamaran" (Jobstreet, Erika, Website, Referensi, dll) di atas tabel input. Setiap baris pelamar otomatis mengisi kolom ms_from/hr_from sesuai pilihan ini.
- Dropdown "Rating Default" di atas tabel input. Setiap baris pelamar otomatis mengisi kolom rating sesuai pilihan rating default ini (misal: 1-5). Jika ingin mengganti rating default, cukup ubah dropdown, dan baris baru berikutnya akan mengikuti pilihan terbaru. Kolom rating tetap bisa diedit manual jika perlu.
- Hapus/arsipkan pelamar (opsional, hanya soft delete/arsip)
- Status proses rekrutmen (tahapan, notifikasi)
- Aksi cepat: konfirmasi interview, kirim undangan, dll
- Kirim WhatsApp ke pelamar langsung dari tabel/list pelamar, dengan pesan template yang bisa dikustomisasi
- Pemeriksaan status pengisian dan konfirmasi skedul interview pelamar (indikator di tabel/list, filter khusus, dan aksi follow-up)

## Fitur WhatsApp (WA)
- Di setiap baris tabel pelamar, terdapat tombol "Kirim WA".
- Saat diklik, aplikasi membuka WhatsApp Web (atau aplikasi WhatsApp di HP) dengan nomor pelamar dan pesan template yang sudah disiapkan.
- Link format: `https://wa.me/{nomor}?text={pesan}`
- Pesan dapat otomatis diisi variabel (nama pelamar, posisi, dsb).
- Pesan template dapat dikustomisasi oleh admin/HR.

## Komponen & Teknologi
- Livewire: Untuk interaksi dinamis (filter, search, aksi tanpa reload, tabel input dinamis)
- Blade: Tampilan utama
- Tailwind CSS: Styling tabel, form, modal
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

## Langkah Implementasi
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
