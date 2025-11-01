# tr_hr_pelamar_driver

**Deskripsi:**
Tabel data pelamar driver.

| Kolom                   | Tipe         | Nullable   | Deskripsi                                      |
|-------------------------|--------------|------------|-------------------------------------------------|
| tr_pelamar_driver_id    | varchar(50)  | No         | Primary key, ID pelamar driver                  |
| nama                    | varchar(50)  | Yes        | Nama pelamar                                    |
| nama_keluarga           | varchar(50)  | Yes        | Nama keluarga                                   |
| email                   | varchar(50)  | Yes        | Email                                           |
| hp                      | varchar(50)  | Yes        | Nomor HP                                        |
| no_sim                  | varchar(50)  | Yes        | Nomor SIM                                       |
| jenis_sim               | text         | Yes        | Jenis SIM (opsional, bisa A/B/C/dll)            |
| tanggal_lahir           | tinyint      | Yes        | Tanggal lahir (opsional, kemungkinan tahun saja) |
| kota_lahir              | varchar(50)  | Yes        | Kota lahir                                      |
| agama                   | varchar(50)  | Yes        | Agama                                           |
| alamat                  | varchar(50)  | Yes        | Alamat                                          |
| pekerjaan_sebelumnya    | varchar(50)  | Yes        | Pekerjaan sebelumnya                            |
| kapan_terakhir_bekerja  | date         | Yes        | Kapan terakhir bekerja (opsional)               |
| alasan_keluar           | text         | Yes        | Alasan keluar dari pekerjaan sebelumnya         |
| tahu_lamaran_dari       | varchar(50)  | Yes        | Sumber info lamaran (teman, iklan, dsb)         |
| kenal_siapa             | varchar(50)  | Yes        | Kenal siapa di perusahaan (opsional)            |

**Aturan Bisnis:**
- Tidak boleh dihapus jika sudah ada relasi.
- Digunakan untuk pelamar driver.
