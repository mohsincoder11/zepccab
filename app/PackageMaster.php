<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageMaster extends Model
{
    protected $fillable = [
        'package_title',
        'package_type',
        'per_km_amount',
        'per_day_amount',
        'per_day_desc',
        'per_km_desc',
        'waiting_charge',
        'toll_n_parking_desc',
        'night_hault_desc',
        'fixed_rate'       
    ];
}
