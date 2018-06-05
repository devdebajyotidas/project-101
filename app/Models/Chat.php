<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable=[
        'provider_id',
        'user_id',
    ];

    function provider(){
        return $this->hasMany('App\Models\Account','id','provider_id');
    }

    function taker(){
        return $this->hasMany('App\Models\Account','id','user_id');
    }
}
