
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoFillUserCreated;

class TrHrPelamarInterviewMain extends Model
{
    use AutoFillUserCreated;
    protected $table = 'tr_hr_pelamar_interview_main';
    protected $primaryKey = 'tr_hr_pelamar_interview_main_id';
    public $incrementing = true;
    protected $fillable = [
        'tr_hr_pelamar_main_id', 'interview_type', 'date_interview', 'time_start', 'time_end', 'note_operator', 'note_spv', 'note_mgr', 'note_hrd', 'note_bd', 'note_gm', 'note_dir', 'note_mgt', 'rating_operator', 'rating_spv', 'rating_mgr', 'rating_gm', 'rating_bd', 'rating_mgt', 'rating_hrd', 'cek_lanjut', 'cek_tolak', 'created_at', 'updated_at', 'user_created'
    ];

    public function pelamar()
    {
        return $this->belongsTo(TrHrPelamarMain::class, 'tr_hr_pelamar_main_id', 'tr_hr_pelamar_main_id');
    }
}
