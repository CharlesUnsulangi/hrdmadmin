# ms_hr_kandidat

**Deskripsi:**
Tabel kandidat karyawan, menyimpan status dan approval proses kandidat hingga menjadi karyawan.

| Kolom                  | Tipe         | Nullable | Deskripsi                        |
|------------------------|--------------|----------|-----------------------------------|
| ms_hr_kandidat_emp_id  | nvarchar(50) | No       | Primary key, ID kandidat/emp      |
| ms_status_id           | nvarchar(50) | Yes      | Status kandidat                   |
| ms_user_id             | nvarchar(50) | Yes      | User yang memproses               |
| date_kandidat          | date         | Yes      | Tanggal jadi kandidat             |
| date_emp               | date         | Yes      | Tanggal jadi karyawan             |
| date_hrd_approve       | date         | Yes      | Tanggal approval HRD              |
| date_finance_approve   | date         | Yes      | Tanggal approval Finance          |
| date_bod_approve       | date         | Yes      | Tanggal approval BOD              |
| rating_hrd             | int          | Yes      | Rating HRD                        |
| rating_finance         | int          | Yes      | Rating Finance                    |
| rating_bod             | int          | Yes      | Rating BOD                        |
| rating_spv             | int          | Yes      | Rating Supervisor                 |
| date_spv               | date         | Yes      | Tanggal approval Supervisor       |
| created_at             | datetime     | Yes      | Tanggal dibuat                    |
| updated_at             | datetime     | Yes      | Tanggal update terakhir           |

**Aturan Bisnis:**
- Tidak boleh dihapus dari UI.
- Digunakan untuk tracking proses kandidat hingga menjadi karyawan.
