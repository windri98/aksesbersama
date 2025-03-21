<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bookingfasilitas extends Model
{
    use HasFactory;
    protected $table = 'bookingfasilitas'; 
    protected $primaryKey = 'id_booking'; 
    public $incrementing = true; 
    protected $keyType = 'int'; 

    protected $fillable = [
        'id_booking',
        'id_fasilitas',
        'username',
        'date',
        'start_time',
        'end_time',
        'status',
        'alasan'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class, 'id_fasilitas', 'id_fasilitas');
    }
}


