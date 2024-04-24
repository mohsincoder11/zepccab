<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageCarTypeLinking extends Model
{
    protected $table = 'package_cartype_linking';
    protected $fillable = [
        'city_id',
        'package_id',
        'cartype_id',
        'amount',
        'created_at',
        'updated_at'
    ];
}
