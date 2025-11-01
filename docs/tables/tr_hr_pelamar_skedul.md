# tr_hr_pelamar_skedul

**Deskripsi:**
Tabel jadwal interview pelamar.

| Kolom                | Tipe         | Nullable   | Deskripsi                                 |
|----------------------|--------------|------------|---------------------------------------------|
| tr_hr_pelamar_id     | varchar(50)  | No         | Primary key, foreign key ke pelamar         |
| skedul_pelamar_time  | datetime     | Yes        | Waktu skedul interview pelamar (opsional)   |
| skedul_confirmed     | datetime     | Yes        | Waktu konfirmasi skedul oleh pelamar (opsional) |

**Aturan Bisnis:**
- Tidak boleh dihapus jika sudah ada relasi.
- Digunakan untuk tracking jadwal interview.
