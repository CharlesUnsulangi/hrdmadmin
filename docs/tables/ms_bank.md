# ms_bank

**Deskripsi:**
Tabel master bank untuk payroll dan referensi rekening.

| Kolom           | Tipe         | Nullable | Deskripsi                |
|-----------------|--------------|----------|--------------------------|
| Bank_Code       | varchar(100) | No       | Primary key              |
| rec_usercreated | varchar(50)  | No       | User pembuat             |
| rec_userupdate  | varchar(50)  | No       | User update terakhir     |
| rec_datecreated | datetime     | No       | Tanggal dibuat           |
| rec_dateupdate  | datetime     | No       | Tanggal update terakhir  |
| rec_status      | char(1)      | No       | Status aktif/nonaktif    |

**Aturan Bisnis:**
- Tidak boleh dihapus dari UI.
- Digunakan pada form karyawan, payroll, dsb.
