<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfilUsaha;
use Illuminate\Support\Facades\Log;

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
            if ($profil->path_logo && file_exists(public_path('assets/' . $profil->path_logo))) {
                unlink(public_path('assets/' . $profil->path_logo));
            }
            $file = $request->file('logo');
            $filename = $file->hashName();
            $logoDir = public_path('assets/profil_usaha/logo');
            Log::info('Profil logo upload init', [
                'dir' => $logoDir,
                'file_valid' => $file->isValid(),
                'tmp' => $file->getPathname(),
                'orig' => $file->getClientOriginalName(),
                'hash' => $filename,
                'dir_exists' => file_exists($logoDir),
                'is_dir' => is_dir($logoDir),
            ]);
            if (!is_dir($logoDir)) {
                mkdir($logoDir, 0755, true);
                Log::info('Profil logo mkdir executed', [
                    'dir_created' => is_dir($logoDir),
                    'dir_writable' => is_writable($logoDir),
                ]);
            }
            try {
                $file->move($logoDir, $filename);
                Log::info('Profil logo file moved', [
                    'target' => $logoDir . DIRECTORY_SEPARATOR . $filename,
                    'exists' => file_exists($logoDir . DIRECTORY_SEPARATOR . $filename),
                ]);
            } catch (\Throwable $e) {
                Log::error('Profil logo move failed', ['error' => $e->getMessage()]);
                return back()->withErrors(['logo' => 'Gagal menyimpan logo: ' . $e->getMessage()])->withInput();
            }
            $data['path_logo'] = 'profil_usaha/logo/' . $filename;
        }

        // Upload gambar hero jika ada
        if ($request->hasFile('gambar_hero')) {
            if ($profil->path_gambar_hero && file_exists(public_path('assets/' . $profil->path_gambar_hero))) {
                unlink(public_path('assets/' . $profil->path_gambar_hero));
            }
            $file = $request->file('gambar_hero');
            $filename = $file->hashName();
            $heroDir = public_path('assets/profil_usaha/hero');
            Log::info('Profil hero upload init', [
                'dir' => $heroDir,
                'file_valid' => $file->isValid(),
                'tmp' => $file->getPathname(),
                'orig' => $file->getClientOriginalName(),
                'hash' => $filename,
                'dir_exists' => file_exists($heroDir),
                'is_dir' => is_dir($heroDir),
            ]);
            if (!is_dir($heroDir)) {
                mkdir($heroDir, 0755, true);
                Log::info('Profil hero mkdir executed', [
                    'dir_created' => is_dir($heroDir),
                    'dir_writable' => is_writable($heroDir),
                ]);
            }
            try {
                $file->move($heroDir, $filename);
                Log::info('Profil hero file moved', [
                    'target' => $heroDir . DIRECTORY_SEPARATOR . $filename,
                    'exists' => file_exists($heroDir . DIRECTORY_SEPARATOR . $filename),
                ]);
            } catch (\Throwable $e) {
                Log::error('Profil hero move failed', ['error' => $e->getMessage()]);
                return back()->withErrors(['gambar_hero' => 'Gagal menyimpan gambar hero: ' . $e->getMessage()])->withInput();
            }
            $data['path_gambar_hero'] = 'profil_usaha/hero/' . $filename;
        }

        $profil->fill($data);
        $profil->save();

        return redirect()
            ->route('admin.profil_usaha.edit')
            ->with('success', 'Profil usaha berhasil disimpan.');
    }
}
