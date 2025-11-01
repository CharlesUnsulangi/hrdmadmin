<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsHrWaMsg extends Model
{
    protected $table = 'ms_hr_wa_msg';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = [
        'msg_code', 'msg_text', 'created_at', 'updated_at'
    ];
    public $timestamps = true;
}
