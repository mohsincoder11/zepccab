<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempOutStation extends Model
{
    protected $table='temp_outstation';
    protected $fillable = [
        'customer_id',
        'from_origin',
        'to_destination',
        'car_type_id',
        'type',
        'days',
        'from_time',
        'to_time',
        'created_at',
        'updated_at',
        'date',
        'status',
        'ref_id'
    ];
}
