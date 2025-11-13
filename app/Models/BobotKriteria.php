<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BobotKriteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kriteria',
        'bobot',
        'tipe',
    ];

    public function normalisasi()
    {
        return $this->hasMany(NormalisasiSaw::class, 'kriteria_id');
    }
}
