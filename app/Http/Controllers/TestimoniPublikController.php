<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Testimoni;

class TestimoniPublikController extends Controller
{
    public function store(Request $request, Produk $produk)
    {
        $data = $request->validate([
            'nama_klien'      => 'required|string|max:255',
            'profesi'         => 'nullable|string|max:255',
            'pesan_testimoni' => 'required|string',
            'rating'          => 'nullable|integer|min:1|max:5',
        ]);

        $data['produk_id'] = $produk->id;
        $data['rating'] = isset($data['rating']) ? (int)$data['rating'] : null;
        $data['status_aktif'] = false;
        $data['urutan_tampil'] = null;
        $data['path_foto'] = null;

        Testimoni::create($data);

        return back()->with('success_testimoni', 'Terima kasih, testimoni Anda sudah terkirim dan akan ditinjau admin.');
    }
}

