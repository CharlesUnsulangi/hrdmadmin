
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
    public $timestamps = false;
    protected $fillable = [
        'tr_hr_pelamar_main_id',
        'telepon',
        'nama',
        'ms_hr_user_id',
        'note',
        'cek_fraud',
        'cek_bohong',
        'nilai_positif',
        'nilai_negatif',
        'cek_rekomendasi',
        'jabatan_bg',
        'date_created',
        'user_created',
    ];
}
