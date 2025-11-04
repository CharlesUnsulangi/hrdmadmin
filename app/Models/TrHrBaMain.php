<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrHrBaMain extends Model
{
    protected $table = 'tr_hr_ba_main';
    protected $primaryKey = 'tr_hr_ba_id';
    public $incrementing = false; // Karena PK bukan auto increment
    protected $keyType = 'int'; // Type PK
    
    // Custom timestamp column names
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'update_at'; // Sesuai DB schema: update_at (bukan updated_at)
    public $timestamps = true; // Enable timestamps dengan custom names

    protected $fillable = [
        'tr_hr_ba_id',
        'ms_user_id',
        'date_ba',
        'note_ba',
        'ms_hr_ba_type_id',
        'pelaku_desc',
        'kronologi', // Tambah kolom kronologi
    ];

    protected $casts = [
        'date_ba' => 'date',
        'update_at' => 'datetime', // Custom updated_at column name
        // Skip created_at casting karena SQL Server timestamp issue
    ];

    // Override timestamp handling untuk SQL Server
    public function freshTimestamp()
    {
        return now()->format('Y-m-d H:i:s');
    }
    
    // Handle created_at secara manual karena SQL Server timestamp issue
    public function getCreatedAtAttribute($value)
    {
        // Jika value adalah binary timestamp dari SQL Server
        if ($value && !is_string($value)) {
            return null; // Return null untuk sekarang, atau implementasi konversi binary
        }
        return $value ? \Carbon\Carbon::parse($value) : null;
    }

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(MsHrUser::class, 'ms_user_id', 'id');
    }

    // Relationship to Pelaku (for BA Temuan) - DISABLED until table exists
    /*
    public function pelaku()
    {
        return $this->hasMany(TrHrBaPelaku::class, 'tr_hr_ba_id', 'tr_hr_ba_id');
    }
    */

    // Relationship to Laka (for BA Laka)
    public function laka()
    {
        return $this->hasOne(TrHrBaLaka::class, 'tr_hr_ba_id_id', 'tr_hr_ba_id');
    }

    // Relationship to Revisi (for BA Revisi) - DISABLED until table exists
    /*
    public function revisi()
    {
        return $this->hasMany(TrHrBaRevisi::class, 'tr_hr_ba_main_id', 'tr_hr_ba_id');
    }
    */

    // Scope for filtering by BA type
    public function scopeByType($query, $type)
    {
        return $query->where('ms_hr_ba_type_id', $type);
    }

    // Accessor for formatted date
    public function getFormattedDateAttribute()
    {
        return $this->date_ba ? $this->date_ba->format('d/m/Y') : '-';
    }

    // Accessor for BA type name
    public function getTypeNameAttribute()
    {
        $types = [
            'TEMUAN' => 'BA Temuan',
            'LAKA' => 'BA Laka',
            'REVISI' => 'BA Revisi',
        ];
        
        return $types[$this->ms_hr_ba_type_id] ?? $this->ms_hr_ba_type_id;
    }
}
