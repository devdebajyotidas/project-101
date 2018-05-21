<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
    protected  $table='services';

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
            'rate'=>'required',
            'latitude'=>'required',
            'longitude'=>'required',
            'area'=>'required',
        ],

    ];

    public function account(){

        return $this->belongsTo('App\Models\Account');

    }

    public function serviceTaken()
    {
        return $this->hasMany('App\Models\ServiceTaken','service_id','id');
    }


//    public function comment()
//    {
//        return $this->hasMany('App\Models\Comments','provider_id','account_id');
//    }

}
