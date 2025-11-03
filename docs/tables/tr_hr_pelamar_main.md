# Informasi Tabel: tr_hr_pelamar_main

## Deskripsi
Tabel ini digunakan untuk menyimpan **data semua pelamar** yang pernah mengajukan lamaran kerja ke perusahaan, baik yang masih dalam proses seleksi, sudah diterima, maupun yang tidak lolos. Tabel ini menjadi sumber utama seluruh proses rekrutmen, mulai dari pendaftaran, seleksi administrasi, interview, hingga keputusan akhir.

## Struktur Tabel
| Nama Kolom              | Tipe Data         | Keterangan                                                                 |
|-------------------------|-------------------|----------------------------------------------------------------------------|
| tr_hr_pelamar_main_id   | varchar(50)       | **Primary Key.** ID unik pelamar (bisa email, UUID, dsb)                   |
| nama                    | varchar(50)       | Nama lengkap pelamar                                                       |
| email                   | varchar(50)       | Email pelamar (boleh kosong)                                               |
| no_hp                   | varchar(50)       | Nomor HP pelamar (boleh kosong)                                            |
| status                  | varchar(50)       | Status pelamar (misal: proses, lolos, tidak lolos, dsb)                    |
| created_at              | datetime          | Tanggal data dibuat (boleh kosong)                                         |
| updated_at              | datetime          | Tanggal data diupdate (boleh kosong)                                       |
| rating                  | int               | Skor/rating pelamar (boleh kosong)                                         |
| cek_confirm             | bit               | Sudah konfirmasi? (boleh kosong)                                           |
| time_confirm            | time(7)           | Waktu konfirmasi (boleh kosong)                                            |
| cek_cv                  | bit               | Sudah upload CV? (boleh kosong)                                            |
| cek_driver              | bit               | Centang jika pelamar driver (boleh kosong)                                 |
| cek_interview           | bit               | Sudah interview? (boleh kosong)                                            |
| cek_kandidat            | bit               | Sudah jadi kandidat? (boleh kosong)                                        |
| cek_priority            | bit               | Masuk prioritas? (boleh kosong)                                            |
| cek_tolak               | bit               | Ditolak? (boleh kosong)                                                    |
| cek_wa                  | bit               | Sudah dikirimi WA? (boleh kosong)                                          |
| time_cv                 | time(7)           | Waktu upload CV (boleh kosong)                                             |
| time_interview          | time(7)           | Waktu interview (boleh kosong)                                             |
| time_wa                 | time(7)           | Waktu kirim WA (boleh kosong)                                              |
| link_cv                 | nvarchar(max)     | Link file CV (boleh kosong)                                                |
| date_created            | datetime          | Tanggal input data (tidak boleh kosong)                                    |
| cek_shortlist           | bit               | Masuk shortlist? (boleh kosong)                                            |
| cek_helper              | bit               | Centang jika pelamar helper (boleh kosong)                                 |
| cek_staff               | bit               | Centang jika pelamar staff (boleh kosong)                                  |
| ms_hr_pelamar_type_id   | varchar(50)       | **Foreign Key** ke `ms_hr_pelamar_type` (boleh kosong, tipe/jabatan pelamar)|

## Relasi
- **ms_hr_pelamar_type_id** → `ms_hr_pelamar_type.ms_hr_pelamar_type_id`  
  (Menandakan tipe/jabatan pelamar, misal: STAFF, DRIVER, KENEK, dll)

## Catatan Penggunaan
- Semua pelamar, baik yang diterima maupun tidak, tetap tercatat di tabel ini.
- Kolom boolean/bit digunakan untuk menandai status proses rekrutmen secara detail.
- Kolom waktu (`time_*`) dan tanggal (`date_created`, `created_at`, `updated_at`) membantu tracking proses.
- Kolom `link_cv` menyimpan link ke file CV yang diupload pelamar.
- Kolom `ms_hr_pelamar_type_id` memungkinkan filter dan analisis berdasarkan tipe pelamar.

## Contoh Query

**Ambil semua pelamar driver yang sudah interview:**
```sql
SELECT * FROM tr_hr_pelamar_main
WHERE cek_driver = 1 AND cek_interview = 1;
```

**Ambil pelamar berdasarkan tipe tertentu:**
```sql
SELECT * FROM tr_hr_pelamar_main
WHERE ms_hr_pelamar_type_id = 'STAFF';
```
