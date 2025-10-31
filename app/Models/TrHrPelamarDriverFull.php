<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrHrPelamarDriverFull extends Model
{
    protected $table = 'tr_hr_pelamar_driver';
    protected $primaryKey = 'tr_pelamar_driver_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'tr_pelamar_driver_id', 'nama', 'nama_keluarga', 'email', 'hp', 'no_sim', 'jenis_sim', 'tanggal_lahir',
        'kota_lahir', 'agama', 'alamat', 'pekerjaan_sebelumnya', 'kapan_terakhir_bekerja', 'alasan_keluar',
        'tahu_lamaran_dari', 'kenal_siapa'
    ];
}
