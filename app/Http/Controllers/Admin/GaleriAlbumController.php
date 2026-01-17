<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GaleriAlbum;
use App\Models\GaleriItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $data = $request->validate([
            'judul'          => 'required|string|max:255',
            'deskripsi'      => 'nullable|string',
            'urutan_tampil'  => 'nullable|integer|min:1',
            'status_aktif'   => 'nullable|boolean',
            'cover'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $data['status_aktif'] = $request->boolean('status_aktif');

        if ($request->hasFile('cover')) {
            $data['cover_path'] = $request->file('cover')->store('galeri/cover', 'public');
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
        $data = $request->validate([
            'judul'          => 'required|string|max:255',
            'deskripsi'      => 'nullable|string',
            'urutan_tampil'  => 'nullable|integer|min:1',
            'status_aktif'   => 'nullable|boolean',
            'cover'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $data['status_aktif'] = $request->boolean('status_aktif');

        if ($request->hasFile('cover')) {
            if ($galeri->cover_path) {
                Storage::disk('public')->delete($galeri->cover_path);
            }

            $data['cover_path'] = $request->file('cover')->store('galeri/cover', 'public');
        }

        $galeri->update($data);

        return redirect()
            ->route('admin.galeri.edit', $galeri)
            ->with('success', 'Album galeri berhasil diperbarui.');
    }

    public function destroy(GaleriAlbum $galeri)
    {
        if ($galeri->cover_path) {
            Storage::disk('public')->delete($galeri->cover_path);
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

