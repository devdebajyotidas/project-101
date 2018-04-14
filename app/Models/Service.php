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

    public function ScopeDistance($query,$from_latitude,$from_longitude,$distance)
    {
        // This will calculate the distance in km
        // if you want in miles use 3959 instead of 6371
        $raw = \DB::raw('ROUND ( ( 6371 * acos( cos( radians('.$from_latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$from_longitude.') ) + sin( radians('.$from_latitude.') ) * sin( radians( latitude ) ) ) ) ) AS distance');
        return $query->select('*')->addSelect($raw)->orderBy( 'distance', 'ASC' )->groupBy('distance')->having('distance', '<=', $distance);
    }

}
