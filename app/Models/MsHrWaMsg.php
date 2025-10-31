<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsHrWaMsg extends Model
{
    protected $table = 'ms_hr_wa_msg';
    protected $primaryKey = 'id'; // Ganti jika ada primary key lain
    public $incrementing = true;
    protected $fillable = [
        // Tambahkan kolom sesuai struktur tabel
    ];
}
