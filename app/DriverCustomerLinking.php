<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverCustomerLinking extends Model
{
    protected $table = 'driver_customer_linking';
    protected $fillable = [
        'customer_travel_id',
        'driver_id',
        'status',
        'distance_driver_user_km',
        'distance_user_destination_km',
        'distance_user_destination_km',
        'custoemr_amount',
        'otp',
        'cancelled_by',
        'reason',
        'created_at',
        'updated_at'
    ];
}
