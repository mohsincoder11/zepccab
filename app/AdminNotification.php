<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminNotification extends Model
{
    protected $table = 'admin_notification';
    protected $fillable = [
        'title',
        'message',
        'sent_type',
        'created_at',
        'updated_at'
    ];
}
