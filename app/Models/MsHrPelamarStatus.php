<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsHrPelamarStatus extends Model
{
    protected $table = 'ms_hr_pelamar_status';
    protected $primaryKey = 'ms_hr_pelamar_status_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';
    protected $fillable = [
        'ms_hr_pelamar_status_id',
        'status_desc',
    ];

    // Relasi ke pelamar utama
    public function pelamars()
    {
        return $this->hasMany(TrHrPelamarMain::class, 'status', 'ms_hr_pelamar_status_id');
    }
}
