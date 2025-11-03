# Manajemen Interview (2025)

## Tujuan
Menyediakan halaman pusat untuk mengelola seluruh proses interview pelamar secara terintegrasi, mulai dari penjadwalan, input hasil, monitoring, hingga integrasi Google Calendar.

## Fitur Utama

### 1. Tabel Daftar Interview Gabungan
- Nama Pelamar
- Tipe Interview (SPV, MGT, HRD, Finance, BOD, Admin)
- Tanggal & Jam Interview (jam selesai otomatis diisi saat simpan, tidak wajib di form)
- Status Interview (Terjadwal, Selesai, Dibatalkan, dsb)
- Status Google Calendar (sinkronisasi & link event)
- Aksi:
  - Lihat detail/interview
  - Edit/jadwalkan ulang
  - Hapus/cancel
  - Link ke Google Calendar

### 2. Filter & Search
- Filter berdasarkan tipe, tanggal, status, interviewer, posisi, dsb.
- Pencarian nama pelamar.

### 3. Tambah Interview
- Tombol tambah interview, pilih tipe, redirect ke form sesuai tipe (pelamar otomatis terisi jika dari detail pelamar)

### 4. Notifikasi & Reminder
- Indikator interview yang akan segera berlangsung
- (Opsional) Reminder otomatis ke interviewer/pelamar

### 5. Integrasi Google Calendar
- Status sinkronisasi (sudah/belum)
- Link langsung ke event Google Calendar

## Keuntungan
- HR dapat memantau semua jadwal dan hasil interview dalam satu halaman
- Mudah mengelola, update, dan tracking status interview
- Siap dikembangkan untuk multi-user, notifikasi, reporting, dan penambahan tipe interview baru

---

**Catatan:**
- Field jam selesai (time_end) diisi otomatis pada proses simpan, tidak wajib di form maupun validasi backend.
- Workflow interview terpusat, extensible, dan real-time.
- Dokumentasi tabel dan ERD harus selalu sinkron dengan workflow dan implementasi.