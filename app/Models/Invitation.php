<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable=[
        'token','name','email','mobile','is_joined'
    ];

    public static $rules = [
        "create" => [
            'email' => 'required|email|unique:users',
            'mobile' => 'required|unique:users',
            'name' => 'required',
        ],
    ];
}
