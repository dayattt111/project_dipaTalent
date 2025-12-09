<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'nim',
        'ipk',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Check if user is admin.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Get the prestasi for the user.
     */
    public function prestasi()
    {
        return $this->hasMany(Prestasi::class);
    }

    /**
     * Get the leaderboard for the user.
     */
    public function leaderboard()
    {
        return $this->hasOne(Leaderboard::class);
    }

    /**
     * Get the pendaftaran beasiswa for the user.
     */
    public function pendaftaranBeasiswa()
    {
        return $this->hasMany(pendaftaranBeasiswa::class);
    }

    /**
     * Get the organisasi for the user.
     */
    public function organisasi()
    {
        return $this->hasMany(Organisasi::class);
    }

    /**
     * Get the sertifikasi for the user.
     */
    public function sertifikasi()
    {
        return $this->hasMany(Sertifikasi::class);
    }
}
