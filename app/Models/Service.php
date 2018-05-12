<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $fillable=[
        'account_id',
        'name',
        'rate',
        'latitude',
        'longitude',
        'area',
        'is_active'
    ];

    public static $rules = [
        "create" => [
            'name' => 'required',
            'rate'=>'required',
            'area' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ],
        "update" => [
            'name' => 'required',
            'rate'=>'required',
        ],

    ];

    public function account(){

        return $this->belongsTo('App\Models\Account');

    }

//    public function comment()
//    {
//        return $this->hasMany('App\Models\Comments','provider_id','account_id');
//    }

}
