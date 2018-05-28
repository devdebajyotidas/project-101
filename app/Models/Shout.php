<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shout extends Model
{
    protected  $fillable=[
        'user_id',
        'service_id',
        'latitude',
        'longitude',
        'taken_by',
        'is_complete'
    ];

    function account(){

    }

    function service(){

    }

}
