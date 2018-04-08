<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;

class Account extends Model
{
    use Auditable;
    use SoftDeletes;

    protected $fillable=[
        'name',
        'email',
        'phone',
        'aadhaar',
        'photo',
        'cover_photo',
        'location'
    ];

    public static $rules = [
        'create' => [
            'phone' => 'required',
        ],
        'update' => [

        ]
    ];
}
