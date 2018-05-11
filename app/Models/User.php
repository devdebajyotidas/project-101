<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements AuditableContract
{
    use Notifiable;
    use SoftDeletes;
    use Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'account_id',
        'account_type',
        'verification_token',
        'mobile_verified',
        'email_verified',
        'fcm_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',
        'fcm_token',
        'api_token',
        'account_type'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static $rules = [
        "create" => [
            'email' => 'required|email|unique:users',
            'mobile' => 'required|unique:users',
            'password' => 'confirmed|min:6',
        ],
        "update" => [
            'email' => 'email|unique:users',
            'password' => 'confirmed|min:6',
        ],

    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function account()
    {
        return $this->morphTo('account');
    }

    public static function resolveId()
    {
        return Auth::check() ? Auth::user()->getAuthIdentifier() : null;
    }

    public function comment()
    {
        return $this->hasMany('App\Models\Comments','user_id','account_id');
    }
}
