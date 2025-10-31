<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsHrKandidat extends Model
{
    protected $table = 'ms_hr_kandidat';
    protected $primaryKey = 'ms_hr_kandidat_emp_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'ms_hr_kandidat_emp_id', 'ms_status_id', 'ms_user_id', 'date_kandidat', 'date_emp',
        'date_hrd_approve', 'date_finance_approve', 'date_bod_approve',
        'rating_hrd', 'rating_finance', 'rating_bod', 'rating_spv', 'date_spv'
    ];
}
