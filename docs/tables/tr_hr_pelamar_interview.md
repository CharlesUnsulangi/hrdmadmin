# tr_hr_pelamar_interview

**Deskripsi:**
Tabel data interview pelamar, terintegrasi dengan workflow manajemen interview multi-tipe (SPV, MGT, HRD, Finance, BOD, Admin).

| Kolom                      | Tipe         | Nullable | Deskripsi                        |
|----------------------------|--------------|----------|-----------------------------------|
| tr_hr_pelamar_interview_id | int          | No       | Primary key                      |
| tr_hr_pelamar_id           | varchar(50)  | Yes      | Foreign key ke pelamar           |
| date_interview             | date         | Yes      | Tanggal interview                |
| time_start                 | time(7)      | Yes      | Waktu mulai                      |
| time_end                   | time(7)      | Yes      | Waktu selesai (diisi otomatis pada proses simpan, tidak wajib di form/validasi) |
| note_operator              | varchar(50)  | Yes      | Catatan operator                 |
| note_spv                   | varchar(50)  | Yes      | Catatan supervisor               |
| note_mgr                   | varchar(50)  | Yes      | Catatan manager                  |
| note_hrd                   | varchar(50)  | Yes      | Catatan HRD                      |
| note_bd                    | varchar(50)  | Yes      | Catatan board director           |
| note_gm                    | varchar(50)  | Yes      | Catatan general manager          |
| note_dir                   | varchar(50)  | Yes      | Catatan direktur                 |
| note_mgt                   | varchar(50)  | Yes      | Catatan manajemen                |
| rating_operator            | int          | Yes      | Rating operator                  |
| rating_spv                 | int          | Yes      | Rating supervisor                |
| rating_mgr                 | int          | Yes      | Rating manager                   |
| rating_gm                  | int          | Yes      | Rating general manager           |
| rating_bd                  | int          | Yes      | Rating board director            |
| rating_mgt                 | int          | Yes      | Rating manajemen                 |
| rating_hrd                 | int          | Yes      | Rating HRD                       |
| cek_lanjut                 | bit          | Yes      | Flag lanjut proses                |
| cek_tolak                  | bit          | Yes      | Flag tolak proses                 |

**Aturan Bisnis & Workflow:**
- Tidak boleh dihapus jika sudah ada relasi.
- Digunakan untuk tracking proses interview multi-tipe.
- Field jam selesai (time_end) diisi otomatis pada proses simpan, tidak wajib di form maupun validasi backend.
- Terhubung ke workflow manajemen interview terpusat dan integrasi Google Calendar.
