<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrHrPelamarDriver extends Model
{
    protected $table = 'tr_hr_pelamar_driver';
    protected $primaryKey = 'tr_pelamar_driver_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'tr_pelamar_driver_id', 'nama_driver', 'sim', 'tanggal_lahir', 'alamat'
    ];
}
