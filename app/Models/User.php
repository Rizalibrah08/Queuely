<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $attributes = [
        'role' => 'customer',
    ];

    public function umkm()
    {
        return $this->hasOne(UMKM::class);
    }

    public function isUmkm()
    {
        return $this->umkm()->exists() && $this->umkm->status === 'approved';
    }

    public function hasPendingUmkm()
    {
        return $this->umkm()->where('status', 'pending')->exists();
    }
}