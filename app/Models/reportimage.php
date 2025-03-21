<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportImage extends Model
{
    use HasFactory;
    protected $table = 'reportimages';
    protected $fillable = [
        'id_report',
        'username', 
        'room_number',
        'image',
        'created_at',
        'updated_at',
    ];

    public function Report()
    {
        return $this->belongsTo(Report::class, 'id_report', 'id');
    }
}
