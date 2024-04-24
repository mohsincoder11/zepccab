<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    protected $table = 'menu_items';
    protected $fillable = [
        'menu_category',
        'name',
        'price',
        'image',
        'details',
        'created_at',
        'updated_at'
    ];
}
