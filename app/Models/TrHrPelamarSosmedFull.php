<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrHrPelamarSosmedFull extends Model
{
    protected $table = 'tr_hr_pelamar_sosmed';
    protected $primaryKey = 'tr_hr_pelamar_sosmed';
    public $incrementing = true;
    protected $fillable = [
        'sosmed_link', 'tr_hr_pelamar_id', 'sosmed_user', 'sosmed_type', 'date_created', 'user_created'
    ];
}
