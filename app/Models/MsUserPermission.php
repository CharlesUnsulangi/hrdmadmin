<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsUserPermission extends Model
{
    protected $table = 'ms_user_permission';
    protected $primaryKey = 'id'; // Ganti jika ada primary key lain
    public $incrementing = true;
    protected $fillable = [
        // Tambahkan kolom sesuai struktur tabel
    ];
}
