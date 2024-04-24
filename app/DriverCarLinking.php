<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverCarLinking extends Model
{
    protected $table = 'driver_car_linking';
    protected $fillable = [
        'driver_id',
        'car_id',
        'created_at',
        'updated_at'
    ];
}
