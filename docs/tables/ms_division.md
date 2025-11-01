# ms_division

**Deskripsi:**
Tabel master divisi yang digunakan di seluruh aplikasi HRD.

| Kolom   | Tipe         | Nullable | Deskripsi         |
|---------|--------------|----------|-------------------|
| div_id  | varchar(50)  | No       | Primary key       |
| div_desc| varchar(100) | Yes      | Nama divisi       |

**Aturan Bisnis:**
- Tidak boleh dihapus dari UI.
- Digunakan pada form karyawan, pelamar, dsb.
