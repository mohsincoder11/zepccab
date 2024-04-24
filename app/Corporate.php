<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corporate extends Model
{
    protected $table = 'corporate_booking';
    protected $fillable = [
        'customer_id',
        'from_origin',
        'to_destination',
        'car_type_id',
        'type',
        'from_date',
        'to_date',
        'company_name',
        'status',
        'amount_type',
        'from_lat',
        'from_lng',
        'perkm_amount',
        'per_day_desc',
        'night_hault_desc',
        'created_at',
        'updated_at'
    ];
}
