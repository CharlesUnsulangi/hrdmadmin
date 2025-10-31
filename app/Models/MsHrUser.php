<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class MsHrUser extends Model implements AuthenticatableContract
{
    use Authenticatable;
    protected $table = 'ms_hr_user';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Override the method to use email as the auth identifier.
     */
    public function getAuthIdentifierName()
    {
        return 'email';
    }
}
