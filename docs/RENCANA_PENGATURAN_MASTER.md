# RENCANA PENGATURAN MASTER

## Tujuan
Menyediakan halaman terpusat untuk mengelola data master yang digunakan di seluruh sistem HRD, seperti posisi/jabatan, asal lamaran, status pelamar, template pesan, dan data referensi lain (perusahaan, divisi, bank, serta seluruh tabel master dan relasi utama yang dipakai aplikasi).

## Daftar Tabel Master & Relasi Utama

### Tabel Master:
- ms_company (Perusahaan)
- ms_division (Divisi)
- ms_bank (Bank)
- ms_hr_posisi (Posisi/Jabatan)
- ms_hr_from (Asal Lamaran)
- ms_employee (Karyawan)
- tr_hr_pelamar_personal (Data Personal Pelamar)

### Tabel Transaksi/Relasi:
- tr_hr_pelamar_main (Pelamar)
- tr_hr_pelamar_interview (Interview Pelamar)
- tr_hr_pelamar_pengalaman_perusahaan (Pengalaman Kerja Pelamar)
- tr_hr_pelamar_skedul (Jadwal Interview Pelamar)
- tr_hr_pelamar_sosmed (Sosial Media Pelamar)
- tr_hr_pelamar_driver (Data Driver Pelamar)

## Dokumentasi Struktur Tabel

### tr_hr_pelamar_personal
| Kolom            | Tipe         | Nullable | Deskripsi                        |
|------------------|--------------|----------|-----------------------------------|
| trHrPelamarId    | varchar(50)  | No       | ID pelamar (relasi ke pelamar)    |
| dateLahir        | date         | Yes      | Tanggal lahir pelamar             |
| kotaLahir        | varchar(100) | Yes      | Kota lahir pelamar                |
| alamat           | text         | Yes      | Alamat pelamar                    |
| jenis            | varchar(20)  | Yes      | Jenis kelamin                     |
| agama            | varchar(50)  | Yes      | Agama pelamar                     |
| nama             | varchar(255) | No       | Nama pelamar                      |
| pendidikan       | varchar(100) | Yes      | Pendidikan terakhir               |
| cekPengalaman    | bit/bool     | Yes      | Ada pengalaman kerja? (true/false)|

### ms_company
| Kolom         | Tipe         | Nullable | Deskripsi                |
|--------------|--------------|----------|--------------------------|
| company_code | varchar(50)  | No       | Primary key              |
| company_desc | varchar(100) | Yes      | Nama perusahaan          |

### ms_division
| Kolom   | Tipe         | Nullable | Deskripsi         |
|---------|--------------|----------|-------------------|
| div_id  | varchar(50)  | No       | Primary key       |
| div_desc| varchar(100) | Yes      | Nama divisi       |

### ms_bank
| Kolom           | Tipe         | Nullable | Deskripsi                |
|-----------------|--------------|----------|--------------------------|
| Bank_Code       | varchar(100) | No       | Primary key              |
| rec_usercreated | varchar(50)  | No       | User pembuat             |
| rec_userupdate  | varchar(50)  | No       | User update terakhir     |
| rec_datecreated | datetime     | No       | Tanggal dibuat           |
| rec_dateupdate  | datetime     | No       | Tanggal update terakhir  |
| rec_status      | char(1)      | No       | Status aktif/nonaktif    |

### ms_hr_posisi
| Kolom            | Tipe         | Nullable | Deskripsi                |
|------------------|--------------|----------|--------------------------|
| ms_hr_posisi_id  | varchar(50)  | No       | Primary key              |
| posisi_desc      | varchar(100) | Yes      | Nama/deskripsi posisi    |

### ms_hr_from
| Kolom         | Tipe         | Nullable | Deskripsi                |
|---------------|--------------|----------|--------------------------|
| ms_hr_from_id | varchar(50)  | No       | Primary key              |
| form_hr_desc  | varchar(50)  | Yes      | Deskripsi asal lamaran   |
| created_at    | datetime     | Yes      | Tanggal dibuat           |
| updated_at    | datetime     | Yes      | Tanggal update terakhir  |

### ms_employee
| Kolom      | Tipe         | Nullable | Deskripsi         |
|------------|--------------|----------|-------------------|
| emp_id     | varchar(50)  | No       | Primary key       |
| emp_name   | varchar(100) | No       | Nama karyawan     |
| emp_com    | varchar(50)  | Yes      | Kode perusahaan   |
| emp_div    | varchar(50)  | Yes      | Kode divisi       |
| emp_status | char(1)      | Yes      | Status karyawan   |
| ...        | ...          | ...      | ... (lihat schema)|

### tr_hr_pelamar_main
| Kolom                 | Tipe         | Nullable | Deskripsi                                    |
|-----------------------|--------------|----------|-----------------------------------------------|
| tr_hr_pelamar_main_id | int          | No       | Primary key, auto increment                   |
| tr_hr_pelamar_id      | varchar(50)  | Yes      | ID pelamar (opsional, untuk integrasi eksternal) |
| nama                  | varchar(255) | No       | Nama pelamar                                 |
| ...                   | ...          | ...      | ... (lihat DATABASE_SCHEMA.md)               |

### (Lanjutkan untuk tabel lain sesuai DATABASE_SCHEMA.md)

## Fitur Utama
- Daftar data master (tabel/list untuk setiap entitas master)
- CRUD data master (tambah, edit, hapus/arsip jika aman)
- Validasi field wajib dan duplikasi
- Akses hanya untuk admin/HR
- Integrasi ke seluruh form/dropdown aplikasi
- Audit trail perubahan data master
- Tidak ada fitur hapus permanen untuk data master penting (perusahaan, divisi, bank)

## Struktur Halaman
- Sidebar/menu: "Pengaturan Master"
- Link ke halaman master perusahaan, divisi, dan bank di atas tab pengaturan master
- Tab/sub-menu untuk setiap entitas master:
  - Master Posisi/Jabatan
  - Master Asal Lamaran
  - Master Status Pelamar
  - Master Template Pesan WA
- Tabel data dan tombol tambah/edit (tanpa hapus) di setiap halaman master perusahaan/divisi/bank

## Komponen & Teknologi
- Livewire: CRUD dinamis tanpa reload
- Blade: Tampilan utama
- Bootstrap: UI tab/modal/tabel
- Policy/Middleware: Proteksi akses admin/HR

## Langkah Implementasi
1. Tambah route group `/master` di `routes/web.php`
2. Buat folder `app/Livewire/Master` untuk komponen Livewire
3. Scaffold Livewire component: `MasterPosisi`, `MasterAsalLamaran`, `MasterStatusPelamar`, `MasterTemplatePesan`
4. Buat halaman utama `resources/views/master/index.blade.php` dengan tab untuk setiap entitas master
5. Pastikan sudah ada migration & model untuk tabel master, atau buat jika belum ada
6. Implementasi CRUD, validasi, dan feedback error
7. Integrasi data master ke seluruh aplikasi
8. Tambahkan audit trail (created_by, updated_by)
9. Uji akses, validasi, dan integrasi

## Catatan
- Tidak boleh hapus permanen data master yang sudah dipakai (gunakan soft delete/arsip)
- Tidak ada fitur hapus untuk master perusahaan, divisi, dan bank
- Perubahan data master langsung ter-refleksi di aplikasi
- Notifikasi jika data master dihapus/dinonaktifkan dan masih dipakai

---

Disiapkan: 1 November 2025
