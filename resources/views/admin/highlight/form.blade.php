<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Judul Highlight</label>
        <input type="text" name="judul"
               class="form-control @error('judul') is-invalid @enderror"
               value="{{ old('judul', $highlight->judul) }}" required>
        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Kategori (opsional)</label>
        <input type="text" name="kategori" class="form-control"
               value="{{ old('kategori', $highlight->kategori) }}"
               placeholder="Contoh: Umum, Produk, Pelayanan">
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" rows="3" class="form-control">{{ old('deskripsi', $highlight->deskripsi) }}</textarea>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Kelas Ikon (opsional)</label>
        <input type="text" name="ikon_css" class="form-control"
               value="{{ old('ikon_css', $highlight->ikon_css) }}"
               placeholder="Contoh: fa fa-coffee">
        <small class="text-muted">Jika menggunakan Font Awesome, isi kelas ikon di sini.</small>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Warna Tema (opsional)</label>
        <input type="text" name="warna_tema" class="form-control"
               value="{{ old('warna_tema', $highlight->warna_tema) }}"
               placeholder="Contoh: primary, warning">
        <small class="text-muted">Bisa digunakan untuk warna background/icon di landing page.</small>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Urutan Tampil</label>
        <input type="number" name="urutan_tampil" class="form-control"
               value="{{ old('urutan_tampil', $highlight->urutan_tampil) }}">
        <small class="text-muted">Semakin kecil, semakin di awal.</small>
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label d-block">Status</label>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="status_aktif" id="status_aktif"
                   {{ old('status_aktif', $highlight->status_aktif ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="status_aktif">Tampilkan di landing page</label>
        </div>
    </div>
</div>

<div class="mt-3">
    <button type="submit" class="btn btn-primary">
        @if(isset($mode) && $mode === 'edit')
            Simpan Perubahan
        @else
            Simpan Highlight
        @endif
    </button>
    <a href="{{ route('admin.highlight.index') }}" class="btn btn-outline-secondary">
        Batal
    </a>
</div>
