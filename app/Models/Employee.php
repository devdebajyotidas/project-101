<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'designation',
    ];

    public function user()
    {
        return $this->morphOne('App\Models\User','employee');
    }
}
