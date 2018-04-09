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
        'aadhaar',
        'cover_photo',
        'location',
        'is_provider',
        'language',
        'aadhaar_verified',
        'is_blocked'
    ];

    public function user()
    {
        return $this->morphOne('App\Models\User','account');
    }
}
