<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrHrBaLaka extends Model
{
    protected $table = 'tr_hr_ba_laka';
    protected $primaryKey = 'tr_hr_ba_laka_id';
    public $incrementing = false; // Karena PK bukan auto increment
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'tr_hr_ba_laka_id', // Include primary key
        'tr_hr_ba_id_id',  // Sesuai nama kolom di database
        'ms_truck_id',
        'ms_driver_id',
        'note_kronologi',
    ];

    // Relationship to Main BA
    public function baMain()
    {
        return $this->belongsTo(TrHrBaMain::class, 'tr_hr_ba_id_id', 'tr_hr_ba_id');
    }

    // Note: Assuming truck and driver master tables exist
    // public function truck()
    // {
    //     return $this->belongsTo(MsTruck::class, 'ms_truck_id', 'ms_truck_id');
    // }

    // public function driver()
    // {
    //     return $this->belongsTo(MsDriver::class, 'ms_driver_id', 'ms_driver_id');
    // }

    // Accessor for short kronologi
    public function getShortKronologiAttribute()
    {
        if (!$this->note_kronologi) return '-';
        
        return strlen($this->note_kronologi) > 100 
            ? substr($this->note_kronologi, 0, 100) . '...'
            : $this->note_kronologi;
    }
}
