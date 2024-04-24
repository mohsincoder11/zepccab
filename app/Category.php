<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'menu_categories';
    protected $fillable = [
        'restaurant',
        'name',
        'created_at',
        'updated_at'
    ];
}
