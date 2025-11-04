<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrHrBaPelaku extends Model
{
    protected $table = 'tr_hr_ba_pelaku';
    protected $primaryKey = 'tr_hr_ba_pelaku_id';
    public $incrementing = false; // Karena PK bukan auto increment
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'tr_hr_ba_pelaku_id', // Include primary key
        'tr_hr_ba_id',
        'ms_user_id',
        'text_ba',
        'date_ba',
        'ms_type_ba_pelaku_id',
        'cek_fraud',
        'cek_pelanggaran',
        'cek_kode_etik',
        'cek_disiplin',
        'cek_berulang',
    ];

    protected $casts = [
        'date_ba' => 'date',
        'cek_fraud' => 'boolean',
        'cek_pelanggaran' => 'boolean',
        'cek_kode_etik' => 'boolean',
        'cek_disiplin' => 'boolean',
        'cek_berulang' => 'boolean',
    ];

    // Relationship to Main BA
    public function baMain()
    {
        return $this->belongsTo(TrHrBaMain::class, 'tr_hr_ba_id', 'tr_hr_ba_id');
    }

    // Relationship to User (pelaku)
    public function user()
    {
        return $this->belongsTo(MsHrUser::class, 'ms_user_id', 'id');
    }

    // Accessor for formatted date
    public function getFormattedDateAttribute()
    {
        return $this->date_ba ? $this->date_ba->format('d/m/Y') : '-';
    }

    // Accessor for violation types
    public function getViolationTypesAttribute()
    {
        $violations = [];
        if ($this->cek_fraud) $violations[] = 'Fraud';
        if ($this->cek_pelanggaran) $violations[] = 'Pelanggaran';
        if ($this->cek_kode_etik) $violations[] = 'Kode Etik';
        if ($this->cek_disiplin) $violations[] = 'Disiplin';
        if ($this->cek_berulang) $violations[] = 'Berulang';
        
        return implode(', ', $violations);
    }
}
