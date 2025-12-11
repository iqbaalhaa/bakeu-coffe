<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MediaSosial;



class MediaSosialController extends Controller
{
    public function index()
    {
        $daftarMediaSosial = MediaSosial::orderBy('urutan_tampil')
            ->orderBy('nama_platform')
            ->get();

        return view('admin.media-sosial.index', compact('daftarMediaSosial'));
    }

    /**
     * Tampilkan form tambah media sosial.
     */
    public function create()
    {
        $mediaSosial = new MediaSosial();

        return view('admin.media-sosial.create', compact('mediaSosial'));
    }

    /**
     * Simpan data media sosial baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_platform'  => 'required|string|max:100',
            'nama_tampilan'  => 'nullable|string|max:100',
            'url'            => 'required|url|max:255',
            'ikon_css'       => 'nullable|string|max:100',
            'urutan_tampil'  => 'nullable|integer|min:1',
            'status_aktif'   => 'nullable|boolean',
        ]);

        $data['status_aktif'] = $request->has('status_aktif');

        MediaSosial::create($data);

        return redirect()
            ->route('admin.media-sosial.index')
            ->with('success', 'Media sosial berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit media sosial.
     */
    public function edit(MediaSosial $media_sosial)
    {
        return view('admin.media-sosial.edit', [
            'mediaSosial' => $media_sosial,
        ]);
    }

    /**
     * Update media sosial.
     */
    public function update(Request $request, MediaSosial $media_sosial)
    {
        $data = $request->validate([
            'nama_platform'  => 'required|string|max:100',
            'nama_tampilan'  => 'nullable|string|max:100',
            'url'            => 'required|url|max:255',
            'ikon_css'       => 'nullable|string|max:100',
            'urutan_tampil'  => 'nullable|integer|min:1',
            'status_aktif'   => 'nullable|boolean',
        ]);

        $data['status_aktif'] = $request->has('status_aktif');

        $media_sosial->update($data);

        return redirect()
            ->route('admin.media-sosial.index')
            ->with('success', 'Media sosial berhasil diperbarui.');
    }

    /**
     * Hapus media sosial.
     */
    public function destroy(MediaSosial $media_sosial)
    {
        $media_sosial->delete();

        return redirect()
            ->route('admin.media-sosial.index')
            ->with('success', 'Media sosial berhasil dihapus.');
    }
}
