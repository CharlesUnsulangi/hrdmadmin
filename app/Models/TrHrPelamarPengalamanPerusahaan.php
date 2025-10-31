<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrHrPelamarPengalamanPerusahaan extends Model
{
    protected $table = 'tr_hr_pelamar_pengalaman_perusahaan';
    protected $primaryKey = 'tr_hr_pelamar_pengalaman_id';
    public $incrementing = true;
    protected $fillable = [
        'tr_hr_pelamar_id', 'nama_perusahaan', 'jabatan', 'tanggal_masuk', 'tanggal_keluar', 'alasan_keluar'
    ];
}
