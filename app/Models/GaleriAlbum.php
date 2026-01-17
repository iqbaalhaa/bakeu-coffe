<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriAlbum extends Model
{
    protected $table = 'galeri_albums';

    protected $fillable = [
        'judul',
        'deskripsi',
        'cover_path',
        'urutan_tampil',
        'status_aktif',
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
    ];

    public function items()
    {
        return $this->hasMany(GaleriItem::class, 'galeri_album_id');
    }
}

