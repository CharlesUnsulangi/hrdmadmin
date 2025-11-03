# Update Relasi di tr_hr_pelamar_main

## Kolom status
- Kolom `status` pada tabel `tr_hr_pelamar_main` sekarang direlasikan ke tabel master `ms_hr_pelamar_status`.
- Relasi di model: 
  ```php
  public function statusPelamar() {
      return $this->belongsTo(MsHrPelamarStatus::class, 'status', 'ms_hr_pelamar_status_id');
  }
  ```
- Dengan ini, status pelamar bisa diambil lengkap dengan deskripsi dari master status.

## Struktur Tabel (update)
| Nama Kolom              | Tipe Data   | Keterangan                               |
|-------------------------|-------------|-------------------------------------------|
| status                  | varchar(50) | **Foreign Key** ke `ms_hr_pelamar_status.ms_hr_pelamar_status_id` |

## Contoh Penggunaan
Ambil pelamar beserta deskripsi status:
```php
$pelamar = TrHrPelamarMain::with('statusPelamar')->get();
foreach ($pelamar as $p) {
    echo $p->nama . ' - ' . ($p->statusPelamar->status_desc ?? '-');
}
```
