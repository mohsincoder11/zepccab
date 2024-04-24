<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerPackageLinking extends Model
{
    protected $table = 'customer_package_linking';
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
        'updated_at'
    ];
}
