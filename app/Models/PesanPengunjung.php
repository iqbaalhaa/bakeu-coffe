<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesanPengunjung extends Model
{
    protected $table = 'pesan_pengunjung';

    protected $fillable = [
        'nama_lengkap',
        'email',
        'no_telepon',
        'subjek',
        'isi_pesan',
        'sumber_halaman',
        'sudah_dibaca',
    ];

    protected $casts = [
        'sudah_dibaca' => 'boolean',
    ];
}
