<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminService extends Model
{
    protected $fillable=[
        'name',
        'image',
        'is_active'
    ];


}
