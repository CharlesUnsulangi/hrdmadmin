


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoFillUserCreated;

class TrHrBgCheck extends Model
{
    use AutoFillUserCreated;

    protected $table = 'tr_hr_bg_check';
    protected $primaryKey = 'tr_hr_bg_check_id';
    public $incrementing = true;
    protected $keyType = 'int';

    // TIMESTAMP CUSTOM
    public $timestamps = true;
    const CREATED_AT = 'date_created';
    const UPDATED_AT = null;

    // USER ISI INI
    protected $fillable = [
        'tr_hr_pelamar_main_id',
        'telepon',
        'nama',
        'ms_hr_user_id',
        'note',
        'jabatan_bg',
    ];

    // ADMIN ONLY
    protected $fillable_admin = [
        'cek_fraud',
        'cek_bohong',
        'nilai_positif',
        'nilai_negatif',
        'cek_rekomendasi',
    ];

    // CASTING
    protected $casts = [
        'date_created'     => 'datetime',
        'cek_fraud'        => 'boolean',
        'cek_bohong'       => 'boolean',
        'cek_rekomendasi'  => 'boolean',
        'nilai_positif'    => 'integer',
        'nilai_negatif'    => 'integer',
    ];

    // RELASI
    public function pelamar()
    {
        return $this->belongsTo(TrHrPelamarMain::class, 'tr_hr_pelamar_main_id', 'tr_hr_pelamar_main_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\MsHrUser::class, 'ms_hr_user_id');
    }

    // MAGIC HELPER
    public function getSkorAttribute(): int
    {
        return $this->nilai_positif - $this->nilai_negatif;
    }

    public function getSkorBadgeAttribute(): string
    {
        $skor = $this->skor;
        $color = match(true) {
            $skor >= 8 => 'green',
            $skor >= 5 => 'blue',
            $skor >= 0 => 'yellow',
            default => 'red',
        };
        $label = match(true) {
            $skor >= 8 => 'Excellence',
            $skor >= 5 => 'Baik',
            $skor >= 0 => 'Netral',
            default => 'Waspada',
        };
        return "<span class='px-3 py-1 bg-{$color}-600 text-white rounded-full text-xs font-bold'>{$label} ({$skor}/10)</span>";
    }

    public function getRekomendasiBadgeAttribute(): string
    {
        return $this->cek_rekomendasi
            ? '<span class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm">✔ Direkomendasikan</span>'
            : '<span class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm">✖ Tidak Direkomendasikan</span>';
    }
}
