<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsHrPelamarType extends Model
{
    protected $table = 'ms_hr_pelamar_type';
    protected $primaryKey = 'ms_hr_pelamar_type_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';
    protected $fillable = [
        'ms_hr_pelamar_type_id',
        'type_desc',
    ];
}
