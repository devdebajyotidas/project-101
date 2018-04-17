<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Account extends Model implements AuditableContract
{
    use Auditable;

    public $timestamps = false;

    protected $fillable=[
        'about',
        'address',
        'city',
        'state',
        'country',
        'zip',
        'aadhaar',
        'cover_photo',
        'longitude',
        'latitude',
        'is_provider',
        'language',
        'aadhaar_verified',
        'is_blocked'
    ];

    public function user()
    {
        return $this->morphOne('App\Models\User','account');
    }

    public function service()
    {
        return $this->hasMany('App\Models\Service','account_id','id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Service','user_id','id');
    }
}
