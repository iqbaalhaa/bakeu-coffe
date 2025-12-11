<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaSosial extends Model
{
    protected $table = 'media_sosial';

    protected $fillable = [
        'nama_platform',
        'nama_tampilan',
        'url',
        'ikon_css',
        'urutan_tampil',
        'status_aktif',
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
    ];
}
