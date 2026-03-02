<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Log;

class ProdukController extends Controller
{
    /**
     * Tampilkan daftar produk.
     */
    public function index()
    {
        $daftarProduk = Produk::orderBy('urutan_tampil')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.produk.index', compact('daftarProduk'));
    }

    /**
     * Tampilkan form tambah produk.
     */
    public function create()
    {
        $produk = new Produk();

        return view('admin.produk.create', compact('produk'));
    }

    /**
     * Simpan produk baru.
     */
    public function store(Request $request)
    {
        $hasFile = $request->hasFile('gambar');
        if ($hasFile) {
            $f = $request->file('gambar');
            try {
                Log::info('Produk store pre-validate', [
                    'has_file' => true,
                    'file_name' => $f->getClientOriginalName(),
                    'file_size' => $f->getSize(),
                    'client_mime' => $f->getClientMimeType(),
                    'valid' => $f->isValid(),
                    'tmp' => $f->getPathname(),
                ]);
            } catch (\Throwable $e) {
                Log::warning('Produk store pre-validate inspect failed', ['error' => $e->getMessage()]);
            }
        } else {
            Log::info('Produk store pre-validate', [
                'has_file' => false,
                'content_length' => $request->headers->get('content-length'),
                'post_max_size' => ini_get('post_max_size'),
                'upload_max_filesize' => ini_get('upload_max_filesize'),
            ]);
        }
        $data = $request->validate([
            'nama_produk'        => 'required|string|max:255',
            'kategori'           => 'nullable|string|max:100',
            'harga'              => 'required|numeric|min:0',
            'deskripsi_singkat'  => 'nullable|string',
            'deskripsi_lengkap'  => 'nullable|string',
            'status_aktif'       => 'nullable|boolean',
            'ditandai_favorit'   => 'nullable|boolean',
            'urutan_tampil'      => 'nullable|integer|min:1',
            'gambar'             => 'nullable|file|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        // Normalisasi checkbox ke boolean
        $data['status_aktif']     = $request->boolean('status_aktif');
        $data['ditandai_favorit'] = $request->boolean('ditandai_favorit');

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = $file->hashName();
            $dir = public_path('assets/produk');
            Log::info('Produk store upload init', [
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
                Log::info('Produk store mkdir executed', [
                    'dir_created' => is_dir($dir),
                    'dir_writable' => is_writable($dir),
                ]);
            }
            try {
                $file->move($dir, $filename);
                Log::info('Produk store file moved', [
                    'target' => $dir . DIRECTORY_SEPARATOR . $filename,
                    'exists' => file_exists($dir . DIRECTORY_SEPARATOR . $filename),
                ]);
            } catch (\Throwable $e) {
                Log::error('Produk store move failed', ['error' => $e->getMessage(), 'tmp' => $file->getPathname()]);
                $target = $dir . DIRECTORY_SEPARATOR . $filename;
                $copied = @copy($file->getPathname(), $target);
                Log::info('Produk store fallback copy', [
                    'target' => $target,
                    'copied' => $copied,
                    'exists' => file_exists($target),
                ]);
                if (!$copied || !file_exists($target)) {
                    return back()->withErrors(['gambar' => 'Gagal menyimpan gambar (fallback): ' . $e->getMessage()])->withInput();
                }
            }
            $data['path_gambar'] = 'produk/' . $filename;
        }
        else {
            Log::info('Produk store no file provided');
        }

        Produk::create($data);

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk baru berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit produk.
     */
    public function edit(Produk $produk)
    {
        return view('admin.produk.edit', compact('produk'));
    }

    /**
     * Update data produk.
     */
    public function update(Request $request, Produk $produk)
    {
        $hasFile = $request->hasFile('gambar');
        if ($hasFile) {
            $f = $request->file('gambar');
            try {
                Log::info('Produk update pre-validate', [
                    'has_file' => true,
                    'file_name' => $f->getClientOriginalName(),
                    'file_size' => $f->getSize(),
                    'client_mime' => $f->getClientMimeType(),
                    'valid' => $f->isValid(),
                    'tmp' => $f->getPathname(),
                ]);
            } catch (\Throwable $e) {
                Log::warning('Produk update pre-validate inspect failed', ['error' => $e->getMessage()]);
            }
        } else {
            Log::info('Produk update pre-validate', [
                'has_file' => false,
                'content_length' => $request->headers->get('content-length'),
                'post_max_size' => ini_get('post_max_size'),
                'upload_max_filesize' => ini_get('upload_max_filesize'),
            ]);
        }
        $data = $request->validate([
            'nama_produk'        => 'required|string|max:255',
            'kategori'           => 'nullable|string|max:100',
            'harga'              => 'required|numeric|min:0',
            'deskripsi_singkat'  => 'nullable|string',
            'deskripsi_lengkap'  => 'nullable|string',
            'status_aktif'       => 'nullable|boolean',
            'ditandai_favorit'   => 'nullable|boolean',
            'urutan_tampil'      => 'nullable|integer|min:1',
            'gambar'             => 'nullable|file|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $data['status_aktif']     = $request->boolean('status_aktif');
        $data['ditandai_favorit'] = $request->boolean('ditandai_favorit');

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            if ($produk->path_gambar && file_exists(public_path('assets/' . $produk->path_gambar))) {
                unlink(public_path('assets/' . $produk->path_gambar));
            }
            
            $file = $request->file('gambar');
            $filename = $file->hashName();
            $dir = public_path('assets/produk');
            Log::info('Produk update upload init', [
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
                Log::info('Produk update mkdir executed', [
                    'dir_created' => is_dir($dir),
                    'dir_writable' => is_writable($dir),
                ]);
            }
            try {
                $file->move($dir, $filename);
                Log::info('Produk update file moved', [
                    'target' => $dir . DIRECTORY_SEPARATOR . $filename,
                    'exists' => file_exists($dir . DIRECTORY_SEPARATOR . $filename),
                ]);
            } catch (\Throwable $e) {
                Log::error('Produk update move failed', ['error' => $e->getMessage(), 'tmp' => $file->getPathname()]);
                $target = $dir . DIRECTORY_SEPARATOR . $filename;
                $copied = @copy($file->getPathname(), $target);
                Log::info('Produk update fallback copy', [
                    'target' => $target,
                    'copied' => $copied,
                    'exists' => file_exists($target),
                ]);
                if (!$copied || !file_exists($target)) {
                    return back()->withErrors(['gambar' => 'Gagal menyimpan gambar (fallback): ' . $e->getMessage()])->withInput();
                }
            }
            $data['path_gambar'] = 'produk/' . $filename;
        }

        $produk->fill($data);
        $produk->save();

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Data produk berhasil diperbarui.');
    }

    /**
     * Hapus produk.
     */
    public function destroy(Produk $produk)
    {
        if ($produk->path_gambar && file_exists(public_path('assets/' . $produk->path_gambar))) {
            unlink(public_path('assets/' . $produk->path_gambar));
        }

        $produk->delete();

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
