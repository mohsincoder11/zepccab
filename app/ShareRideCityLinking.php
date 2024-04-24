<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShareRideCityLinking extends Model
{
    protected $table = 'share_ride_city_linking';
    protected $fillable = [
        'share_ride_id',
        'city_name',
        'charges_per_person',
        'created_at',
        'updated_at'
    ];
}
