<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrHrPelamarInterviewSpv extends Model
{
    protected $table = 'tr_hr_pelamar_interview_spv';
    protected $primaryKey = 'tr_hr_pelamar_operator_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = [
        'ms_user_id',
        'ms_hr_pelamar_main_id',
        'date_interview',
        'time_start',
        'time_end',
        'rating_final',
        'cek_offline',
        'cek_online',
        'red_flag',
        'green_flag',
        'note_interview',
    ];

    public function pelamar()
    {
        return $this->belongsTo(TrHrPelamarMain::class, 'ms_hr_pelamar_main_id', 'tr_hr_pelamar_main_id');
    }
}
