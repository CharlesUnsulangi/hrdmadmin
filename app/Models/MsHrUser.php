<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class MsHrUser extends Authenticatable
{
    use Notifiable;
    protected $table = 'ms_hr_user';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'is_active',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'integer', // Ubah ke integer karena database SQL Server pakai TINYINT
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship dengan MsHrUserRole
     * User belongs to one role berdasarkan nama role
     */
    public function userRole()
    {
        return $this->belongsTo(MsHrUserRole::class, 'role', 'ms_hr__user_role_name');
    }

    /**
     * Scope untuk user aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    /**
     * Scope untuk user tidak aktif
     */
    public function scopeInactive($query)
    {
        return $query->where('is_active', 0);
    }

    /**
     * Scope untuk mencari user berdasarkan role
     */
    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }

    /**
     * Accessor untuk nama (menggunakan username jika nama tidak ada)
     */
    public function getNamaAttribute()
    {
        return $this->attributes['nama'] ?? $this->username;
    }

    /**
     * Accessor untuk mendapatkan nama role 
     */
    public function getRoleNameAttribute()
    {
        return $this->userRole ? $this->userRole->role_name : $this->role;
    }

    /**
     * Helper method to check if user is active
     */
    public function isActive()
    {
        return $this->is_active == 1;
    }

    /**
     * Helper method to get status text
     */
    public function getStatusTextAttribute()
    {
        return $this->is_active == 1 ? 'Aktif' : 'Non-Aktif';
    }
}
