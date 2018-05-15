<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceTaken extends Model
{
    protected $fillable=[
        'service_id',
        'provider_id',
        'user_id',
        'amount',
        'completed_at'
    ];

    public static $rules = [
        "create" => [
            'service_id' => 'required',
            'user_id'=>'required',
        ]
    ];

    public function account(){

        return $this->hasMany('App\Models\Account','id','user_id');

    }

    public function service(){

        return $this->belongsTo('App\Models\Service');

    }
}
