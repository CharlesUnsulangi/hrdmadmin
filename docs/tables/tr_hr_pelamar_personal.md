# tr_hr_pelamar_personal

**Deskripsi:**
Tabel data personal pelamar, menyimpan informasi detail identitas pelamar.

| Kolom            | Tipe         | Nullable | Deskripsi                        |
|------------------|--------------|----------|-----------------------------------|
| tr_hr_pelamar_id | varchar(50)  | No       | ID pelamar (relasi ke pelamar)    |
| date_lahir       | date         | Yes      | Tanggal lahir pelamar             |
| kota_lahir       | varchar(100) | Yes      | Kota lahir pelamar                |
| alamat           | text         | Yes      | Alamat pelamar                    |
| jenis            | varchar(20)  | Yes      | Jenis kelamin                     |
| agama            | varchar(50)  | Yes      | Agama pelamar                     |
| nama             | varchar(255) | No       | Nama pelamar                      |
| pendidikan       | varchar(100) | Yes      | Pendidikan terakhir               |
| cek_pengalaman   | bit/bool     | Yes      | Ada pengalaman kerja? (true/false)|

**Aturan Bisnis:**
- Digunakan untuk menyimpan data personal pelamar.
- Relasi ke tr_hr_pelamar_main.
