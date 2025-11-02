# tr_hr_bg_check

**Deskripsi:**
Tabel background check pelamar, menyimpan hasil pengecekan referensi dan integritas pelamar.

| Kolom                | Tipe         | Nullable | Deskripsi                        |
|----------------------|--------------|----------|-----------------------------------|
| tr_hr_bg_check_id    | int (IDENTITY) | No     | Primary key, auto increment       |
| tr_hr_pelamar_main_id| varchar(50)  | No       | Foreign key ke pelamar            |
| telepon              | varchar(50)  | Yes      | Nomor telepon referensi           |
| nama                 | varchar(50)  | Yes      | Nama referensi                    |
| ms_user_id           | varchar(50)  | Yes      | User yang melakukan bg check      |
| note                 | varchar(50)  | Yes      | Catatan                           |
| cek_fraud            | bit          | Yes      | Cek indikasi fraud                |
| cek_bohong           | bit          | Yes      | Cek indikasi kebohongan           |
| nilai_positif        | int          | Yes      | Nilai positif                     |
| nilai_negatif        | int          | Yes      | Nilai negatif                     |
| cek_rekomendasi      | bit          | Yes      | Rekomendasi diterima/tidak        |
| jabatan_bg           | varchar(50)  | Yes      | Jabatan referensi                 |
| date_created         | varchar(50)  | Yes      | Tanggal input                     |
| user_created         | varchar(50)  | Yes      | User input                        |

**Aturan Bisnis:**
- Satu pelamar bisa memiliki lebih dari satu background check.
- Hanya user tertentu yang bisa input/edit data ini.
- Data digunakan untuk analisa integritas dan kelayakan pelamar.
