<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PesanPengunjung;

class PesanPengunjungController extends Controller
{
    /**
     * Tampilkan daftar pesan.
     */
    public function index()
    {
        $daftarPesan = PesanPengunjung::orderBy('sudah_dibaca')
            ->orderByDesc('created_at')
            ->paginate(25);

        return view('admin.pesan-pengunjung.index', compact('daftarPesan'));
    }

    /**
     * Tampilkan detail 1 pesan.
     */
    public function show(PesanPengunjung $pesan_pengunjung)
    {
        // Jika belum dibaca, tandai sebagai sudah dibaca
        if (! $pesan_pengunjung->sudah_dibaca) {
            $pesan_pengunjung->update(['sudah_dibaca' => true]);
        }

        return view('admin.pesan-pengunjung.show', [
            'pesan' => $pesan_pengunjung,
        ]);
    }

    // create, store, edit, update tidak kita pakai di admin
    public function create() { abort(404); }
    public function store(Request $request) { abort(404); }
    public function edit(PesanPengunjung $pesan_pengunjung) { abort(404); }
    public function update(Request $request, PesanPengunjung $pesan_pengunjung) { abort(404); }

    /**
     * Hapus pesan.
     */
    public function destroy(PesanPengunjung $pesan_pengunjung)
    {
        $pesan_pengunjung->delete();

        return redirect()
            ->route('admin.pesan-pengunjung.index')
            ->with('success', 'Pesan pengunjung berhasil dihapus.');
    }

    /**
     * Tandai sebagai sudah dibaca (opsional, kalau mau tombol khusus).
     */
    public function tandaiSudahDibaca(PesanPengunjung $pesan_pengunjung)
    {
        if (! $pesan_pengunjung->sudah_dibaca) {
            $pesan_pengunjung->update(['sudah_dibaca' => true]);
        }

        return redirect()
            ->route('admin.pesan-pengunjung.show', $pesan_pengunjung)
            ->with('success', 'Pesan ditandai sebagai sudah dibaca.');
    }
}
