<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'cars';
    protected $fillable = [
        'city_id',
        'car_type_id',
        'car_name',
        'car_model',
        'owner_name',
        'fuel_type',
        'registration_number',
        'car_number',
        'bank_details',
        'car_validity',
        'owner_primary_mobile',
        'owner_secondary_mobile',
        'photos',
        'photos1',
		'available',
        'created_at',
        'updated_at'
    ];
}
