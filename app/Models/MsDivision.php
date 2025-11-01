<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsDivision extends Model
{
    protected $table = 'ms_division';
    protected $primaryKey = 'div_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'rec_usercreated',
        'rec_userupdate',
        'rec_datecreated',
        'rec_dateupdate',
        'rec_status',
        'div_id',
        'div_desc',
    ];
}
