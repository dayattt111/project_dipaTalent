<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkorSaw extends Model
{
    use HasFactory;

    protected $table = 'skor_saw';

    protected $fillable = [
        'user_id',
        'total_skor',
        'nilai_akhir',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function leaderboard()
    {
        return $this->hasOne(Leaderboard::class, 'skor_id');
    }
}
