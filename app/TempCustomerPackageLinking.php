<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempCustomerPackageLinking extends Model
{
    protected $table='temp_customer_package_linking';
    protected $fillable = [
        'travel_type',
        'ride_later_date',
        'ride_later_time',
        'pctl_id',
        'customer_id',
        'coupun_id',
        'latitude',
        'longitude',
        'created_at',
        'updated_at',
        'status',
        'city_id',
        'amount',
        'distance_driver_user_km',
        'distance_user_destination_km',
        'custoemr_amount',
        'cartype_id',
        'ref_id'
    ];
    
}
