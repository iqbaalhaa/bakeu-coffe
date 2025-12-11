<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'nama_produk',
        'kategori',
        'harga',
        'deskripsi_singkat',
        'deskripsi_lengkap',
        'path_gambar',
        'status_aktif',
        'ditandai_favorit',
        'urutan_tampil',
    ];

    protected $casts = [
        'status_aktif'     => 'boolean',
        'ditandai_favorit' => 'boolean',
        'harga'            => 'float',
    ];
}
