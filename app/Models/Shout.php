<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shout extends Model
{

    protected  $fillable=[
        'user_id',
        'service_id',
        'area',
        'latitude',
        'longitude',
        'taken_by',
        'is_complete'
    ];

    public static $rules = [
        "create" => [
            'latitude' => 'required',
            'longitude' => 'required',
            'user_id' => 'required',
            'service_id' => 'required',
        ]
    ];

    function taker(){

        return $this->hasMany('App\Models\Account','id','user_id');
    }

    function provider(){
        return $this->hasMany('App\Models\Account','id','taken_by');
    }

    function adminService(){
        return $this->hasMany('App\Models\AdminService','id','service_id');
    }

}
