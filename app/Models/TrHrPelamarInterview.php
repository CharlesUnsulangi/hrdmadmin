<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrHrPelamarInterview extends Model
{
    protected $table = 'tr_hr_pelamar_interview';
    protected $primaryKey = 'tr_hr_pelamar_interview_id';
    public $incrementing = true;
    protected $fillable = [
        'tr_hr_pelamar_id', 'date_interview', 'time_start', 'time_end', 'note_operator', 'note_spv', 'note_mgr', 'note_hrd', 'note_bd', 'note_gm', 'note_dir', 'note_mgt', 'rating_operator', 'rating_spv', 'rating_mgr', 'rating_gm', 'rating_bd', 'rating_mgt', 'rating_hrd', 'cek_lanjut', 'cek_tolak'
    ];
}
