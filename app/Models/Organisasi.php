<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    protected $fillable = [
        'user_id',
        'nama_organisasi',
        'jabatan',
        'periode',
        'deskripsi',
        'bukti_file',
        'status',
        'catatan_admin',
        'poin',
    ];

    protected $casts = [
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
