<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'city';
    protected $fillable = [
        'name',
        'mobile_no',
        'latitude',
        'longitude',
        'radius_km',
        'created_at',
        'updated_at'
    ];
}
