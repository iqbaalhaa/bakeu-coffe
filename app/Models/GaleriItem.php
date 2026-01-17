<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriItem extends Model
{
    protected $table = 'galeri_items';

    protected $fillable = [
        'galeri_album_id',
        'tipe',
        'judul',
        'path_file',
        'url_video',
        'urutan_tampil',
        'status_aktif',
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
    ];

    public function album()
    {
        return $this->belongsTo(GaleriAlbum::class, 'galeri_album_id');
    }
}

