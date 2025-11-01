<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsHrFrom extends Model
{
    protected $table = 'ms_hr_from';
    protected $primaryKey = 'ms_hr_from_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'ms_hr_from_id', 'form_hr_desc', 'created_at', 'updated_at'
    ];
    public $timestamps = true;
}
