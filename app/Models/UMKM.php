<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UMKM extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'umkm';

    protected $fillable = [
        'user_id',
        'nama_umkm',
        'slug',
        'deskripsi',
        'kategori',
        'alamat',
        'kota',
        'provinsi',
        'kodepos',
        'telepon',
        'email',
        'website',
        'logo',
        'cover',
        'nama_pemilik',
        'nik_pemilik',
        'foto_ktp',
        'npwp',
        'siup',
        'tdp',
        'status',
        'alasan_penolakan',
        'approved_at',
        'shop_code'
    ];

    protected $casts = [
        'approved_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class, 'umkm_id');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'rejected');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'umkm_id');
    }
}