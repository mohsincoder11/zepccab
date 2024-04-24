<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'video_section';
    protected $fillable = [
        'id',
        'title',
        'url',
        'description',
        'created_at',
        'updated_at'
    ];
}
