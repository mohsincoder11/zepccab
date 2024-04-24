<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'customer_id',
        'customer_id',
        'number_of_days',
        'rate',
        'ride_type',
        'from_origin',
        'to_destination',
        'from_lat',
        'from_lng',
		'cartype_id',
		'date',
		'time',
        'status'
    ];
}
