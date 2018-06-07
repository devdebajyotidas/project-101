<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected  $fillable=['account_id'];

    function account(){
        return $this->belongsTo('App\Models\Account');
    }
}
