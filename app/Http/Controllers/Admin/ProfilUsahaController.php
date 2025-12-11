<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfilUsaha;
use Illuminate\Support\Facades\Storage;

class ProfilUsahaController extends Controller
{
    /**
     * Tampilkan form edit profil usaha.
     */
    public function edit()
    {
        // Ambil data profil usaha pertama, atau buat objek baru dengan nilai default
        $profil = ProfilUsaha::first() ?? new ProfilUsaha([
            'nama_usaha'                  => 'Bakeu Coffee',
            'teks_tombol_lihat_produk'    => 'Lihat Produk',
            'teks_tombol_whatsapp'        => 'Pesan via WhatsApp',
        ]);

        return view('admin.profil-usaha.edit', compact('profil'));
    }

    /**
     * Proses simpan / update profil usaha.
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama_usaha'                   => 'required|string|max:255',
            'slogan'                       => 'nullable|string|max:255',
            'judul_hero'                   => 'nullable|string|max:255',
            'subjudul_hero'                => 'nullable|string|max:255',
            'tahun_berdiri'                => 'nullable|digits:4',
            'sejarah'                      => 'nullable|string',
            'visi'                         => 'nullable|string',
            'misi'                         => 'nullable|string',
            'arah_bisnis'                  => 'nullable|string',
            'alamat_lengkap'              => 'nullable|string',
            'kota'                         => 'nullable|string|max:100',
            'tautan_google_maps'          => 'nullable|url',
            'no_telepon'                  => 'nullable|string|max:30',
            'no_whatsapp'                 => 'nullable|string|max:30',
            'email'                        => 'nullable|email',
            'informasi_legal'             => 'nullable|string|max:255',
            'jam_buka_hari_kerja'         => 'nullable|string|max:255',
            'jam_buka_akhir_pekan'        => 'nullable|string|max:255',
            'teks_tombol_lihat_produk'    => 'nullable|string|max:100',
            'tautan_tombol_lihat_produk'  => 'nullable|string|max:255',
            'teks_tombol_whatsapp'        => 'nullable|string|max:100',
            'logo'                         => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'gambar_hero'                  => 'nullable|image|mimes:jpg,jpeg,png,svg|max:4096',
        ]);

        $profil = ProfilUsaha::first() ?? new ProfilUsaha();

        // Ambil semua input kecuali file
        $data = $request->except(['logo', 'gambar_hero']);

        // Upload logo jika ada
        if ($request->hasFile('logo')) {
            if ($profil->path_logo) {
                Storage::disk('public')->delete($profil->path_logo);
            }
            $data['path_logo'] = $request->file('logo')->store('profil_usaha/logo', 'public');
        }

        // Upload gambar hero jika ada
        if ($request->hasFile('gambar_hero')) {
            if ($profil->path_gambar_hero) {
                Storage::disk('public')->delete($profil->path_gambar_hero);
            }
            $data['path_gambar_hero'] = $request->file('gambar_hero')->store('profil_usaha/hero', 'public');
        }

        $profil->fill($data);
        $profil->save();

        return redirect()
            ->route('admin.profil_usaha.edit')
            ->with('success', 'Profil usaha berhasil disimpan.');
    }
}
