<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrHrBaRevisi extends Model
{
    protected $table = 'tr_hr_ba_revisi';
    protected $primaryKey = 'tr_hr_ba_revisi_id';
    public $incrementing = false; // Karena PK bukan auto increment
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'tr_hr_ba_revisi_id', // Include primary key
        'tr_hr_ba_main_id',
        'ms_user_id',
        'field',
        'qty_salah',
        'qty_benar',
        'date_salah',
        'date_benar',
        'money_salah',
        'money_benar',
        'text_salah',
        'text_benar',
        'reason_desc',
        'database_name',
        'field_name',
        'migrasi_time',
        'query_id',
    ];

    protected $casts = [
        'date_salah' => 'date',
        'date_benar' => 'date',
        'migrasi_time' => 'datetime',
        'money_salah' => 'decimal:2',
        'money_benar' => 'decimal:2',
    ];

    // Relationship to Main BA
    public function baMain()
    {
        return $this->belongsTo(TrHrBaMain::class, 'tr_hr_ba_main_id', 'tr_hr_ba_id');
    }

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(MsHrUser::class, 'ms_user_id', 'id');
    }

    // Accessor for before/after comparison
    public function getComparisonAttribute()
    {
        $before = '';
        $after = '';

        if ($this->qty_salah !== null) {
            $before = $this->qty_salah;
            $after = $this->qty_benar;
        } elseif ($this->date_salah !== null) {
            $before = $this->date_salah ? $this->date_salah->format('d/m/Y') : '';
            $after = $this->date_benar ? $this->date_benar->format('d/m/Y') : '';
        } elseif ($this->money_salah !== null) {
            $before = 'Rp ' . number_format($this->money_salah, 0, ',', '.');
            $after = 'Rp ' . number_format($this->money_benar, 0, ',', '.');
        } elseif ($this->text_salah !== null) {
            $before = $this->text_salah;
            $after = $this->text_benar;
        }

        return [
            'before' => $before,
            'after' => $after,
        ];
    }

    // Accessor for short reason
    public function getShortReasonAttribute()
    {
        if (!$this->reason_desc) return '-';
        
        return strlen($this->reason_desc) > 50 
            ? substr($this->reason_desc, 0, 50) . '...'
            : $this->reason_desc;
    }
}
