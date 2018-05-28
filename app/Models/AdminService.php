<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminService extends Model
{
   use SoftDeletes;

    protected $fillable=[
        'name',
        'image'
    ];

    public function service()
    {
        return $this->hasMany('App\Models\Service','service_id','id');
    }
    public function serviceTaken()
    {
        return $this->hasMany('App\Models\ServiceTaken','service_id','id');
    }

    public function shout()
    {
        return $this->belongsTo('App\Models\Shout');
    }

}
