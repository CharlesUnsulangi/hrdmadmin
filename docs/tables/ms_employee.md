# ms_employee

**Deskripsi:**
Tabel master karyawan.

| Kolom      | Tipe         | Nullable | Deskripsi         |
|------------|--------------|----------|-------------------|
| emp_id     | varchar(50)  | No       | Primary key       |
| emp_name   | varchar(100) | No       | Nama karyawan     |
| emp_com    | varchar(50)  | Yes      | Kode perusahaan   |
| emp_div    | varchar(50)  | Yes      | Kode divisi       |
| emp_status | char(1)      | Yes      | Status karyawan   |
| ...        | ...          | ...      | ... (lihat schema)|

**Aturan Bisnis:**
- Tidak boleh dihapus dari UI.
- Digunakan pada seluruh proses HRD.
