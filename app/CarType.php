<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    protected $table = 'car_types';
    protected $fillable = [
        'name',
        'city_id',
        'variation',
        'base_price',
        'icon',
        'created_at',
        'updated_at'
    ];
}
