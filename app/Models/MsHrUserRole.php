<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MsHrUserRole extends Model
{
    use HasFactory;

    protected $table = 'ms_hr_user_role';
    protected $primaryKey = 'ms_hr_user_role_id';
    public $incrementing = true;
    protected $keyType = 'int';
    
    // Custom timestamps karena tabel menggunakan update_at bukan updated_at
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'update_at';

    protected $fillable = [
        'ms_hr__user_role_name',
        'created_at',
        'update_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'update_at' => 'datetime',
    ];

    /**
     * Relationship dengan MsHrUser
     * Satu role bisa dimiliki banyak user berdasarkan nama role
     */
    public function users()
    {
        return $this->hasMany(MsHrUser::class, 'role', 'ms_hr__user_role_name');
    }

    /**
     * Scope untuk mencari role berdasarkan nama
     */
    public function scopeByName($query, $name)
    {
        return $query->where('ms_hr__user_role_name', 'like', "%{$name}%");
    }

    /**
     * Accessor untuk mendapatkan nama role
     */
    public function getRoleNameAttribute()
    {
        return $this->ms_hr__user_role_name;
    }

    /**
     * Mutator untuk set nama role
     */
    public function setRoleNameAttribute($value)
    {
        $this->attributes['ms_hr__user_role_name'] = $value;
    }
}