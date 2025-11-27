<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'skor_id',
        'ranking',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function skor()
    {
        return $this->belongsTo(SkorSaw::class, 'skor_id');
    }

    public function skorSaw()
    {
        return $this->belongsTo(SkorSaw::class, 'skor_id');
    }
}
