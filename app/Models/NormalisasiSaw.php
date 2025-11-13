<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NormalisasiSaw extends Model
{
    use HasFactory;

    protected $table = 'normalisasi_saw';

    protected $fillable = [
        'prestasi_id',
        'kriteria_id',
        'nilai_normalisasi',
    ];

    public function prestasi()
    {
        return $this->belongsTo(Prestasi::class);
    }

    public function kriteria()
    {
        return $this->belongsTo(BobotKriteria::class, 'kriteria_id');
    }
}
