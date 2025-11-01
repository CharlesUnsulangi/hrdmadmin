# tr_hr_pelamar_sosmed

**Deskripsi:**
Tabel sosial media pelamar.

| Kolom                | Tipe            | Nullable   | Deskripsi                                      |
|----------------------|-----------------|------------|-------------------------------------------------|
| tr_hr_pelamar_sosmed | int             | No         | Primary key, ID sosmed pelamar                   |
| sosmed_link          | nvarchar(max)   | Yes        | Link ke profil sosial media pelamar (opsional)   |
| tr_hr_pelamar_id     | varchar(50)     | Yes        | Foreign key ke pelamar (opsional)                |
| sosmed_user          | varchar(50)     | Yes        | Username/ID akun sosial media (opsional)         |
| sosmed_type          | varchar(50)     | Yes        | Jenis sosial media (misal: Facebook, IG, dsb)    |
| date_created         | date            | Yes        | Tanggal data dibuat (opsional)                   |
| user_created         | varchar(50)     | Yes        | User yang membuat data (opsional)                |

**Aturan Bisnis:**
- Tidak boleh dihapus jika sudah ada relasi.
- Digunakan untuk tracking sosial media pelamar.
