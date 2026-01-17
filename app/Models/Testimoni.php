<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    protected $table = 'testimoni';

    protected $fillable = [
        'produk_id',
        'nama_klien',
        'profesi',
        'pesan_testimoni',
        'rating',
        'path_foto',
        'urutan_tampil',
        'status_aktif',
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
        'rating'       => 'integer',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
