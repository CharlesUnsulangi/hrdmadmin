# Interview Management Workflow & UI Integration

## 1. Workflow Overview

### a. Interview Types
- Supervisor (SPV)
- Management (MGT)
- HRD
- Finance
- BOD
- Admin

### b. Unified Management
- Semua data interview dari tabel-tabel di atas dikelola dalam satu modul: **Manajemen Interview**
- Setiap entri interview memiliki informasi: tipe interview, pelamar, tanggal, jam, status, dan aksi

### c. Alur Kerja
1. **Akses Halaman**: User membuka `/manajemen-interview`
2. **Filter/Tab**: User dapat memilih tab/fitur filter untuk melihat interview berdasarkan tipe
3. **Tabel Data**: Semua data interview ditampilkan dalam satu tabel gabungan, dengan kolom:
   - Tipe Interview
   - Nama Pelamar
   - Tanggal Interview
   - Jam Mulai & Selesai
   - Status
   - Aksi (Lihat, Edit, Hapus)
4. **Tambah Interview**: User klik tombol tambah, pilih tipe interview, lalu diarahkan ke form sesuai tipe
5. **Edit/Hapus**: Aksi edit/hapus diarahkan ke resource CRUD masing-masing tipe
6. **Detail**: Klik detail akan menampilkan data lengkap interview sesuai tipe

## 2. Backend Architecture
- Controller utama: `InterviewManagementController`
- Mengambil data dari semua tabel interview, digabungkan (collection merge/union)
- Routing utama: `/manajemen-interview`, `/manajemen-interview/{tipe}/{id}`
- Helper/trait untuk mapping data agar seragam di view

## 3. Frontend/UI
- Satu halaman utama dengan tab/filter per tipe interview
- Tabel utama menampilkan data gabungan
- Modal/redirect untuk tambah/edit interview
- Partial view untuk tabel per tipe jika diperlukan

## 4. Dokumentasi & Pengembangan
- Semua perubahan dan arsitektur dijelaskan di dokumen ini
- Setiap resource interview tetap memiliki dokumentasi modular per tabel
- Manajemen interview menjadi entry point utama untuk monitoring dan pengelolaan proses interview

---

**Catatan:**
- Setiap penambahan tipe interview baru cukup menambah model, controller, dan partial view, lalu daftarkan di manajemen interview.
- Workflow ini memastikan monitoring interview lebih terpusat, efisien, dan mudah dikembangkan.
