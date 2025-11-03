# Manajemen PKWTT (Perjanjian Kerja Waktu Tidak Tertentu)

## 1. Definisi
PKWTT adalah kontrak kerja yang dibuat untuk di tanda tangani oleh pihak manajemen dan kandidat/karyawan, sebagai dasar pengangkatan menjadi karyawan tetap.

## 2. Fitur Halaman PKWTT

### a. Tabel Riwayat PKWTT
- Menampilkan daftar semua PKWTT (baru dan renewal) yang pernah dibuat.
- Kolom:
   - ID PKWTT
   - ID Karyawan/Kandidat
   - Nama Karyawan/Kandidat (otomatis dari kandidat/employee)
   - Tanggal Mulai PKWTT
   - Tanggal Akhir PKWTT
   - Tanggal Tanda Tangan
   - Durasi (bulan)
   - Status Tanda Tangan (misal: Menunggu, Selesai)
   - Aksi (detail, edit, hapus, upload file - opsional)

### b. Tombol "Buat PKWTT Baru"
- Untuk membuat PKWTT baru, baik dari kandidat maupun renewal untuk karyawan lama.

### c. Aksi
- (Opsional) Tombol detail, edit, hapus, atau upload file PKWTT untuk setiap baris.

## 3. Flow Kerja
- PKWTT dapat dibuat dari kandidat (pertama kali) atau dari karyawan (renewal).
- Semua riwayat PKWTT untuk satu ID karyawan/kandidat tercatat.
- Status tanda tangan dapat diupdate manual/otomatis sesuai workflow perusahaan.

---

Dokumen ini menjadi acuan pengembangan dan monitoring fitur manajemen PKWTT di sistem HRD.