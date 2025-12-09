<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sertifikasi extends Model
{
    protected $fillable = [
        'user_id',
        'nama_sertifikat',
        'penerbit',
        'jenis',
        'nomor_sertifikat',
        'tanggal_terbit',
        'tanggal_expired',
        'bukti_file',
        'deskripsi',
        'status',
        'catatan_admin',
        'poin',
    ];

    protected $casts = [
        'tanggal_terbit' => 'date',
        'tanggal_expired' => 'date',
        'poin' => 'decimal:2',
    ];

    // Relation
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeValid($query)
    {
        return $query->where('status', 'valid');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
