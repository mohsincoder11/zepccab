<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RideCustomerLinking extends Model
{
    protected $table = 'share_ride_customer_linking';
    protected $fillable = [
        'srcl_id',
        'customer_id',
        'consession',
        'created_at',
        'updated_at'
    ];
}
