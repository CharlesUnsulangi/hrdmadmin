
# Interview Management Workflow & UI Integration (2025)

## 1. Workflow Overview

### a. Interview Types (Modular)
- Supervisor (SPV)
- Management (MGT)
- HRD
- Finance
- BOD
- Admin

### b. Unified & Extensible Management
- Semua data interview dari tabel-tabel di atas dikelola dalam satu modul: **Manajemen Interview**
- Setiap entri interview memiliki informasi: tipe interview, pelamar, tanggal, jam, status, dan aksi
- Penambahan tipe interview baru cukup menambah model, controller, partial view, dan mendaftarkan di manajemen interview

### c. Alur Kerja Terintegrasi
1. **Akses Halaman**: User membuka `/manajemen-interview` (sidebar utama)
2. **Filter/Tab**: User dapat memilih tab/fitur filter untuk melihat interview berdasarkan tipe
3. **Tabel Data Gabungan**: Semua data interview ditampilkan dalam satu tabel, kolom:
   - Tipe Interview
   - Nama Pelamar
   - Tanggal Interview
   - Jam Mulai & Selesai (jam selesai otomatis diisi saat simpan, tidak wajib di form)
   - Status Interview
   - Status Google Calendar
   - Aksi (Lihat, Edit, Hapus)
4. **Tambah Interview**: User klik tombol tambah, pilih tipe interview, lalu diarahkan ke form sesuai tipe (pelamar otomatis terisi jika dari detail pelamar)
5. **Edit/Hapus**: Aksi edit/hapus diarahkan ke resource CRUD masing-masing tipe
6. **Detail**: Klik detail menampilkan data lengkap interview sesuai tipe
7. **Integrasi Google Calendar**: Status sinkronisasi dan link event langsung tersedia

## 2. Backend Architecture
- Controller utama: `InterviewManagementController`
- Mengambil data dari semua tabel interview, digabungkan (collection merge/union)
- Routing utama: `/manajemen-interview`, `/manajemen-interview/{tipe}/{id}`
- Helper/trait untuk mapping data agar seragam di view
- Field jam selesai (`time_end`) diisi otomatis pada proses simpan, tidak wajib di form maupun validasi backend

## 3. Frontend/UI
- Satu halaman utama dengan tab/filter per tipe interview
- Tabel utama menampilkan data gabungan real-time dari semua tabel interview
- Tombol tambah interview, dropdown tipe, dan redirect ke form sesuai tipe
- Modal/redirect untuk tambah/edit interview
- Partial view untuk tabel per tipe jika diperlukan
- Semua form interview (create/edit) konsisten: radio untuk rating, flag, switch offline/online, auto-filled date/time, pelamar

## 4. Dokumentasi & Pengembangan
- Semua perubahan dan arsitektur dijelaskan di dokumen ini
- Setiap resource interview tetap memiliki dokumentasi modular per tabel
- Manajemen interview menjadi entry point utama untuk monitoring dan pengelolaan proses interview
- Pastikan dokumentasi tabel dan ERD selalu sinkron dengan workflow dan implementasi

---

**Catatan:**
- Workflow ini memastikan monitoring interview lebih terpusat, efisien, dan mudah dikembangkan.
- Field jam selesai (time_end) diisi otomatis pada proses simpan, tidak wajib di form maupun validasi backend.
- Integrasi Google Calendar aktif untuk setiap interview yang dijadwalkan.
