# tr_hr_pelamar_main

**Deskripsi:**
Tabel utama data pelamar, terhubung ke workflow manajemen interview, kandidat, dan proses rekrutmen terpusat.

| Kolom                 | Tipe         | Nullable | Deskripsi                                    |
|-----------------------|--------------|----------|-----------------------------------------------|
| tr_hr_pelamar_main_id | int          | No       | Primary key, auto increment                   |
| tr_hr_pelamar_id      | varchar(50)  | Yes      | ID pelamar (opsional, untuk integrasi eksternal) |
| nama                  | varchar(255) | No       | Nama pelamar                                 |
| email                 | varchar(255) | No       | Email pelamar                                |
| hp                    | varchar(50)  | Yes      | Nomor HP pelamar                             |
| posisi                | varchar(100) | Yes      | Posisi/jabatan yang dilamar                  |
| user_created          | varchar(50)  | Yes      | User yang membuat data                       |
| date_created          | date         | Yes      | Tanggal data dibuat                          |
| rating                | int          | Yes      | Rating pelamar (opsional)                    |
| cek_confirm           | bit          | Yes      | Status konfirmasi interview (terhubung ke workflow interview)
| time_confirm          | date         | Yes      | Waktu konfirmasi interview                   |
| cek_cv                | bit          | Yes      | Status kelengkapan CV                        |
| cek_driver            | bit          | Yes      | Status kelengkapan driver                    |
| cek_interview         | bit          | Yes      | Status interview (terhubung ke manajemen interview)
| cek_kandidat          | bit          | Yes      | Status kandidat (terhubung ke workflow kandidat)
| cek_priority          | bit          | Yes      | Status prioritas                             |
| cek_tolak             | bit          | Yes      | Status tolak                                 |
| cek_wa                | bit          | Yes      | Status pengiriman WhatsApp                   |
| time_cv               | date         | Yes      | Waktu upload CV                              |
| time_interview        | date         | Yes      | Waktu interview                              |
| time_wa               | date         | Yes      | Waktu pengiriman WhatsApp                    |
| link_cv               | varchar(255) | Yes      | Link ke file CV                              |
| asal_lamaran          | varchar(100) | Yes      | Asal lamaran (opsional, jika tidak pakai master) |
| ms_hr_from_id         | varchar(50)  | Yes      | ID asal lamaran (relasi ke ms_hr_from)       |
| status                | varchar(50)  | Yes      | Status pelamar                               |

**Aturan Bisnis & Workflow:**
- Tidak boleh dihapus jika sudah ada relasi.
- Digunakan di seluruh proses rekrutmen dan workflow interview terpusat.
- Status interview, kandidat, dan konfirmasi terhubung ke manajemen interview dan kandidat.
