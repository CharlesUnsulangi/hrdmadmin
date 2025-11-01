# tr_hr_pelamar_personal

**Deskripsi:**
Tabel data personal pelamar, menyimpan informasi detail identitas pelamar.

| Kolom            | Tipe         | Nullable | Deskripsi                        |
|------------------|--------------|----------|-----------------------------------|
| tr_hr_pelamar_id | varchar(50)  | No       | ID pelamar (relasi ke pelamar)    |
| nama             | varchar(50)  | No       | Nama pelamar                      |
| nama_keluarga    | nchar(10)    | Yes      | Nama keluarga                     |
| date_lahir       | date         | Yes      | Tanggal lahir pelamar             |
| kota_lahir       | varchar(50)  | Yes      | Kota lahir pelamar                |
| alamat           | varchar(50)  | Yes      | Alamat pelamar                    |
| jenis            | varchar(50)  | Yes      | Jenis kelamin                     |
| agama            | varchar(50)  | Yes      | Agama pelamar                     |
| pendidikan       | varchar(50)  | Yes      | Pendidikan terakhir               |
| cek_pengalaman   | bit/bool     | Yes      | Ada pengalaman kerja? (true/false)|
| gaji_diminta     | money        | Yes      | Gaji yang diminta                 |

**Aturan Bisnis:**
- Digunakan untuk menyimpan data personal pelamar.
- Relasi ke tr_hr_pelamar_main.
