<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupon';
    protected $fillable = [
        'city_id',
        'name',
        'from_date',
        'to_date',
        'variation',
        'value',
        'minimum_value',
        'car_type',
        'type',
        'type_no',
        'created_at',
        'updated_at'
    ];
}
