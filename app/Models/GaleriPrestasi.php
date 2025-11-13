<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriPrestasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'prestasi_id',
        'gambar',
        'deskripsi',
    ];

    public function prestasi()
    {
        return $this->belongsTo(Prestasi::class);
    }
}
