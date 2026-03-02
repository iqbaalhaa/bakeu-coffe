<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GaleriAlbum;
use App\Models\GaleriItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GaleriAlbumController extends Controller
{
    public function index()
    {
        $daftarAlbum = GaleriAlbum::orderByRaw('COALESCE(urutan_tampil, 9999) ASC')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.galeri.index', compact('daftarAlbum'));
    }

    public function create()
    {
        $album = new GaleriAlbum();

        return view('admin.galeri.create', compact('album'));
    }

    public function store(Request $request)
    {
        Log::info('Galeri store pre-validate', [
            'has_file' => $request->hasFile('cover'),
            'file_name' => $request->file('cover')?->getClientOriginalName(),
            'file_size' => $request->file('cover')?->getSize(),
            'file_mime' => $request->file('cover')?->getMimeType(),
        ]);
        $data = $request->validate([
            'judul'          => 'required|string|max:255',
            'deskripsi'      => 'nullable|string',
            'urutan_tampil'  => 'nullable|integer|min:1',
            'status_aktif'   => 'nullable|boolean',
            'cover'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $data['status_aktif'] = $request->boolean('status_aktif');

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = $file->hashName();
            $dir = public_path('assets/galeri/cover');
            Log::info('Galeri store upload init', [
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
                Log::info('Galeri store mkdir executed', [
                    'dir_created' => is_dir($dir),
                    'dir_writable' => is_writable($dir),
                ]);
            }
            try {
                $file->move($dir, $filename);
                Log::info('Galeri store file moved', [
                    'target' => $dir . DIRECTORY_SEPARATOR . $filename,
                    'exists' => file_exists($dir . DIRECTORY_SEPARATOR . $filename),
                ]);
            } catch (\Throwable $e) {
                Log::error('Galeri store move failed', ['error' => $e->getMessage(), 'tmp' => $file->getPathname()]);
                $target = $dir . DIRECTORY_SEPARATOR . $filename;
                $copied = @copy($file->getPathname(), $target);
                Log::info('Galeri store fallback copy', [
                    'target' => $target,
                    'copied' => $copied,
                    'exists' => file_exists($target),
                ]);
                if (!$copied || !file_exists($target)) {
                    return back()->withErrors(['cover' => 'Gagal menyimpan cover (fallback): ' . $e->getMessage()])->withInput();
                }
            }
            $data['cover_path'] = 'galeri/cover/' . $filename;
        }
        else {
            Log::info('Galeri store no file provided');
        }

        GaleriAlbum::create($data);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Album galeri berhasil ditambahkan.');
    }

    public function edit(GaleriAlbum $galeri)
    {
        $album = $galeri->load(['items' => function ($q) {
            $q->orderByRaw('COALESCE(urutan_tampil, 9999) ASC')->orderByDesc('created_at');
        }]);

        return view('admin.galeri.edit', compact('album'));
    }

    public function update(Request $request, GaleriAlbum $galeri)
    {
        Log::info('Galeri update pre-validate', [
            'has_file' => $request->hasFile('cover'),
            'file_name' => $request->file('cover')?->getClientOriginalName(),
            'file_size' => $request->file('cover')?->getSize(),
            'file_mime' => $request->file('cover')?->getMimeType(),
        ]);
        $data = $request->validate([
            'judul'          => 'required|string|max:255',
            'deskripsi'      => 'nullable|string',
            'urutan_tampil'  => 'nullable|integer|min:1',
            'status_aktif'   => 'nullable|boolean',
            'cover'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $data['status_aktif'] = $request->boolean('status_aktif');

        if ($request->hasFile('cover')) {
            if ($galeri->cover_path && file_exists(public_path('assets/' . $galeri->cover_path))) {
                unlink(public_path('assets/' . $galeri->cover_path));
            }

            $file = $request->file('cover');
            $filename = $file->hashName();
            $dir = public_path('assets/galeri/cover');
            Log::info('Galeri update upload init', [
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
                Log::info('Galeri update mkdir executed', [
                    'dir_created' => is_dir($dir),
                    'dir_writable' => is_writable($dir),
                ]);
            }
            try {
                $file->move($dir, $filename);
                Log::info('Galeri update file moved', [
                    'target' => $dir . DIRECTORY_SEPARATOR . $filename,
                    'exists' => file_exists($dir . DIRECTORY_SEPARATOR . $filename),
                ]);
            } catch (\Throwable $e) {
                Log::error('Galeri update move failed', ['error' => $e->getMessage(), 'tmp' => $file->getPathname()]);
                $target = $dir . DIRECTORY_SEPARATOR . $filename;
                $copied = @copy($file->getPathname(), $target);
                Log::info('Galeri update fallback copy', [
                    'target' => $target,
                    'copied' => $copied,
                    'exists' => file_exists($target),
                ]);
                if (!$copied || !file_exists($target)) {
                    return back()->withErrors(['cover' => 'Gagal menyimpan cover (fallback): ' . $e->getMessage()])->withInput();
                }
            }
            $data['cover_path'] = 'galeri/cover/' . $filename;
        }

        $galeri->update($data);

        return redirect()
            ->route('admin.galeri.edit', $galeri)
            ->with('success', 'Album galeri berhasil diperbarui.');
    }

    public function destroy(GaleriAlbum $galeri)
    {
        if ($galeri->cover_path && file_exists(public_path('assets/' . $galeri->cover_path))) {
            unlink(public_path('assets/' . $galeri->cover_path));
        }

        $galeri->delete();

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Album galeri berhasil dihapus.');
    }

    public function tambahItem(Request $request, GaleriAlbum $galeri)
    {
        $data = $request->validate([
            'tipe'           => 'required|in:image,video',
            'judul'          => 'nullable|string|max:255',
            'urutan_tampil'  => 'nullable|integer|min:1',
            'file'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'url_video'      => 'nullable|string|max:255',
        ]);

        if ($data['tipe'] === 'image') {
            if (!$request->hasFile('file')) {
                return back()->with('error', 'File gambar wajib diisi untuk tipe image.');
            }

            $path = $request->file('file')->store('galeri/items', 'public');

            GaleriItem::create([
                'galeri_album_id' => $galeri->id,
                'tipe'            => 'image',
                'judul'           => $data['judul'] ?? null,
                'path_file'       => $path,
                'urutan_tampil'   => $data['urutan_tampil'] ?? null,
                'status_aktif'    => true,
            ]);
        } else {
            if (empty($data['url_video'])) {
                return back()->with('error', 'URL video wajib diisi untuk tipe video.');
            }

            GaleriItem::create([
                'galeri_album_id' => $galeri->id,
                'tipe'            => 'video',
                'judul'           => $data['judul'] ?? null,
                'url_video'       => $data['url_video'],
                'urutan_tampil'   => $data['urutan_tampil'] ?? null,
                'status_aktif'    => true,
            ]);
        }

        return redirect()
            ->route('admin.galeri.edit', $galeri)
            ->with('success', 'Item galeri berhasil ditambahkan.');
    }

    public function hapusItem(GaleriAlbum $galeri, GaleriItem $item)
    {
        if ($item->galeri_album_id !== $galeri->id) {
            return redirect()
                ->route('admin.galeri.edit', $galeri)
                ->with('error', 'Item tidak valid untuk album ini.');
        }

        if ($item->path_file) {
            Storage::disk('public')->delete($item->path_file);
        }

        $item->delete();

        return redirect()
            ->route('admin.galeri.edit', $galeri)
            ->with('success', 'Item galeri berhasil dihapus.');
    }
}
