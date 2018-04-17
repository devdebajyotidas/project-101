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
        'is_active'
    ];

    public function account(){

        return $this->belongsTo('App\Models\Account');

    }

//    public function comment()
//    {
//        return $this->hasMany('App\Models\Comments','provider_id','account_id');
//    }

}
