<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sos extends Model
{
    protected $table = 'sos';
    protected $fillable = [
        'city_id',
        'police_station_name',
        'address',
        'phone_no',
        'created_at',
        'updated_at'
    ];
}
