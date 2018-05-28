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
        'service_id',
        'rate',
        'latitude',
        'longitude',
        'area',
        'is_active'
    ];

    public static $rules = [
        "create" => [
            'service_id' => 'required',
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

    public function adminService(){

        return $this->belongsTo('App\Models\AdminService');

    }

}
