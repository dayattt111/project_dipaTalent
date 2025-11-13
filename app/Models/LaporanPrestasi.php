<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPrestasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'total_prestasi_valid',
        'total_mahasiswa',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
