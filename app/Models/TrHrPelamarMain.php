<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrHrPelamarMain extends Model
{
    protected $table = 'tr_hr_pelamar_main';
    protected $primaryKey = 'tr_hr_pelamar_main_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'tr_hr_pelamar_main_id',
        'nama',
        'email',
        'no_hp',
        'status',
        'created_at',
        'updated_at',
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
        'date_created',
        'cek_shortlist',
        'cek_helper',
        'cek_staff',
        'google_event_id', // Untuk simpan event Google Calendar
    ];
    public $timestamps = false;

    // Helper untuk tipe pelamar
    public function isDriver()
    {
        return (bool) $this->cek_driver;
    }

    public function isStaff()
    {
        return (bool) $this->cek_staff;
    }

    public function isHelper()
    {
        return (bool) $this->cek_helper;
    }

    public function pengalaman()
    {
        return $this->hasMany(\App\Models\TrHrPelamarPengalamanPerusahaan::class, 'tr_hr_pelamar_id', 'tr_hr_pelamar_main_id');
    }

    public function hasilInterview()
    {
        return $this->hasMany(TrHrPelamarInterviewMain::class, 'tr_hr_pelamar_main_id', 'tr_hr_pelamar_main_id');
    }

    public function personal()
    {
        return $this->hasOne(\App\Models\TrHrPelamarPersonal::class, 'tr_hr_pelamar_id', 'tr_hr_pelamar_main_id');
    }


    public function sosmed()
    {
        return $this->hasMany(\App\Models\TrHrPelamarSosmed::class, 'tr_hr_pelamar_id', 'tr_hr_pelamar_main_id');
    }
}
