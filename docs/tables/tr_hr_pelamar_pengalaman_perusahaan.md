# tr_hr_pelamar_pengalaman_perusahaan

**Deskripsi:**
Tabel pengalaman kerja pelamar, menyimpan riwayat pekerjaan dan penilaian dari perusahaan sebelumnya.

| Kolom                      | Tipe            | Nullable | Deskripsi                                    |
|----------------------------|-----------------|----------|-----------------------------------------------|
| tr_hr_pelamar_pengalaman_id| int (IDENTITY)  | No       | Primary key, auto increment                   |
| tr_hr_pelamar_id           | varchar(50)     | No       | Foreign key ke pelamar                        |
| perusahaan                 | varchar(50)     | No       | Nama perusahaan                               |
| tgl_start                  | date            | No       | Tanggal mulai bekerja                         |
| tgl_end                    | date            | No       | Tanggal selesai bekerja                       |
| hp_hrd                     | varchar(50)     | No       | Nomor HP HRD perusahaan                       |
| nama_hrd                   | varchar(50)     | No       | Nama HRD perusahaan                           |
| hp_atasan                  | varchar(50)     | No       | Nomor HP atasan langsung                      |
| alasan_resign              | text            | No       | Alasan resign dari perusahaan                 |
| jabatan_akhir              | varchar(50)     | Yes      | Jabatan terakhir di perusahaan                |
| jabatan_awal               | varchar(50)     | Yes      | Jabatan awal di perusahaan                    |
| gaji_awal                  | decimal(19, 2)  | No       | Gaji awal saat masuk perusahaan               |
| gaji_akhir                 | decimal(19, 2)  | No       | Gaji akhir saat keluar perusahaan             |
| sukses_rating              | int             | Yes      | Rating keberhasilan (opsional)                |
| sukses_keterangan          | text            | Yes      | Keterangan keberhasilan (opsional)            |
| sulit_rating               | int             | Yes      | Rating kesulitan (opsional)                   |
| sulit_keterangan           | text            | Yes      | Keterangan kesulitan (opsional)               |
| puas_rating                | int             | Yes      | Rating kepuasan (opsional)                    |
| puas_keterangan            | text            | Yes      | Keterangan kepuasan (opsional)                |
| masalah_rating             | int             | Yes      | Rating masalah (opsional)                     |
| masalah_keterangan         | text            | Yes      | Keterangan masalah (opsional)                 |
| kesalahan_paling_besar     | text            | Yes      | Catatan kesalahan paling besar (opsional)     |
| created_at                 | datetime        | Yes      | Timestamp dibuat                              |
| updated_at                 | datetime        | Yes      | Timestamp diubah                              |

**Aturan Bisnis:**
- Satu pelamar bisa memiliki banyak pengalaman kerja.
- Data digunakan untuk analisa riwayat kerja dan referensi pelamar.
- Tidak boleh dihapus jika sudah ada relasi ke proses lain.
