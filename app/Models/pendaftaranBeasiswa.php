<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranBeasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'beasiswa_id',
        'status',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class);
    }

    public function dokumen()
    {
        return $this->hasMany(DokumenBeasiswa::class, 'pendaftaran_id');
    }
}
