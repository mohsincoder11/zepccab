<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShareRide extends Model
{
    protected $table = 'share_ride';
    protected $fillable = [
        'customer_id',
        'from_origin',
        'to_destination',
        'travel_date',
        'pickup_time',
        'car_type',
        'vacancy',
        'created_at',
        'updated_at'
    ];
}
