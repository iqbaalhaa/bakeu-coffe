<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Highlight;
use Illuminate\Http\Request;

class HighlightController extends Controller
{
    public function index()
    {
        $daftarHighlight = Highlight::orderByRaw('COALESCE(urutan_tampil, 9999) ASC')
            ->orderByDesc('created_at')
            ->paginate(12);

        return view('admin.highlight.index', compact('daftarHighlight'));
    }

    public function create()
    {
        $highlight = new Highlight();
        return view('admin.highlight.create', compact('highlight'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:150'],
            'deskripsi' => ['nullable', 'string'],
            'ikon_css' => ['nullable', 'string', 'max:100'],
            'kategori' => ['nullable', 'string', 'max:100'],
            'warna_tema' => ['nullable', 'string', 'max:50'],
            'urutan_tampil' => ['nullable', 'integer', 'min:0'],
            'status_aktif' => ['nullable'],
        ]);

        $validated['status_aktif'] = $request->boolean('status_aktif');

        Highlight::create($validated);

        return redirect()->route('admin.highlight.index')
            ->with('success', 'Highlight berhasil ditambahkan.');
    }

    public function edit(Highlight $highlight)
    {
        return view('admin.highlight.edit', compact('highlight'));
    }

    public function update(Request $request, Highlight $highlight)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:150'],
            'deskripsi' => ['nullable', 'string'],
            'ikon_css' => ['nullable', 'string', 'max:100'],
            'kategori' => ['nullable', 'string', 'max:100'],
            'warna_tema' => ['nullable', 'string', 'max:50'],
            'urutan_tampil' => ['nullable', 'integer', 'min:0'],
            'status_aktif' => ['nullable'],
        ]);

        $validated['status_aktif'] = $request->boolean('status_aktif');

        $highlight->update($validated);

        return redirect()->route('admin.highlight.index')
            ->with('success', 'Highlight berhasil diperbarui.');
    }

    public function destroy(Highlight $highlight)
    {
        $highlight->delete();
        return redirect()->route('admin.highlight.index')
            ->with('success', 'Highlight berhasil dihapus.');
    }
}
