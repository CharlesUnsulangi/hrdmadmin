<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrHrPelamarMain extends Model
{
    protected $table = 'tr_hr_pelamar_main';
    protected $primaryKey = 'tr_hr_pelamar_main_id';
    public $incrementing = true;
    protected $fillable = [
        'tr_hr_pelamar_id',
        'nama',
        'email',
        'hp',
        'posisi',
        'user_created',
        'date_created',
        'rating',
        'cek_confirm',
        'time_confirm',
        'cek_cv',
        'cek_driver',
        'cek_interview',
        'cek_kandidat',
        'cek_priority',
        'cek_tolak',
        'cek_wa',
        'time_cv',
        'time_interview',
        'time_wa',
        'link_cv',
        'asal_lamaran',
        'ms_hr_from_id',
        'status'
    ];
}
