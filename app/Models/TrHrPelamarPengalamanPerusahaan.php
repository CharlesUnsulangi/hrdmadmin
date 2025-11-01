<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrHrPelamarPengalamanPerusahaan extends Model
{
    protected $table = 'tr_hr_pelamar_pengalaman_perusahaan';
    protected $primaryKey = 'tr_hr_pelamar_pengalaman_id';
    public $incrementing = true;
    protected $fillable = [
        'tr_hr_pelamar_id',
        'perusahaan',
        'tgl_start',
        'tgl_end',
        'hp_hrd',
        'nama_hrd',
        'hp_atasan',
        'alasan_resign',
        'jabatan_akhir',
        'jabatan_awal',
        'gaji_awal',
        'gaji_akhir',
        'sukses_rating',
        'sukses_keterangan',
        'sulit_rating',
        'sulit_keterangan',
        'puas_rating',
        'puas_keterangan',
        'masalah_rating',
        'masalah_keterangan',
        'kesalahan_paling_besar',
    ];
}
