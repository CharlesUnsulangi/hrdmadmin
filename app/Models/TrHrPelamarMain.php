<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TrHrPelamarMain extends Model
{
    protected $table = 'tr_hr_pelamar_main';
    protected $primaryKey = 'tr_hr_pelamar_main_id';
    public $incrementing = false;
    protected $keyType = 'string';

    // Biarkan Laravel handle timestamp
    public $timestamps = true;
    const CREATED_AT = 'date_created';
    const UPDATED_AT = null;

    // AMAN: Hanya kolom yang boleh diisi user
    protected $guarded = ['tr_hr_pelamar_main_id'];

    // Casting otomatis
    protected $casts = [
        'date_created' => 'datetime',
        'time_confirm' => 'datetime',
        'time_cv'      => 'datetime',
        'time_wa'      => 'datetime',
        'time_interview' => 'datetime',
        'cek_driver'   => 'boolean',
        'cek_staff'    => 'boolean',
        'cek_helper'   => 'boolean',
        'cek_kandidat' => 'boolean',
        'cek_tolak'    => 'boolean',
        'rating'       => 'integer',
    ];

    // Auto UUID
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }


    // === RELASI ===
    public function statusPelamar()
    {
        return $this->belongsTo(MsHrPelamarStatus::class, 'status', 'ms_hr_pelamar_status_id');
    }

    public function tipePelamar()
    {
        return $this->belongsTo(MsHrPelamarType::class, 'ms_hr_pelamar_type_id', 'ms_hr_pelamar_type_id');
    }

    public function msHrFrom()
    {
        return $this->belongsTo(MsHrFrom::class, 'ms_hr_from_id', 'ms_hr_from_id');
    }

    public function pengalaman()
    {
        return $this->hasMany(TrHrPelamarPengalamanPerusahaan::class, 'tr_hr_pelamar_id', 'tr_hr_pelamar_main_id');
    }

    public function hasilInterview()
    {
        return $this->hasMany(TrHrPelamarInterviewMain::class, 'tr_hr_pelamar_main_id', 'tr_hr_pelamar_main_id');
    }

    public function personal()
    {
        return $this->hasOne(TrHrPelamarPersonal::class, 'tr_hr_pelamar_id', 'tr_hr_pelamar_main_id');
    }

    public function sosmed()
    {
        return $this->hasMany(TrHrPelamarSosmed::class, 'tr_hr_pelamar_id', 'tr_hr_pelamar_main_id');
    }

    // === HELPER ===
    public function isDriver(): bool   { return $this->cek_driver; }
    public function isStaff(): bool    { return $this->cek_staff; }
    public function isHelper(): bool   { return $this->cek_helper; }
    public function isKandidat(): bool { return $this->cek_kandidat; }
    public function isTolak(): bool    { return $this->cek_tolak; }

    // Label status
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'baru' => 'Baru',
            'interview' => 'Sedang Interview',
            'kandidat' => 'Kandidat Terpilih',
            'tolak' => 'Ditolak',
            default => 'Tidak Diketahui',
        };
    }

    // Badge HTML (opsional)
    public function getStatusBadgeAttribute(): string
    {
        $colors = [
            'baru' => 'bg-gray-500',
            'interview' => 'bg-blue-500',
            'kandidat' => 'bg-green-500',
            'tolak' => 'bg-red-500',
        ];
        $color = $colors[$this->status] ?? 'bg-gray-400';
        return "<span class='px-3 py-1 rounded-full text-white text-xs font-medium {$color}'>{$this->status_label}</span>";
    }
}
