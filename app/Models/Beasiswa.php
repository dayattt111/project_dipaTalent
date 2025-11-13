<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_beasiswa',
        'deskripsi',
        'kuota',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    // Relasi ke Pendaftaran
    public function pendaftarans()
    {
        return $this->hasMany(PendaftaranBeasiswa::class);
    }

    // Relasi ke laporan
    public function laporanBeasiswa()
    {
        return $this->hasOne(LaporanBeasiswa::class);
    }
}
