<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsHrBaKejadian extends Model
{
    protected $table = 'ms_hr_ba_kejadian';
    protected $primaryKey = 'ms_hr_ba_kejadian_id';
    public $incrementing = false; // Manual ID generation
    protected $keyType = 'int';
    
    // Disable timestamps untuk menghindari SQL Server timestamp issue
    public $timestamps = false;

    protected $fillable = [
        'ms_hr_ba_kejadian_id', // Tambahkan ini untuk manual insert
        'ms_hr_ba_kejadian_desc',
    ];

    // Scope untuk filter aktif
    public function scopeActive($query)
    {
        return $query->whereNotNull('ms_hr_ba_kejadian_desc');
    }

    // Scope untuk pencarian
    public function scopeSearch($query, $search)
    {
        return $query->where('ms_hr_ba_kejadian_desc', 'like', "%{$search}%");
    }
}