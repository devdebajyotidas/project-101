<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportAbuse extends Model
{
    protected $fillable=[
        'provider_id',
        'user_id',
        'comment_id'
    ];

    public function comment(){
        return $this->hasMany('App\Models\Comments','id','comment_id');
    }

    function taker(){

        return $this->hasMany('App\Models\Account','id','user_id');
    }

    function provider(){
        return $this->hasMany('App\Models\Account','id','account_id');
    }
}
