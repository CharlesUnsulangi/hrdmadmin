# ms_hr_from

**Deskripsi:**
Tabel master asal lamaran untuk referensi sumber pelamar.

| Kolom         | Tipe         | Nullable | Deskripsi                |
|---------------|--------------|----------|--------------------------|
| ms_hr_from_id | varchar(50)  | No       | Primary key              |
| form_hr_desc  | varchar(50)  | Yes      | Deskripsi asal lamaran   |
| created_at    | datetime     | Yes      | Tanggal dibuat           |
| updated_at    | datetime     | Yes      | Tanggal update terakhir  |

**Aturan Bisnis:**
- Hapus hard/soft delete sesuai kebutuhan.
- Digunakan pada form pelamar.
