<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrHrPelamarSkedul extends Model
{
    protected $table = 'tr_hr_pelamar_skedul';
    protected $primaryKey = 'tr_hr_pelamar_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'tr_hr_pelamar_id', 'skedul_pelamar_time', 'skedul_confirmed'
    ];
}
