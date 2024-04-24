<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';
    protected $fillable = [
        'driver_customer_linking_id',
        'driver_package_linking',
        'rating',
        'review',
        'created_at',
        'updated_at'
    ];
}
