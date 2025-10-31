<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrHrWaMsgId extends Model
{
    protected $table = 'tr_hr_wa_msg_id';
    protected $primaryKey = 'tr_hr_wa_msg_id';
    public $incrementing = true;
    protected $fillable = [
        'email'
    ];
}
