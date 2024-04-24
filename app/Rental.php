<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $table = 'outstation';
    protected $fillable = [
        'customer_id',
        'from_origin',
        'to_destination',
        'car_type_id',
        'type',
        'outstation_ride_type',
        'company_id',
        'vendor_id',
        'package_id',
        'days',
        'from_time',
        'to_time',
        'created_at',
        'updated_at',
        'date'
    ];
    public function outstationStops()
    {
        return $this->hasMany(OutstationStop::class);
    }
}
