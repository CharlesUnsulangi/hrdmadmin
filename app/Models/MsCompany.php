<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsCompany extends Model
{
    protected $table = 'ms_company';
    protected $primaryKey = 'company_code';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'rec_usercreated',
        'rec_userupdate',
        'rec_datecreated',
        'rec_dateupdate',
        'rec_status',
        'company_code',
        'company_desc',
    ];
}
