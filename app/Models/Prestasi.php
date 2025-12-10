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
        'catatan_admin',
        'deskripsi',
        'tanggal_pencapaian',
        'penyelenggara',
        'sertifikat',
    ];

    /**
     * Calculate poin prestasi otomatis berdasarkan tingkat
     * Lokal (Kampus/Kabupaten) = 1
     * Nasional (Provinsi/Nasional) = 2
     * Internasional = 4
     */
    public function getPoinAttribute()
    {
        $tingkatPoin = [
            'kampus' => 1,
            'kabupaten' => 1,
            'provinsi' => 2,
            'nasional' => 2,
            'internasional' => 4,
        ];

        return $tingkatPoin[strtolower($this->tingkat)] ?? 0;
    }

    /**
     * Scope untuk filter prestasi akademik
     */
    public function scopeAkademik($query)
    {
        return $query->where('jenis', 'akademik');
    }

    /**
     * Scope untuk filter prestasi non-akademik
     */
    public function scopeNonAkademik($query)
    {
        return $query->where('jenis', 'non-akademik');
    }

    /**
     * Scope untuk filter prestasi valid
     */
    public function scopeValid($query)
    {
        return $query->where('status', 'valid');
    }

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
