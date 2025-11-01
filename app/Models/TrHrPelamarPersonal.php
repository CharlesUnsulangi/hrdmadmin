<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrHrPelamarPersonal extends Model
{
    protected $table = 'tr_hr_pelamar_personal';
    protected $primaryKey = 'tr_hr_pelamar_id';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'tr_hr_pelamar_id',
        'nama',
        'nama_keluarga',
        'date_lahir',
        'kota_lahir',
        'alamat',
        'jenis',
        'agama',
        'pendidikan',
        'cek_pengalaman',
    ];
}
