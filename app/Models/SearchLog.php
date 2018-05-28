<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchLog extends Model
{
    protected $fillable=[
        'account_id',
        'name',
        'latitude',
        'longitude',
        'radius'
    ];
}
