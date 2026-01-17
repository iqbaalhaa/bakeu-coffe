<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimoni;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;


class TestimoniController extends Controller
{
    /**
     * Tampilkan daftar testimoni.
     */
    public function index()
    {
        $daftarTestimoni = Testimoni::with('produk')
            ->orderBy('urutan_tampil')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.testimoni.index', compact('daftarTestimoni'));
    }

    /**
     * Form tambah testimoni.
     */
    public function create()
    {
        $testimoni = new Testimoni();
        $daftarProduk = Produk::where('status_aktif', true)
            ->orderBy('nama_produk')
            ->get();

        return view('admin.testimoni.create', compact('testimoni', 'daftarProduk'));
    }

    /**
     * Simpan testimoni baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'produk_id'       => 'nullable|exists:produk,id',
            'nama_klien'      => 'required|string|max:255',
            'profesi'         => 'nullable|string|max:255',
            'pesan_testimoni' => 'required|string',
            'rating'          => 'nullable|integer|min:1|max:5',
            'urutan_tampil'   => 'nullable|integer|min:0',
            'foto'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'status_aktif'    => 'nullable|boolean',
        ]);

        $data['status_aktif'] = $request->boolean('status_aktif');
        $data['rating'] = isset($data['rating']) ? (int)$data['rating'] : null;
        $data['urutan_tampil'] = isset($data['urutan_tampil']) ? (int)$data['urutan_tampil'] : null;

        if ($request->hasFile('foto')) {
            $data['path_foto'] = $request->file('foto')->store('testimoni', 'public');
        }

        try {
            Testimoni::create($data);
        } catch (\Throwable $e) {
            return back()->withErrors(['general' => 'Gagal menyimpan testimoni: '.$e->getMessage()])->withInput();
        }

        return redirect()->route('admin.testimoni.index')
            ->with('success', 'Testimoni baru berhasil ditambahkan.');
    }

    /**
     * Form edit testimoni.
     */
    public function edit(Testimoni $testimoni)
    {
        $daftarProduk = Produk::where('status_aktif', true)
            ->orderBy('nama_produk')
            ->get();

        return view('admin.testimoni.edit', compact('testimoni', 'daftarProduk'));
    }

    /**
     * Update testimoni.
     */
    public function update(Request $request, Testimoni $testimoni)
    {
        $data = $request->validate([
            'produk_id'       => 'nullable|exists:produk,id',
            'nama_klien'      => 'required|string|max:255',
            'profesi'         => 'nullable|string|max:255',
            'pesan_testimoni' => 'required|string',
            'rating'          => 'nullable|integer|min:1|max:5',
            'urutan_tampil'   => 'nullable|integer|min:0',
            'foto'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'status_aktif'    => 'nullable|boolean',
        ]);
        $data['status_aktif'] = $request->boolean('status_aktif');
        $data['rating'] = isset($data['rating']) ? (int)$data['rating'] : null;
        $data['urutan_tampil'] = isset($data['urutan_tampil']) ? (int)$data['urutan_tampil'] : null;

        if ($request->hasFile('foto')) {
            if ($testimoni->path_foto) {
                Storage::disk('public')->delete($testimoni->path_foto);
            }
            $data['path_foto'] = $request->file('foto')->store('testimoni', 'public');
        }
        try {
            $testimoni->update($data);
        } catch (\Throwable $e) {
            return back()->withErrors(['general' => 'Gagal memperbarui testimoni: '.$e->getMessage()])->withInput();
        }

        return redirect()->route('admin.testimoni.index')
            ->with('success', 'Testimoni berhasil diperbarui.');
    }

    /**
     * Hapus testimoni.
     */
    public function destroy(Testimoni $testimoni)
    {
        if ($testimoni->path_foto) {
            Storage::disk('public')->delete($testimoni->path_foto);
        }

        $testimoni->delete();

        return redirect()
            ->route('admin.testimoni.index')
            ->with('success', 'Testimoni berhasil dihapus.');
    }

    public function toggleStatus(Testimoni $testimoni)
    {
        $testimoni->status_aktif = ! $testimoni->status_aktif;
        $testimoni->save();

        return redirect()
            ->route('admin.testimoni.index')
            ->with('success', $testimoni->status_aktif ? 'Testimoni diaktifkan.' : 'Testimoni dinonaktifkan.');
    }

    public function show(Testimoni $testimoni)
    {
        abort(404);
    }
}
