# ms_hr_posisi

**Deskripsi:**
Tabel master posisi/jabatan untuk referensi pelamar dan karyawan.

| Kolom            | Tipe         | Nullable | Deskripsi                |
|------------------|--------------|----------|--------------------------|
| ms_hr_posisi_id  | varchar(50)  | No       | Primary key              |
| posisi_desc      | varchar(100) | Yes      | Nama/deskripsi posisi    |

**Aturan Bisnis:**
- Hapus hanya soft delete/arsip jika sudah dipakai.
- Digunakan pada form pelamar, karyawan, dsb.
