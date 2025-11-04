<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsAdminSp extends Model
{
    protected $table = 'ms_admin_sp';
    protected $primaryKey = 'ms_admin_sp_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'ms_admin_sp_id',
        'sp_desc',
        'date_start_input',
        'date_end_input',
        'money_input',
        'varchar_input',
        'sp_name',
    ];
}
