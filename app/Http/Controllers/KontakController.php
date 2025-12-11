<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PesanPengunjung;

class KontakController extends Controller
{
    /**
     * Proses kirim pesan dari form kontak di website.
     */
    public function kirim(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email'        => 'nullable|email|max:255',
            'no_telepon'   => 'nullable|string|max:30',
            'subjek'       => 'nullable|string|max:255',
            'isi_pesan'    => 'required|string',
        ]);

        $data['sumber_halaman'] = $request->input('sumber_halaman', 'landing_page');
        $data['sudah_dibaca']   = false;

        PesanPengunjung::create($data);

        return back()->with('success', 'Terima kasih, pesan Anda sudah kami terima.');
    }
}
