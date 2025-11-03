# Struktur Tabel: ms_hr_pelamar_type

| Nama Kolom            | Tipe Data    | Keterangan                                               |
|-----------------------|--------------|----------------------------------------------------------|
| ms_hr_pelamar_type_id | varchar(50)  | Primary Key, kode unik tipe/jabatan pelamar (STAFF, DLL) |
| type_desc             | varchar(50)  | Deskripsi tipe/jabatan pelamar (Staff, Driver, Kenek)    |

**Primary Key:** ms_hr_pelamar_type_id

## Contoh Data

| ms_hr_pelamar_type_id | type_desc |
|-----------------------|-----------|
| STAFF                 | Staff     |
| DRIVER                | Driver    |
| KENEK                 | Kenek     |

## Fungsi di Aplikasi
- Menyimpan daftar jenis/jabatan pelamar (Staff, Driver, Kenek, dll).
- Digunakan sebagai pilihan pada form pelamar (dropdown/select).
- Memudahkan filter, pencarian, dan pelaporan berdasarkan jabatan pelamar.
