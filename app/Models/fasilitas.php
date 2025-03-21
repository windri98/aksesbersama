<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Fasilitas extends Model
{
    use HasFactory;

    protected $table = 'fasilitas'; // Nama tabel
    protected $primaryKey = 'id_fasilitas'; // Nama kolom primary key
    public $incrementing = true; // Jika primary key auto-increment
    protected $keyType = 'int'; // Tipe data primary key

     protected $fillable = [
        'id_fasilitas', 
        'id_kategori', 
        'unit_nomor', 
        'fasilitas', 
        'icon', 
        'foto', 
        'kapasitas', 
        'kategori',
        'maxjam'
    ];

    public function bookingFasilitas()
    {
        return $this->hasMany(BookingFasilitas::class, 'id_fasilitas', 'id_fasilitas');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }
    
    public function bookings()
    {
        return $this->hasMany(bookingfasilitas::class, 'id_fasilitas', 'id_fasilitas');
    }
    // Fungsi yang dijalankan saat model ini di-boot
    protected static function booted()
    {

    }
}
