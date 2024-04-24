<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverPackageLinking extends Model
{
    protected $table = 'driver_package_linking';
    protected $fillable = [
        'customer_package_id',
        'driver_id',
        'status',
        'distance_driver_user_km',
        'distance_user_destination_km',
        'custoemr_amount',
        'otp',
        'cancelled_by',
        'reason',
        'created_at',
        'updated_at'
    ];
}
