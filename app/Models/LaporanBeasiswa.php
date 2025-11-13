<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanBeasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'beasiswa_id',
        'total_pendaftar',
        'total_diterima',
        'total_ditolak',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class);
    }
}
