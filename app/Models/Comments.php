<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = [
        'provider_id',
        'user_id',
        'service_id',
        'ratings',
        'comment',
        'is_approved'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function feedback(){
        return $this->belongsTo('App\Models\ReportAbuse');
    }
}
