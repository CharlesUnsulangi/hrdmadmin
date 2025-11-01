# ms_company

**Deskripsi:**
Tabel master perusahaan yang digunakan di seluruh aplikasi HRD.

| Kolom         | Tipe         | Nullable | Deskripsi                |
|--------------|--------------|----------|--------------------------|
| company_code | varchar(50)  | No       | Primary key              |
| company_desc | varchar(100) | Yes      | Nama perusahaan          |

**Aturan Bisnis:**
- Tidak boleh dihapus dari UI.
- Digunakan pada form karyawan, pelamar, dsb.
