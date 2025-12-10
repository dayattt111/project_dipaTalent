<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftarans'; // pastikan sama dengan nama tabel di database
    protected $fillable = [
        'user_id',
        'beasiswa_id',
        'nim',
        'ipk',
        'prestasi',
        'organisasi',
        'keterampilan',
        'alasan',
        'transkrip',
        'foto',
        'foto_formal',
        'status',
        'catatan_admin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class);
    }
    // public function dokumen()
    // {
    //     return $this->hasMany(DokumenBeasiswa::class);
    // }
}
