<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrHrPelamarSkedul extends Model
{
    protected $table = 'tr_hr_pelamar_skedul';
    protected $primaryKey = 'tr_hr_pelamar_skedul_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'tr_hr_pelamar_id', 'skedul_pelamar_time', 'skedul_confirmed', 'created_at', 'updated_at'
    ];

    public function pelamar()
    {
        return $this->belongsTo(\App\Models\TrHrPelamarMain::class, 'tr_hr_pelamar_id', 'tr_hr_pelamar_main_id');
    }
}
