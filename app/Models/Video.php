<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'umkm_id',
        'caption',
        'video_path',
    ];

    public function umkm()
    {
        return $this->belongsTo(UMKM::class);
    }
}
