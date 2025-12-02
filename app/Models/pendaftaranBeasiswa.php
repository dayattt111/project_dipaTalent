<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranBeasiswa extends Model
{
    use HasFactory;

    protected $table = 'pendaftarans';

    protected $fillable = [
        'user_id',
        'beasiswa_id',
        'status',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class, 'beasiswa_id');
    }

    public function dokumen()
    {
        return $this->hasMany(DokumenBeasiswa::class, 'pendaftaran_id');
    }
}
