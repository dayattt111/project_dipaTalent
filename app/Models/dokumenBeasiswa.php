<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenBeasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'pendaftaran_id',
        'jenis_dokumen',
        'path_file',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(PendaftaranBeasiswa::class, 'pendaftaran_id');
    }
}
