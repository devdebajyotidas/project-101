<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Otp extends Model
{
    use Auditable;

    protected $fillable = [
        'otp',
    ];
}
