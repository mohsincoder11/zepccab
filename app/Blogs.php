<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    protected $table = 'blogs';
    protected $fillable = [
        'title',
        'description',
        'date',
        'image',
        'created_at',
        'updated_at'
    ];
}
