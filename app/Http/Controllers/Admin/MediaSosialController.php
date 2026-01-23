<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MediaSosial;
use Illuminate\Support\Facades\Log;

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
        Log::info('MediaSosial Store Attempt', $request->all());

        try {
            $data = $request->validate([
                'nama_platform'  => 'required|string|max:100',
                'nama_tampilan'  => 'nullable|string|max:100',
                'url'            => 'required|url|max:2048',
                'ikon_css'       => 'nullable|string|max:100',
                'urutan_tampil'  => 'nullable|integer|min:1',
            ]);

            $data['status_aktif'] = $request->has('status_aktif');

            Log::info('MediaSosial Validation Passed', $data);

            MediaSosial::create($data);

            Log::info('MediaSosial Created Successfully');

            return redirect()
                ->route('admin.media-sosial.index')
                ->with('success', 'Media sosial berhasil ditambahkan.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('MediaSosial Validation Error', $e->errors());
            throw $e;
        } catch (\Exception $e) {
            Log::error('MediaSosial Store Error: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
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
        try {
            $data = $request->validate([
                'nama_platform'  => 'required|string|max:100',
                'nama_tampilan'  => 'nullable|string|max:100',
                'url'            => 'required|url|max:2048',
                'ikon_css'       => 'nullable|string|max:100',
                'urutan_tampil'  => 'nullable|integer|min:1',
            ]);

            $data['status_aktif'] = $request->has('status_aktif');

            $media_sosial->update($data);

            return redirect()
                ->route('admin.media-sosial.index')
                ->with('success', 'Media sosial berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('MediaSosial Update Error: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
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
