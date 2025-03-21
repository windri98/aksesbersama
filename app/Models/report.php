<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $table = "reports";
    protected $fillable = [
        'id',
        'username',
        'room_number',
        'kategori',
        'keterangan',
        'status',
    ];
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'username', 'username');
    // }
    // Relasi ke model ReportImage (hasMany)

    // Relasi ke model ReportImage (hasMany)
    public function reportimages()
    {
        return $this->hasMany(ReportImage::class, 'id_report', 'id');
    }
}
