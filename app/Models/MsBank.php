<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsBank extends Model
{
    protected $table = 'ms_bank';
    protected $primaryKey = 'Bank_Code';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'rec_usercreated',
        'rec_userupdate',
        'rec_datecreated',
        'rec_dateupdate',
        'rec_status',
        'Bank_Code',
    ];
}
