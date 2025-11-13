<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jenis',
        'nama_prestasi',
        'tingkat',
        'tahun',
        'file_sertifikat',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function normalisasi()
    {
        return $this->hasMany(NormalisasiSaw::class);
    }

    public function galeri()
    {
        return $this->hasOne(GaleriPrestasi::class);
    }
}
