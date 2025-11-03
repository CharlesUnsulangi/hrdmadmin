<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrHrPkwtt extends Model
{
    protected $table = 'tr_hr_pkwtt';
    protected $primaryKey = 'tr_hd_pkwtt_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'tr_hd_pkwtt_id', 'ms_emp_id', 'date_pkwtt_start', 'date_pkwtt_end', 'date_sign', 'ms_user_id', 'ms_company_id', 'month'
    ];
}
