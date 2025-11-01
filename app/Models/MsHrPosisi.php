<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsHrPosisi extends Model
{
    protected $table = 'ms_hr_posisi';
    protected $primaryKey = 'ms_hr_posisi_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['ms_hr_posisi_id', 'posisi_desc'];
}
