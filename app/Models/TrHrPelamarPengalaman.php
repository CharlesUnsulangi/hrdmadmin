<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrHrPelamarPengalaman extends Model
{
    protected $table = 'tr_hr_pelamar_pengalaman';
    protected $fillable = [
        'tr_hr_pelamar_main_id',
        'nama_perusahaan',
        'jabatan',
        'tahun_masuk',
        'tahun_keluar',
        'deskripsi',
    ];

    public function pelamar()
    {
        return $this->belongsTo(TrHrPelamarMain::class, 'tr_hr_pelamar_main_id', 'tr_hr_pelamar_main_id');
    }
}
