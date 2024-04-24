<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutstationStop extends Model
{
    protected $fillable = [
        'outstation_id',
        'location',
        'lat',
        'lng',
    ];

    // Add any additional relationships or methods here
}
