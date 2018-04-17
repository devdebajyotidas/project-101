<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = [
        'provider_id',
        'user_id',
        'ratings',
        'comment'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

//    public function service(){
//        return $this->belongsTo('App\Models\Service');
//    }
}
