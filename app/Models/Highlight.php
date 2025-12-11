<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Highlight extends Model
{
    protected $table = 'highlights';

    protected $fillable = [
        'judul',
        'deskripsi',
        'ikon_css',
        'kategori',
        'warna_tema',
        'urutan_tampil',
        'status_aktif',
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
        'urutan_tampil' => 'integer',
    ];
}
