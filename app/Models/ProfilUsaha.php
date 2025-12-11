<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilUsaha extends Model
{
    protected $table = 'profil_usaha';

    protected $fillable = [
        'nama_usaha',
        'slogan',
        'judul_hero',
        'subjudul_hero',
        'tahun_berdiri',
        'sejarah',
        'visi',
        'misi',
        'arah_bisnis',
        'alamat_lengkap',
        'kota',
        'tautan_google_maps',
        'no_telepon',
        'no_whatsapp',
        'email',
        'informasi_legal',
        'jam_buka_hari_kerja',
        'jam_buka_akhir_pekan',
        'teks_tombol_lihat_produk',
        'tautan_tombol_lihat_produk',
        'teks_tombol_whatsapp',
        'path_logo',
        'path_gambar_hero',
    ];
}
