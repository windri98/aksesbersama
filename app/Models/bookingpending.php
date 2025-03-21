<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bookingpending extends Model
{
    use HasFactory;
  
    protected $table = 'bookingpendings';
    protected $primaryKey = 'id_booking'; 
    public $incrementing = true; 
    protected $keyType = 'int'; 
    protected $fillable = [
        'id_booking',
        'id_fasilitas',
        'username',
        'date',
        'requested_start',
        'requested_end',
        'original_date',
        'original_start',
        'original_end',
        'status',
        'alasan',
    ];
    
    // Relasi dengan tabel bookingfasilitas
    // public function bookingFasilitas()
    // {
    //     return $this->belongsTo(BookingFasilitas::class, 'id_booking', 'id_booking');
    // }

}