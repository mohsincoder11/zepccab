<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table = 'driver';
    protected $fillable = [
        'city_id',
        'vendor_id',
        'first_name',
        'last_name',
        'email_id',
        'mobile_no',
        'address',
        'city',
        'bank_details',
        'aadhar czard',
        'driving_license',
        'driver_photo',
        'current_latitude',
        'current_longitude',
		'available',
        'created_at',
        'updated_at'
    ];
}
