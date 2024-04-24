<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    protected $fillable = [
        'first_name',
        'mobile_no',
        'email_id',
        'id_proof_type',
        'id_proof',
		'is_corporate_booking_accessible',
        'created_at',
        'updated_at'
    ];
}
