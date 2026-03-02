<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;

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
        $data = $request->validate([
            'nama_produk'        => 'required|string|max:255',
            'kategori'           => 'nullable|string|max:100',
            'harga'              => 'required|numeric|min:0',
            'deskripsi_singkat'  => 'nullable|string',
            'deskripsi_lengkap'  => 'nullable|string',
            'status_aktif'       => 'nullable|boolean',
            'ditandai_favorit'   => 'nullable|boolean',
            'urutan_tampil'      => 'nullable|integer|min:1',
            'gambar'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        // Normalisasi checkbox ke boolean
        $data['status_aktif']     = $request->boolean('status_aktif');
        $data['ditandai_favorit'] = $request->boolean('ditandai_favorit');

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = $file->hashName();
            $file->move(public_path('assets/produk'), $filename);
            $data['path_gambar'] = 'produk/' . $filename;
        } else {
            // Pasang gambar default bila tidak ada upload
            $defaultSource = public_path('frontend/img/menu-1.jpg');
            $targetPath = public_path('assets/produk/default.jpg');
            
            if (!file_exists(dirname($targetPath))) {
                mkdir(dirname($targetPath), 0755, true);
            }

            if (is_file($defaultSource) && !file_exists($targetPath)) {
                copy($defaultSource, $targetPath);
            }
            $data['path_gambar'] = 'produk/default.jpg';
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
        $data = $request->validate([
            'nama_produk'        => 'required|string|max:255',
            'kategori'           => 'nullable|string|max:100',
            'harga'              => 'required|numeric|min:0',
            'deskripsi_singkat'  => 'nullable|string',
            'deskripsi_lengkap'  => 'nullable|string',
            'status_aktif'       => 'nullable|boolean',
            'ditandai_favorit'   => 'nullable|boolean',
            'urutan_tampil'      => 'nullable|integer|min:1',
            'gambar'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
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
            $file->move(public_path('assets/produk'), $filename);
            $data['path_gambar'] = 'produk/' . $filename;
        } else if (empty($produk->path_gambar)) {
            // Pastikan ada default jika sebelumnya kosong
            $defaultSource = public_path('frontend/img/menu-1.jpg');
            $targetPath = public_path('assets/produk/default.jpg');
            
            if (!file_exists(dirname($targetPath))) {
                mkdir(dirname($targetPath), 0755, true);
            }

            if (is_file($defaultSource) && !file_exists($targetPath)) {
                copy($defaultSource, $targetPath);
            }
            $data['path_gambar'] = 'produk/default.jpg';
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
