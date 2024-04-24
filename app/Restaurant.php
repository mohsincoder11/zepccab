<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $table = 'restaurants';
    protected $fillable = [
        'name',
        'city',
        'tags',
        'address',
        'image',
        'created_at',
        'updated_at'
    ];
}
