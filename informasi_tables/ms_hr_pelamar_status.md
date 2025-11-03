# Informasi Tabel: ms_hr_pelamar_status

## Deskripsi
Tabel master status pelamar. Menyimpan daftar status yang dapat digunakan untuk menandai atau mengelompokkan pelamar dalam proses rekrutmen, misal: BARU, PROSES, LOLOS, TIDAK LOLOS, DITOLAK, dsb.

## Struktur Tabel
| Nama Kolom              | Tipe Data   | Keterangan                               |
|-------------------------|-------------|-------------------------------------------|
| ms_hr_pelamar_status_id | varchar(50) | **Primary Key.** Kode unik status pelamar |
| status_desc             | varchar(50) | Deskripsi status (boleh kosong)           |

## Catatan Penggunaan
- Digunakan sebagai referensi/master untuk field status pada pelamar.
- Memudahkan filtering, reporting, dan konsistensi status pelamar di seluruh sistem.
- Dapat di-relasikan ke tabel pelamar (misal: `tr_hr_pelamar_main.status` mengacu ke `ms_hr_pelamar_status_id`).
