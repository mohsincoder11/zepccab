<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'package';
    protected $fillable = [
        'name',
        'km',
        'hour',
        'created_at',
        'updated_at'
    ];
}
