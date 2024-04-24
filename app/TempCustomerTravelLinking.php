<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempCustomerTravelLinking extends Model
{
    protected $table='temp_customer_travel_linking';
    protected $fillable = [
        'customer_id',
        'travel_type_id',
        'car_type_id',
        'from_latitude',
        'from_longitude',
        'to_latitude',
        'to_longitude',
        'from_location',
        'to_location',
        'ride_later_date',
        'ride_later_time',
        'coupon_id', 
        'status',
        'created_at',
        'updated_at',
        'ref_id'
    ];
}
