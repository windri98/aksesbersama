<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaintkamar extends Model
{
    use HasFactory;
    protected $fillable = [
        'username',
        'room_number',
        'keluhan',
        'keterangan',
        'image',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
}
