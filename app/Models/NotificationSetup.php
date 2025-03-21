<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationSetup extends Model
{
    protected $fillable = [
        'token',
        'website',
        'device',
    ];
    
    protected $table = 'notification_setups';
    use HasFactory;
}
