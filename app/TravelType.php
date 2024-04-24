<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelType extends Model
{
    protected $table = 'travel_type';
    protected $fillable = [
        'name',
        'created_at',
        'updated_at'
    ];
}
