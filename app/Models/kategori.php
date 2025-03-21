<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'id',
        'icon',
        'kategori',
    ];

    public function fasilitas()
    {
        return $this->hasMany(Fasilitas::class, 'id_kategori', 'id');
    }
    
}
