<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Testimoni;
use Illuminate\Support\Facades\Log;

class TestimoniPublikController extends Controller
{
    public function store(Request $request, Produk $produk)
    {
        $hasFile = $request->hasFile('path_foto');
        if ($hasFile) {
            $f = $request->file('path_foto');
            try {
                Log::info('Testimoni publik pre-validate', [
                    'has_file' => true,
                    'file_name' => $f->getClientOriginalName(),
                    'file_size' => $f->getSize(),
                    'client_mime' => $f->getClientMimeType(),
                    'valid' => $f->isValid(),
                    'tmp' => $f->getPathname(),
                ]);
            } catch (\Throwable $e) {
                Log::warning('Testimoni publik pre-validate inspect failed', ['error' => $e->getMessage()]);
            }
        } else {
            Log::info('Testimoni publik pre-validate', ['has_file' => false]);
        }
        $data = $request->validate([
            'nama_klien'      => 'required|string|max:255',
            'profesi'         => 'nullable|string|max:255',
            'pesan_testimoni' => 'required|string',
            'rating'          => 'nullable|integer|min:1|max:5',
            'path_foto'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $data['produk_id'] = $produk->id;
        $data['rating'] = isset($data['rating']) ? (int)$data['rating'] : null;
        $data['status_aktif'] = false;
        $data['urutan_tampil'] = null;
        
        if ($request->hasFile('path_foto')) {
            $file = $request->file('path_foto');
            $filename = $file->hashName();
            $dir = public_path('assets/testimoni');
            Log::info('Testimoni publik upload init', [
                'dir' => $dir,
                'file_valid' => $file->isValid(),
                'tmp' => $file->getPathname(),
                'orig' => $file->getClientOriginalName(),
                'hash' => $filename,
                'dir_exists' => file_exists($dir),
                'is_dir' => is_dir($dir),
            ]);
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
                Log::info('Testimoni publik mkdir executed', [
                    'dir_created' => is_dir($dir),
                    'dir_writable' => is_writable($dir),
                ]);
            }
            try {
                $file->move($dir, $filename);
                Log::info('Testimoni publik file moved', [
                    'target' => $dir . DIRECTORY_SEPARATOR . $filename,
                    'exists' => file_exists($dir . DIRECTORY_SEPARATOR . $filename),
                ]);
            } catch (\Throwable $e) {
                Log::error('Testimoni publik move failed', ['error' => $e->getMessage(), 'tmp' => $file->getPathname()]);
                $target = $dir . DIRECTORY_SEPARATOR . $filename;
                $copied = @copy($file->getPathname(), $target);
                Log::info('Testimoni publik fallback copy', [
                    'target' => $target,
                    'copied' => $copied,
                    'exists' => file_exists($target),
                ]);
                if (!$copied || !file_exists($target)) {
                    return back()->withErrors(['path_foto' => 'Gagal menyimpan foto (fallback): ' . $e->getMessage()]);
                }
            }
            $data['path_foto'] = 'testimoni/' . $filename;
        } else {
            $data['path_foto'] = null;
            Log::info('Testimoni publik no file provided');
        }

        Testimoni::create($data);

        return back()->with('success_testimoni', 'Terima kasih, testimoni Anda sudah terkirim dan akan ditinjau admin.');
    }
}
