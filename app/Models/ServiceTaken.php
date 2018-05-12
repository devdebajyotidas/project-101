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
}
